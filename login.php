<?php
    require_once "koneksi.php";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        
        if(mysqli_num_rows($query) > 0){
            $user = mysqli_fetch_assoc($query);
            if(password_verify($password, $user['password'])){
                $_SESSION['username'] = $username;
                $_SESSION['login'] = true;
                header("Location: index.php"); 
                exit();
            } else{
                echo "<script>alert('Password incorrect!')</script>";
            }
        } else{
            echo "<script>alert('User not found!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required placeholder="username = admin43">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required placeholder="password = admin43">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
