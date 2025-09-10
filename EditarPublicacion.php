<?php
session_start();

// Conexión
$conn = new mysqli("localhost", "root", "", "proyectoSISI");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Acceso no permitido.";
    exit();
}

// Recoger y sanear datos POST
$asunto    = trim($_POST['asu'] ?? '');
$contenido = trim($_POST['conte'] ?? '');
$idP       = isset($_POST['idP']) ? intval($_POST['idP']) : 0;

if ($idP <= 0 || $asunto === '' || $contenido === '') {
    echo "Faltan datos.";
    exit();
}

// 1) Obtener Autor, Archivo actual y CLASES_ID
$sqlVerif = "SELECT Autor, Archivo, CLASES_ID FROM PUBLICACIONES WHERE idP = ?";
$stmtVerif = $conn->prepare($sqlVerif);
$stmtVerif->bind_param("i", $idP);
$stmtVerif->execute();
$resVerif = $stmtVerif->get_result();

if ($resVerif->num_rows === 0) {
    echo "Publicación no encontrada.";
    exit();
}

$fila = $resVerif->fetch_assoc();
$autor         = $fila['Autor'];
$archivoActual = $fila['Archivo']; // puede ser NULL
$clase         = $fila['CLASES_ID'];

$stmtVerif->close();

// Obtener nombre del usuario en sesión para comparar con autor
$ciSesion = $_SESSION['ci'];
$stmtNombre = $conn->prepare("SELECT Nombres FROM informacion WHERE CI = ?");
$stmtNombre->bind_param("s", $ciSesion);
$stmtNombre->execute();
$resNombre = $stmtNombre->get_result();
$nombreSesion = $resNombre->fetch_assoc()['Nombres'] ?? '';
$stmtNombre->close();

if (trim($autor) !== trim($nombreSesion)) {
    die("No tienes permiso para editar esta publicación.");
}

// 2) Manejo del archivo (mantener anterior si no suben uno nuevo)
$archivoFinal = $archivoActual; // por defecto mantenemos lo anterior
if (isset($_FILES['archi']) && $_FILES['archi']['error'] === UPLOAD_ERR_OK) {
    $file        = $_FILES['archi'];
    $originalName= basename($file['name']);
    $ext         = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $permitidas  = ["pdf","jpg","jpeg","png","gif","webp","docx","xlsx","txt","zip"];
    $maxSize     = 5 * 1024 * 1024; // 5 MB

    if (!in_array($ext, $permitidas)) {
        echo "Tipo de archivo no permitido.";
        // seguimos sin actualizar archivo (mantenemos $archivoFinal = $archivoActual)
    } elseif ($file['size'] > $maxSize) {
        echo "El archivo es demasiado grande.";
    } else {
        // nombre único para evitar colisiones
        $nuevoNombre = "PUBLI-{$idP}-" . time() . "." . $ext;
        $destRel = "uploads/" . $nuevoNombre;          // lo que guardamos en BD
        $destAbs = __DIR__ . "/" . $destRel;           // ruta absoluta para move_uploaded_file

        if (!is_dir(__DIR__ . "/uploads")) {
            mkdir(__DIR__ . "/uploads", 0755, true); // crear carpeta si no existe
        }

        if (move_uploaded_file($file['tmp_name'], $destAbs)) {
            // opcional: eliminar archivo anterior si existe y es distinto
            if (!empty($archivoActual) && $archivoActual !== $destRel && file_exists(__DIR__ . "/" . $archivoActual)) {
                @unlink(__DIR__ . "/" . $archivoActual);
            }
            $archivoFinal = $destRel;
        } else {
            echo "Error al subir el archivo. Se mantuvo el anterior.";
        }
    }
}

// 3) Actualizar la publicación
date_default_timezone_set('America/La_Paz');
$fechaEdicion = date("Y-m-d H:i:s");

$sqlUpd = "UPDATE PUBLICACIONES SET Asunto = ?, Texto = ?, Archivo = ?, FechaE = ? WHERE idP = ?";
$stmtUpd = $conn->prepare($sqlUpd);
$stmtUpd->bind_param("ssssi", $asunto, $contenido, $archivoFinal, $fechaEdicion, $idP);

if ($stmtUpd->execute()) {
    // Redirigir usando $clase que obtuvimos arriba
    if ($_SESSION['rol'] == 1) {
        header("Location: clases.php?ID=" . intval($clase));
        exit();
    } elseif ($_SESSION['rol'] == 2) {
        header("Location: clases_pr.php?ID=" . intval($clase));
        exit();
    } else {
        echo "Publicación actualizada. (Rol desconocido para redirección)";
    }
} else {
    echo "Error al actualizar la publicación: " . $stmtUpd->error;
}

$stmtUpd->close();
$conn->close();
