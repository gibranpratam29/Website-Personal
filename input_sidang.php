<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = null;

if ($id > 0) {
    // Ambil data berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM sidang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $nomor = $_POST['nomor'];
    $ruangan = $_POST['ruangan'];
    $agenda = $_POST['agenda'];

    if (isset($_POST['id']) && $_POST['id']) {
        // Mode Edit → UPDATE
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE sidang SET tanggal = ?, nomor = ?, ruangan = ?, agenda = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $tanggal, $nomor, $ruangan, $agenda, $id);
        $stmt->execute();
        echo "<script>alert('✅ Jadwal berhasil diperbarui!'); window.location.href='jadwal.html';</script>";
    } else {
        // Mode Tambah Baru → INSERT
        $stmt = $conn->prepare("INSERT INTO sidang (tanggal, nomor, ruangan, agenda) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $tanggal, $nomor, $ruangan, $agenda);
        $stmt->execute();
        echo "<script>alert('✅ Jadwal berhasil ditambahkan!'); window.location.href='input_sidang.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Form Jadwal Sidang</title>
  <style>
    body { font-family: Segoe UI, sans-serif; background: #f9f9f9; padding: 20px; }
    form { background: white; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 0 10px #ccc; }
    h2 { text-align: center; color: #007b3c; }
    label { display: block; margin-top: 10px; }
    input, select, textarea {
      width: 100%; padding: 8px; margin-top: 5px;
      border: 1px solid #ccc; border-radius: 4px;
    }
    button {
      margin-top: 15px; background: #007b3c;
      color: white; padding: 10px 20px;
      border: none; border-radius: 5px;
      cursor: pointer;
    }
    button:hover { background: #005e2c; }
    .btn {
      display: inline-block;
      padding: 8px 15px;
      background-color: #007b3c;
      color: white;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      margin-top: 10px;
    }
    .btn:hover { background-color: #005f2b; }
  </style>
</head>
<body>

  <form method="POST">
    <h2><?= $id > 0 ? "Edit" : "Tambah" ?> Jadwal Sidang</h2>

    <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">

    <label>Tanggal Sidang</label>
    <input type="date" name="tanggal" required value="<?= $data['tanggal'] ?? '' ?>">

    <label>Nomor Perkara</label>
    <input type="text" name="nomor" required value="<?= $data['nomor_perkara'] ?? '' ?>">

    <label>Ruangan</label>
    <input type="text" name="ruangan" required value="<?= $data['ruang_sidang'] ?? 'Sistem Informasi Pengadilan' ?>">

    <label>Agenda</label>
    <textarea name="agenda" rows="3" required><?= $data['agenda'] ?? '' ?></textarea>

    <button type="submit">Simpan</button>
    <a href="jadwal.html" class="btn">Kembali</a>
  </form>

</body>
</html>
