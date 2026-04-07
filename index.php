<?php
// Initialize variables
$firstName = $secondName = $email = $password = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize input
    $firstName = htmlspecialchars(trim($_POST["firstname"]));
    $secondName = htmlspecialchars(trim($_POST["secondname"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    // Validation
    if (empty($firstName) || empty($secondName) || empty($email) || empty($password)) {
        $message = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
    } else {
        // Password hashing (important for security)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Success message (you can store in DB instead)
        $message = "Form submitted successfully!<br>
                    First Name: $firstName <br>
                    Second Name: $secondName <br>
                    Email: $email";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

<h2>Registration Form</h2>

<p style="color:red;"><?php echo $message; ?></p>

<form method="POST" action="">
    <label>First Name:</label><br>
    <input type="text" name="firstname" value="<?php echo $firstName; ?>"><br><br>

    <label>Second Name:</label><br>
    <input type="text" name="secondname" value="<?php echo $secondName; ?>"><br><br>

    <label>Email:</label><br>
    <input type="text" name="email" value="<?php echo $email; ?>"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
