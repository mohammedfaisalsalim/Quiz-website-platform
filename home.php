<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIQUIZMASTERY - Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<header>
    <div class="header-container">
        <h1>SCIQUIZMASTERY</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

    <main>
        <div class="welcome-container">
            <h2>Welcome to SCIQUIZMASTERY!</h2>
            <p>Challenge yourself with quizzes across various science subjects and levels of difficulty.</p>
            <p>Whether you're a beginner or an expert, we have the right set of questions for you.</p>
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                <p>Hello, <?php echo htmlspecialchars($_SESSION["name"]); ?>! Ready to test your knowledge?</p>
                <a class="btn" href="choose.php">Start a Quiz</a>
            <?php else: ?>
                <a class="btn" href="register.php">Get Started</a>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
