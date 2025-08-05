<?php
header('Content-Type: application/json'); // Penting untuk response JSON

include 'koneksi.php';

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Koneksi database gagal"]);
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM sidang WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Parameter ID tidak ditemukan"]);
}
?>
