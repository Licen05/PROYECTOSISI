<?php
// Iniciar sesión de forma segura (solo si no está ya iniciada)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay sesión activa
if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener nombre del usuario desde la tabla 'informacion'
$nombre = 'Usuario desconocido'; 
$ci = $_SESSION['ci'];
$sql_nombre = "SELECT Nombres FROM informacion WHERE CI = ?";
$stmt_nombre = $conn->prepare($sql_nombre);
$stmt_nombre->bind_param("s", $ci);
$stmt_nombre->execute();
$result_nombre = $stmt_nombre->get_result();

if ($result_nombre && $result_nombre->num_rows > 0) {
    $nombre = $result_nombre->fetch_assoc()['Nombres'];
}
$stmt_nombre->close();

// Obtener datos del formulario con validación básica
$id_tarea = isset($_POST['idTarea']) ? intval($_POST['idTarea']) : 0;   // ID de la tarea
$id_user  = isset($_POST['ci']) ? intval($_POST['ci']) : 0;   // ID del estudiante
$id_clase = isset($_POST['idClase']) ? intval($_POST['idClase']) : (isset($_POST['idc']) ? intval($_POST['idc']) : 0);
$respuesta = isset($_POST['respuesta']) ? trim($_POST['respuesta']) : '';
$calificacion = isset($_POST['calificacion']) ? trim($_POST['calificacion']) : null;

$archivo = null;

$uploadDir = "media/"; 
$uploadOk = 1; 

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['archivo']['tmp_name'];
    $fileName = basename($_FILES['archivo']['name']);
    $fileSize = $_FILES['archivo']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Nombre único: tarea + clase + timestamp
    $newFileName = "ENTREGA-" . $ID_Clase . "-" . time() . "." . $fileType;
    $targetFile = $uploadDir . $newFileName;

    // Validar si existe
    if (file_exists($targetFile)) {
        echo "Lo sentimos, ya existe un archivo con ese nombre.";
        $uploadOk = 0;
    }

    // Validar tamaño (5MB)
    if ($fileSize > 5 * 1024 * 1024) {
        echo "El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Validar extensión
    $extPermitidas = ["pdf","jpg","jpeg","png","gif","docx","xlsx","zip","txt"];
    if (!in_array($fileType, $extPermitidas)) {
        echo "Tipo de archivo no permitido.";
        $uploadOk = 0;
    }

    // Subir si todo ok
    if ($uploadOk == 1) {
        if (move_uploaded_file($fileTmp, $targetFile)) {
            $archivo = $targetFile;
        } else {
            echo "Error al subir el archivo.";
        }
    }
}

if ($id_tarea <= 0 || $id_clase <= 0) {
    die("Datos insuficientes para procesar la solicitud.");
}

// Limpiar y validar

$id_clase = trim($id_clase);
$id_user = trim($id_user);

// Fecha actual
date_default_timezone_set('America/La_Paz');
$fechaActual = date("Y-m-d H:i:s");




//para poder pasar a revisar.php otra ves
 $id=$_SESSION['ci'];
 $ID_Clase = 0; // inicializamos
              $sql= "SELECT * FROM  CLASES WHERE Profesor=$id";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Materia'];
                    $curso=$fila['Grado'];
                    $ID_Clase = $fila["ID"];
                  }}
           // Solo si existe clase, buscamos tareas
if ($ID_Clase > 0) {
    $sql= "SELECT * FROM TAREA WHERE CLASES_ID=$ID_Clase";
    $resultado=mysqli_query($conn,$sql);
    if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
        while($fila=mysqli_fetch_assoc($resultado)){
            $idT    = $fila['id'];
            $titulo = $fila['Titulo'];
            $curso  = $fila['Descripcion'];
        }
    }
}
/* -----------------------
   SI ES ESTUDIANTE (ROL 1)
   ----------------------- */
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
    $sql = "INSERT INTO ENTREGA (CUENTA_User, Tarea_id, Respuesta, FechaEnvio, Archivo, FechaRevision, Calificacion) 
            VALUES (?, ?, ?, ?, ?, '0000-00-00 00:00:00', NULL)
            ON DUPLICATE KEY UPDATE 
                Respuesta = VALUES(Respuesta), 
                FechaEnvio = VALUES(FechaEnvio), 
                Archivo = VALUES(Archivo)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $id_user, $id_tarea, $respuesta, $fechaActual, $archivo);


    if ($stmt->execute()) {
        header("Location: tablon_tareasProf.php?ID=$id_clase&idT=$id_tarea");
        exit();
    } else {
        echo "Error al registrar entrega: " . $stmt->error;
    }
    $stmt->close();
}

/* -----------------------
   SI ES PROFESOR (ROL 2)
   ----------------------- */
elseif (isset($_SESSION['rol']) && $_SESSION['rol'] == 2) {
    if ($calificacion === null || $id_user <= 0) {
        die("Faltan datos para registrar la calificación.");
    }

    // Obtener el valor máximo permitido ("Sobre")
    $sqlSobre = "SELECT Sobre FROM TAREA WHERE id = ?";
    $stmtSobre = $conn->prepare($sqlSobre);
    $stmtSobre->bind_param("i", $id_tarea);
    $stmtSobre->execute();
    $resSobre = $stmtSobre->get_result();
    $maxPuntaje = 0;
    if ($resSobre && $resSobre->num_rows > 0) {
        $maxPuntaje = $resSobre->fetch_assoc()['Sobre'];
    }
    $stmtSobre->close();

    //  Validación de rango
    if ($calificacion < 0 || $calificacion > $maxPuntaje) {
        die("La calificación debe estar entre 0 y $maxPuntaje puntos.");
    }

    // Guardar nota si es válida
    $sql = "UPDATE ENTREGA 
            SET Calificacion = ?, FechaRevision = ? 
            WHERE CUENTA_User = ? AND Tarea_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $calificacion, $fechaActual, $id_user, $id_tarea);

    if ($stmt->execute()) {
        header("Location: revisar.php?ID=$id_clase&idT=$id_tarea");
        exit();
    } else {
        echo "Error al registrar la calificación: " . $stmt->error;
    }
    $stmt->close();
}



/* -----------------------
   SI NO SE RECONOCE EL ROL
   ----------------------- */
else {
    echo "Acción no permitida.";
}

$conn->close();
?>