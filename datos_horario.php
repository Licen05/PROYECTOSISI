<?php
include("bd.php");

// Solo permitir acceso a admin (rol 3)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: horarios.php");
    exit();
}

date_default_timezone_set('America/La_Paz');

function subirImagen($campoArchivo) {
    if (isset($_FILES[$campoArchivo]) && $_FILES[$campoArchivo]['error'] == UPLOAD_ERR_OK) {
        $fileTmp = $_FILES[$campoArchivo]['tmp_name'];
        $fileName = basename($_FILES[$campoArchivo]['name']);
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Solo permitir formatos válidos
        $permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $permitidos)) {
            die("Error: formato de imagen no permitido.");
        }

        // Carpeta donde se guardan las imágenes
        $directorio = "media/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Nombre único del archivo
        $nuevoNombre = "HORARIO-" . time() . "." . $ext;
        $rutaFinal = $directorio . $nuevoNombre;

        if (move_uploaded_file($fileTmp, $rutaFinal)) {
            return $rutaFinal;
        } else {
            die("Error al subir la imagen.");
        }
    }
    return null;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'editar') {
    $id = intval($_POST['editar_id']);
    $nuevaImagen = subirImagen('archivo');

    if ($nuevaImagen) {
        $sql = "UPDATE horario SET Imagen = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nuevaImagen, $id);

        if ($stmt->execute()) {
            header("Location: horarios.php");
            exit();
        } else {
            echo "Error al actualizar el horario: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "No se recibió ninguna imagen para actualizar.";
    }
    exit();
}


if (isset($_POST['dia'])) {
    $dia = $_POST['dia'];
    $imagen = subirImagen('archivo');

    if (!$imagen) {
        die("Error: no se subió ninguna imagen.");
    }

    // Verificar si ya existe un horario para ese día
    $sqlCheck = "SELECT * FROM horario WHERE Dia = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $dia);
    $stmtCheck->execute();
    $res = $stmtCheck->get_result();

    if ($res->num_rows > 0) {
        // Si ya existe, se actualiza
        $sqlUpdate = "UPDATE horario SET Imagen = ? WHERE Dia = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $imagen, $dia);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    } else {
        
        // Recuperar el usuario actual de la sesión
$id_usuario = isset($_SESSION['ci']) ? $_SESSION['ci'] : null;

if (!$id_usuario) {
    die("Error: No se encontró el usuario en la sesión.");
}

$sqlInsert = "INSERT INTO horario (Id_usuario, Dia, Imagen) VALUES (?, ?, ?)";
$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("iss", $id_usuario, $dia, $imagen);
$stmtInsert->execute();
$stmtInsert->close();

    }

    header("Location: horarios.php");
    exit();
}

$conn->close();
?>
