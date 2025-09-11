<?php
$servername = "localhost";
$username = "root";
$password="";
$dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}

// Validar que venga el id de la tarea por POST
if (!isset($_POST['idT']) || !is_numeric($_POST['idT'])) {
    die("ID de tarea no válido.");
}
$idt = intval($_POST['idT']);

// Recibir datos del formulario
$titulo = $_POST['tit'];
$tema = !empty($_POST['tema_existente']) ? $_POST['tema_existente'] : $_POST['tema_nuevo'];
$descripcion = $_POST['descript'];
$fechaET = $_POST['fechE'];
$sobre = $_POST['sobre'];
// 1) Obtener Autor, Archivo actual y CLASES_ID
$sqlVerif = "SELECT Archivo, CLASES_ID FROM TAREA WHERE id = ?";
$stmtVerif = $conn->prepare($sqlVerif);
$stmtVerif->bind_param("i", $idt);
$stmtVerif->execute();
$resVerif = $stmtVerif->get_result();

if ($resVerif->num_rows === 0) {
    echo "Publicación no encontrada.";
    exit();
}

$fila = $resVerif->fetch_assoc();
$archivoActual = $fila['Archivo']; // puede ser NULL
$clase         = $fila['CLASES_ID'];

$stmtVerif->close();
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
        $nuevoNombre = "PUBLI-{$idt}-" . time() . "." . $ext;
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
// Update
$sql = "UPDATE TAREA 
        SET Titulo = ?, Tema = ?, Descripcion = ?, FechaEntrega = ?, Sobre = ?, Archivo = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssisi", $titulo, $tema, $descripcion, $fechaET, $sobre, $archivoFinal, $idt);
$id_ = $_POST['ID'] ; 
if ($stmt->execute()) {
    header("Location: tablon_tareasProf.php?ID=$id_");
    exit();
} else {
    echo "Error al actualizar la tarea: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
