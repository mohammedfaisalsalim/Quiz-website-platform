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

$question = $category = $difficulty = $option1 = $option2 = $option3 = $option4 = $correct_option = "";
$question_err = $category_err = $difficulty_err = $option1_err = $option2_err = $option3_err = $option4_err = $correct_option_err = $operation_result = "";

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIQUIZMASTERY - Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>SCIQUIZMASTERY - Admin Panel</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <br>  
        <br>
        <br>
        <br>
        <br>
        <div class="container">
            <br>    
            <h2>Add New Question</h2>
            <form action="add-question.php" method="post">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option disabled value="">Select category</option>
                        <option value="chemistry">chemistry</option>
                        <option value="biology">biology</option>
                        <option value="physics">physics</option>
                    </select>
                    <span class="error"><?php echo $category_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Difficulty</label>
                    <select name="difficulty">
                        <option value="">Select Difficulty Level</option>
                        <option value="beginner">beginner</option>
                        <option value="intermediate">intermediate</option>
                        <option value="expert">expert</option>
                    </select>
                    <span class="error"><?php echo $difficulty_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Question</label>
                    <textarea name="question"><?php echo $question; ?></textarea>
                    <span class="error"><?php echo $question_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Option 1</label>
                    <input type="text" name="option1" value="<?php echo $option1; ?>">
                    <span class="error"><?php echo $option1_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Option 2</label>
                    <input type="text" name="option2" value="<?php echo $option2; ?>">
                    <span class="error"><?php echo $option2_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Option 3</label>
                    <input type="text" name="option3" value="<?php echo $option3; ?>">
                    <span class="error"><?php echo $option3_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Option 4</label>
                    <input type="text" name="option4" value="<?php echo $option4; ?>">
                    <span class="error"><?php echo $option4_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Correct Option</label>
                    <select name="correct_option">
                        <option value="">Select correct option</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                    </select>
                    <span class="error"><?php echo $correct_option_err; ?></span>
                </div>
                <div class="form-group">
                    <button type="submit">Add Question</button>
                </div>
                <div class="success"><?php echo $operation_result; ?></div>
            </form>
        </div>
        <div class="container">
            <h2>Edit/Delete Questions</h2>
            <table>
                <tr>
                    <th>Category</th>
                    <th>Difficulty</th>
                    <th>Question</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($questions as $q): ?>
                    <tr>
                        <td><?php echo $q['category']; ?></td>
                        <td><?php echo $q['difficulty']; ?></td>
                        <td><?php echo $q['question']; ?></td>
                        <td>
                            <a href="edit_question.php?id=<?php echo $q['id']; ?>">Edit</a>
                            <a href="delete_question.php?id=<?php echo $q['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
</body>
</html>
