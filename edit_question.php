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

$id = $_GET['id'];

$sql = "SELECT * FROM questions WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $category = $row['category'];
    $difficulty = $row['difficulty'];
    $question = $row['question'];
    $option1 = $row['option1'];
    $option2 = $row['option2'];
    $option3 = $row['option3'];
    $option4 = $row['option4'];
    $correct_option = $row['correct_option'];
} else {
    echo "Question not found!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIQUIZMASTERY - Edit Question</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>SCIQUIZMASTERY - Edit Question</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin.php">Back to Admin Panel</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Edit Question</h2>
            <form action="update_question.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" value="<?php echo $category; ?>">
                </div>
                <div class="form-group">
                    <label>Difficulty</label>
                    <input type="text" name="difficulty" value="<?php echo $difficulty; ?>">
                </div>
                <div class="form-group">
                    <label>Question</label>
                    <textarea name="question"><?php echo $question; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Option 1</label>
                    <input type="text" name="option1" value="<?php echo $option1; ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>Option 2</label>
                    <input type="text" name="option2" value="<?php echo $option2; ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>Option 3</label>
                    <input type="text" name="option3" value="<?php echo $option3; ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>Option 4</label>
                    <input type="text" name="option4" value="<?php echo $option4; ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>Correct Option</label>
                    <select name="correct_option">
                        <option value="">Select correct option</option>
                        <option value="1"><?php echo $option1; ?></option>
                        <option value="2"><?php echo $option2; ?></option>
                        <option value="3"><?php echo $option3; ?></option>
                        <option value="4"><?php echo $option4; ?></option>
                    </select>
                </div>               
                <div class="form-group">
                    <button type="submit">Update Question</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
