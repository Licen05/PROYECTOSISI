<?php
$servername = "localhost";
$username = "root";
$password="";
$dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}




$_SESSION['nombre_usuario'] = $nombre;
$ID = $_POST["idt"];
$come = $_POST['comentario'];

 
    $sql = "INSERT INTO COMENTARIO (Comentario, ID_tarea, usuario ) 
         VALUES (?, ?, ?)";
      
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("si", $come, $ID, $nombre);

         if ($stmt->execute()) {
    header("Location: tarea.php?idT=$ID");
    exit();
} else {
    echo "Error al registrar tarea: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
