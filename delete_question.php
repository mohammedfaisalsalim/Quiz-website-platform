<?php
session_start();

$host = 'localhost';
$db = 'webapp';
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM questions WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['operation_result'] = "Question deleted successfully.";
        } else {
            $_SESSION['operation_result'] = "Error deleting question: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['operation_result'] = "Error preparing statement: " . $conn->error;
    }
}

$conn->close();

header("location: admin_home.php");
exit;
?>
