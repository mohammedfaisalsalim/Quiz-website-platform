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

$category = $difficulty = $question = $option1 = $option2 = $option3 = $option4 = $correct_option = "";
$category_err = $difficulty_err = $question_err = $option1_err = $option2_err = $option3_err = $option4_err = $correct_option_err = $operation_result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = trim($_POST['category']);
    $difficulty = trim($_POST['difficulty']);
    $question = trim($_POST['question']);
    $option1 = trim($_POST['option1']);
    $option2 = trim($_POST['option2']);
    $option3 = trim($_POST['option3']);
    $option4 = trim($_POST['option4']);
    $correct_option = trim($_POST['correct_option']);

    if (empty($category)) {
        $category_err = "Please enter a category.";
    }
    if (empty($difficulty)) {
        $difficulty_err = "Please enter a difficulty.";
    }
    if (empty($question)) {
        $question_err = "Please enter a question.";
    }
    if (empty($option1)) {
        $option1_err = "Please enter option 1.";
    }
    if (empty($option2)) {
        $option2_err = "Please enter option 2.";
    }
    if (empty($option3)) {
        $option3_err = "Please enter option 3.";
    }
    if (empty($option4)) {
        $option4_err = "Please enter option 4.";
    }
    if (empty($correct_option)) {
        $correct_option_err = "Please select the correct option.";
    }

    if (empty($category_err) && empty($difficulty_err) && empty($question_err) && empty($option1_err) && empty($option2_err) && empty($option3_err) && empty($option4_err) && empty($correct_option_err)) {
        $sql = "INSERT INTO questions (category, difficulty, question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssi", $category, $difficulty, $question, $option1, $option2, $option3, $option4, $correct_option);

            if ($stmt->execute()) {
                $operation_result = "Question added successfully.";
            } else {
                $operation_result = "Error adding question: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $operation_result = "Error preparing statement: " . $conn->error;
        }
    }
}

$conn->close();

header("location: admin_home.php");
exit;
?>
