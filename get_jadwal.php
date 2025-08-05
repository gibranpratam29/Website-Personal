<?php
include 'koneksi.php';
$sql = "SELECT * FROM sidang";
$result = $conn->query($sql);
$data = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($data);
?>