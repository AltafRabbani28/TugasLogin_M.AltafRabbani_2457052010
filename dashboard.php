<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>Selamat Datang, <?php echo $nama; ?></h2>

<?php

if ($nama == 'admin') {

    echo "<h3>Data User</h3>";

    $query = mysqli_query($conn, "SELECT * FROM users");

    echo "
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    ";

    while ($data = mysqli_fetch_assoc($query)) {

    echo "<tr>";

    echo "<td>" . $data['id'] . "</td>";

    echo "<td>" . $data['nama'] . "</td>";

    echo "<td>
            <a href='edit.php?id=".$data['id']."'>
                Edit
            </a>

            |

            <a href='hapus.php?id=".$data['id']."'
               onclick='return confirm(\"Yakin hapus?\")'>

               Hapus

            </a>
          </td>";

    echo "</tr>";
}

    echo "</table>";

} else {
    echo "Selamat datang User";
}
?>

<br>
<a href="logout.php">Logout</a>

</body>
</html>
