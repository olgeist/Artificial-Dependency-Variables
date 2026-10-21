<?php
// Initialize variables to hold form data and messages
$name = "";
$email = "";
$message = "";
$success_msg = "";

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve and sanitize the input data to prevent XSS attacks
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    
    // Basic validation
    if (empty($name) || empty($email)) {
        $message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } else {
        // If validation passes, you can process the data here 
        // (e.g., save to database, send an email, etc.)
        
        $success_msg = "Thank you, $name! Your form was submitted successfully.";
        
        // Clear the fields after successful submission
        $name = "";
        $email = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-container { max-width: 400px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background-color: #218838; }
        .error { color: red; margin-bottom: 15px; }
        .success { color: green; margin-bottom: 15px; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Contact Setup</h2>

        <!-- Display success or error messages -->
        <?php if (!empty($message)): ?>
            <div class="error"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success_msg)): ?>
            <div class="success"><?php echo $success_msg; ?></div>
        <?php endif; ?>

        <!-- Form Setup -->
        <!-- htmlspecialchars($_SERVER["PHP_SELF"]) ensures the form submits securely to itself -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <button type="submit">Submit</button>
            
        </form>
    </div>

</body>
</html>
