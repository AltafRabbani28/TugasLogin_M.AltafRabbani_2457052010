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

mysqli_query(
    $conn,
    "DELETE FROM users WHERE id='$id'"
);

header("Location: dashboard.php");
exit;
?>
