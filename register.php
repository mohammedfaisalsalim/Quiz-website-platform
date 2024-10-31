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

$name = $gender = $birthday = $email = $password = $confirm_password = "";
$name_err = $gender_err = $birthday_err = $email_err = $password_err = $confirm_password_err = $register_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["gender"]))) {
        $gender_err = "Please select a gender.";
    } else {
        $gender = trim($_POST["gender"]);
    }

    if (empty(trim($_POST["birthday"]))) {
        $birthday_err = "Please enter your birthday.";
    } else {
        $birthday = trim($_POST["birthday"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email.";
    } else {
        $email = trim($_POST["email"]);
        $sql = "SELECT id FROM students WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $email_err = "This email is already registered.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty($name_err) && empty($gender_err) && empty($birthday_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO students (name, gender, birthday, email, password) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $param_name, $param_gender, $param_birthday, $param_email, $param_password);

            $param_name = $name;
            $param_gender = $gender;
            $param_birthday = $birthday;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if ($stmt->execute()) {
                $register_success = "Registration successful. You can now log in.";
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIQUIZMASTERY - Register</title>
    <link rel="stylesheet" href="login.css"></head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender">
                    <option value="" disabled selected>Select your gender</option>
                    <option value="Male" <?php echo $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo $gender == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
                <span class="error"><?php echo $gender_err; ?></span>
            </div>
            <div class="form-group">
                <label>Birthday</label>
                <input type="date" name="birthday" value="<?php echo $birthday; ?>">
                <span class="error"><?php echo $birthday_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span class="error"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            <div class="success"><?php echo $register_success; ?></div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
