<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['nama'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['login'])) {

    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // cek user
    $query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE nama='$nama'"
    );


    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        // cek password hash
        if (
            password_verify(
                $password,
                $data['password']
            )
        ) {

            $_SESSION['nama'] = $data['nama'];


            header("Location: dashboard.php");
            exit;

        } else {

            $error = "Password salah!";
        }

    } else {

        $error = "User tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>

        body{
            font-family: Arial;
            margin: 50px;
        }

        .container{
            width: 300px;
            border: 1px solid black;
            padding: 20px;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        button{
            padding: 10px 20px;
            margin-top: 10px;
        }

        .error{
            color: red;
        }

    </style>
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <label>Nama</label>

        <input
            type="text"
            name="nama"
            required
        >

        <br><br>

        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <br><br>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>