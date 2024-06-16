<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .contact-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h2 class="text-center mb-4">Contact Us</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
            $name = $email = $message = "";
            $nameErr = $emailErr = $messageErr = $successMsg = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $isValid = true;

                if (empty($_POST["name"])) {
                    $nameErr = "Name is required";
                    $isValid = false;
                } else {
                    $name = test_input($_POST["name"]);
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                        $nameErr = "Only letters and white space allowed";
                        $isValid = false;
                    }
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                    $isValid = false;
                } else {
                    $email = test_input($_POST["email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                        $isValid = false;
                    }
                }

                if (empty($_POST["message"])) {
                    $messageErr = "Message is required";
                    $isValid = false;
                } else {
                    $message = test_input($_POST["message"]);
                }

                if ($isValid) {
                    $successMsg = "Thank you for contacting us!";
                    $name = $email = $message = "";
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control <?php echo !empty($nameErr) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $name; ?>">
            <div class="invalid-feedback"><?php echo $nameErr; ?></div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control <?php echo !empty($emailErr) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $email; ?>">
            <div class="invalid-feedback"><?php echo $emailErr; ?></div>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control <?php echo !empty($messageErr) ? 'is-invalid' : ''; ?>" id="message" name="message" rows="4"><?php echo $message; ?></textarea>
            <div class="invalid-feedback"><?php echo $messageErr; ?></div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        <div class="mt-3 text-success"><?php echo $successMsg; ?></div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
