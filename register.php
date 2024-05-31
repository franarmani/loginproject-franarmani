<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/ec17bc00cd.js" crossorigin="anonymous"></script>

    <title>Register</title>


    <script src="app.js"></script>

</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
                include("php/config.php");
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $age = $_POST['age'];
                    $password = $_POST['password'];

                    // Verifica si el correo electrónico ya está en uso
                    $stmt = mysqli_prepare($con, "SELECT Email FROM users WHERE Email=?");
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) != 0 ){
                        echo "<div class='message'>
                                  <p>This email is already in use. Please try another one.</p>
                              </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    } else {
                        // Hash de la contraseña antes de guardarla en la base de datos
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Inserta el nuevo usuario en la base de datos
                        $stmt = mysqli_prepare($con, "INSERT INTO users (Username, Email, Age, Password) VALUES (?, ?, ?, ?)");
                        mysqli_stmt_bind_param($stmt, "ssis", $username, $email, $age, $hashed_password);
                        mysqli_stmt_execute($stmt);

                        echo "<div class='message'>
                                  <p>Registration successful!</p>
                              </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button>";
                    }
                } else {
            ?>
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <div class="password-toggle">
                        <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePasswordVisibility('password')"></i>
                    </div>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</body>
</html>
