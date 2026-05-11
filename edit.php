<?php
session_start();
include 'koneksi.php';


if (
    !isset($_SESSION['nama']) ||
    $_SESSION['nama'] != 'admin'
) {

    header("Location: dashboard.php");
    exit;
}


if (!isset($_GET['id'])) {

    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $password = $_POST['password'];

   
    $hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    mysqli_query(
        $conn,

        "UPDATE users
         SET
            nama='$nama',
            password='$hash'
         WHERE id='$id'"
    );

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit Data User</h2>

<form method="POST">

    <label>Nama</label>

    <br>

    <input
        type="text"
        name="nama"
        value="<?php echo $data['nama']; ?>"
        required
    >

    <br><br>

    <label>Password Baru</label>

    <br>

    <input
        type="password"
        name="password"
        required
    >

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

</form>

</body>
</html>
