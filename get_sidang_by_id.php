<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($koneksi, "SELECT * FROM sidang WHERE id = $id");
    echo json_encode(mysqli_fetch_assoc($result));
}
?>
