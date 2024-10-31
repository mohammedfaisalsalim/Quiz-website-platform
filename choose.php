<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIQUIZMASTERY</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">
</head>

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
<body>
    <div class="container">
        <h1>SCIQUIZMASTERY QUIZ</h1>
        <form action="quiz.php" method="post">
            <label for="category">Choose a category:</label>
            <select name="category" id="category">
                <option value="biology">Biology</option>
                <!-- Add more categories as needed -->
            </select>

            <label for="difficulty">Choose difficulty:</label>
            <select name="difficulty" id="difficulty">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="expert">Expert</option>
            </select>

            <button type="submit">Start Quiz</button>
        </form>
    </div>
</body>
</html>
