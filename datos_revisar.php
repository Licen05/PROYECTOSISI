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
$nota = isset($_POST['nota']) ? trim($_POST['nota']) : '';
$id_ = isset($_POST['idt']) ? intval($_POST['idt']) : 0;
$id_user = isset($_POST['idu']) ? intval($_POST['idu']) : 0;
// Limpiar y validar
$nota = trim($nota);
$id_ = trim($id_);
$id_user = trim($id_user);


// Validación de campos requeridos
if (empty($nota) || $id_ <= 0 || $id_user <= 0) {
    echo "Faltan datos para guardar la publicación.";
    exit();
}
$id_clase = isset($_POST['idc']) ? intval($_POST['idc']) : 0;

if ($id_clase <= 0) {
    die("ID de clase no válido.");
}
// Evitar XSS
$nota = htmlspecialchars($nota, ENT_QUOTES, 'UTF-8');

// Fecha actual
date_default_timezone_set('America/La_Paz');
$fechaActual = date("Y-m-d H:i:s");
//para poder pasar a revisar.php otra ves
 $id=$_SESSION['ci'];
              $sql= "SELECT * FROM  CLASES WHERE Profesor=$id";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Materia'];
                    $curso=$fila['Grado'];
                    $ID_Clase = $fila["ID"];
                  }}
              $sql= "SELECT * FROM  TAREA WHERE CLASES_ID=$ID_Clase";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    $idT=$fila['id'];
                    $titulo=$fila['Titulo'];
                    $curso=$fila['Descripcion'];}}

// Insertar en la tabla 'ENTREGA'
$sql = "INSERT INTO ENTREGA (CUENTA_User, Nota, FechaEnvio, Tarea_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issi", $id_user, $nota, $fechaActual, $id_);

if ($stmt->execute()) {
    // Redirección según el rol
    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 2) {
       header("Location: revisar.php?ID=$id_clase&idT=$idT");
    } else {
       header("Location: revisar.php?ID=$id_clase&idT=$idT");
    }
    exit();
} else {
    echo "Error al insertar la nota: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
