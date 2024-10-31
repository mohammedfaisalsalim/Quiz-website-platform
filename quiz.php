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

$category = $_POST['category'];
$difficulty = $_POST['difficulty'];

$sql = "SELECT * FROM questions WHERE category = '$category' AND difficulty = '$difficulty'";
$result = $conn->query($sql);
?>

<header>
<link rel="stylesheet" href="header.css">
    <div class="header-container">
        <h1>SCIQUIZMASTERY</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIQUIZMASTERY - Quiz</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>SCIQUIZMASTERY</h1>
        <form action="result.php" method="post">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='question'>";
                    echo "<p>" . $row['question'] . "</p>";
                    echo "<input type='radio' name='question" . $row['id'] . "' value='1'>" . $row['option1'] . "<br>";
                    echo "<input type='radio' name='question" . $row['id'] . "' value='2'>" . $row['option2'] . "<br>";
                    echo "<input type='radio' name='question" . $row['id'] . "' value='3'>" . $row['option3'] . "<br>";
                    echo "<input type='radio' name='question" . $row['id'] . "' value='4'>" . $row['option4'] . "<br>";
                    echo "</div>";
                }
            } else {
                echo "<p>No questions available for this category and difficulty.</p>";
            }
            ?>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
