<?php
// Database connection
$host = 'localhost';
$db = 'webapp';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$score = 0;
$total_questions = 0;

foreach ($_POST as $question_id => $selected_option) {
    $question_id = str_replace("question", "", $question_id);
    $selected_option = (int)$selected_option;

    $sql = "SELECT correct_option FROM questions WHERE id = $question_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['correct_option'] == $selected_option) {
        $score++;
    }
    $total_questions++;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIQUIZMASTERY - Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>SCIQUIZMASTERY - RESULTS</h1>
        <p>You scored <?php echo $score; ?> out of <?php echo $total_questions; ?>.</p>
        <a href="choose.php">Take another quiz</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
