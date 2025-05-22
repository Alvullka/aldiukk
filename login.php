<?php
session_start();
include('koneksi.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if($result->num_rows > 0){
        $data = mysqli_fetch_assoc($result);

        if($data['role'] == 'user'){
           header('location: index.php');
        }
        else if($data['role'] == 'admin'){
           header('location: admin.php');
        }
        else{
            header('location: superadmin.php');

        }
    }else{
        echo 'LOGIN GAGAL';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
    <style>
        /* Option 1a: Daytime Blue Sky */
body {
    margin: 0; /* Remove default body margin */
    height: 100vh; /* Make body take full viewport height */
    background: linear-gradient(to bottom, #87CEEB, #B0E0E6); /* Light blue to very light blue */
    display: flex; /* For centering content later if needed */
    justify-content: center;
    align-items: center;
}

/* Option 1b: Sunset Sky (replace the above body styles) */
/*
body {
    margin: 0;
    height: 100vh;
    background: linear-gradient(to bottom, #FF7F50, #FFDAB9);
    display: flex;
    justify-content: center;
    align-items: center;
}
*/

/* Basic styling for your login form to make it visible on the sky background */
.login-container {
    background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent white */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-align: center; /* Center the form elements */
}

.login-container input[type="text"],
.login-container input[type="password"] {
    padding: 10px;
    margin: 10px 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.login-container button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-container button:hover {
    background-color: #0056b3;
}
    </style>
<body>
    <div>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" name="login" value="login">
        </form>
    </div>
</body>
</html>