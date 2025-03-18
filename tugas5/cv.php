<?php
session_start();
if (!isset($_SESSION["email"])) {
  header("Location: index.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = htmlspecialchars($_POST['nama'] ?? '');
  $email = $_SESSION["email"];
  $ttl = htmlspecialchars($_POST['ttl'] ?? '');
  $telepon = htmlspecialchars($_POST['telepon'] ?? '');
  $alamat = htmlspecialchars($_POST['alamat'] ?? '');
  $about = htmlspecialchars($_POST['about'] ?? '');

  $pendidikan = [];
  for ($i = 1; $i <= 4; $i++) {
    if (!empty($_POST["thn-$i"]) && !empty($_POST["pendidikan-$i"])) {
      $pendidikan[] = [
        "tahun" => htmlspecialchars($_POST["thn-$i"]),
        "riwayat" => htmlspecialchars($_POST["pendidikan-$i"])
      ];
    }
  }

  $keahlian = !empty($_POST['keahlian']) ? array_map('trim', explode(',', $_POST['keahlian'])) : [];
  $bahasa = !empty($_POST['bahasa']) ? array_map('trim', explode(',', $_POST['bahasa'])) : [];

  $pengalaman = [];
  for ($i = 1; $i <= 4; $i++) {
    if (!empty($_POST["judul-$i"]) && !empty($_POST["pengalaman-$i"])) {
      $pengalaman[] = [
        "judul" => htmlspecialchars($_POST["judul-$i"]),
        "deskripsi" => htmlspecialchars($_POST["pengalaman-$i"])
      ];
    }
  }

  $gambarBase64 = '';
  if (!empty($_FILES['foto']['tmp_name'])) {
    $gambarData = file_get_contents($_FILES['foto']['tmp_name']);
    $gambarBase64 = 'data:' . mime_content_type($_FILES['foto']['tmp_name']) . ';base64,' . base64_encode($gambarData);
  }
} else {
  header("Location: input.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Anda</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #666;
        padding-bottom: 15px;
    }
    .header img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #444;
    }
    .header .info {
        flex-grow: 1;
        margin-left: 20px;
    }
    h1 {
        font-size: 28px;
        color: #222;
        margin: 0;
    }
    h2 {
        color: #444;
        border-bottom: 2px solid #666;
        padding-bottom: 5px;
        margin-top: 25px;
        font-size: 20px;
    }
    .info p {
        margin: 5px 0;
        font-size: 16px;
    }
    .info strong {
        color: #444;
    }
    .list-item {
        margin-bottom: 10px;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        background: #f8f8f8;
        margin: 5px 0;
        padding: 8px;
        border-radius: 4px;
        border-left: 4px solid #666;
    }
    .section {
        margin-top: 20px;
    }
    </style>
</head>
<body>
  <div class="container">
    <!-- HEADER -->
    <div class="header">
      <div class="info">
        <h1><?= $nama ?></h1>
        <p><strong>Email:</strong> <?= $email ?></p>
        <p><strong>Telepon:</strong> <?= $telepon ?></p>
        <p><strong>Alamat:</strong> <?= $alamat ?></p>
        <p><strong>TTL:</strong> <?= $ttl ?></p>
      </div>
      <?php if (!empty($gambarBase64)): ?>
        <img src="<?= $gambarBase64 ?>" alt="Foto Profil">
      <?php endif; ?>
    </div>

    <!-- TENTANG SAYA -->
    <div class="section">
      <h2>Tentang Saya</h2>
      <p><?= nl2br($about) ?></p>
    </div>

    <!-- PENDIDIKAN -->
    <div class="section">
      <h2>Pendidikan</h2>
      <?php foreach ($pendidikan as $edu) : ?>
        <div class="list-item">
          <strong><?= $edu['tahun'] ?></strong>
          <p><?= $edu['riwayat'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- PENGALAMAN -->
    <div class="section">
      <h2>Pengalaman</h2>
      <ul>
        <?php foreach ($pengalaman as $exp) : ?>
          <li><strong><?= $exp['judul'] ?></strong><br><?= $exp['deskripsi'] ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- KEAHLIAN -->
    <div class="section">
      <h2>Keahlian</h2>
      <ul>
        <?php foreach ($keahlian as $skill) : ?>
          <li><?= $skill ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- BAHASA -->
    <div class="section">
      <h2>Bahasa</h2>
      <ul>
        <?php foreach ($bahasa as $lang) : ?>
          <li><?= $lang ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

  </div>
</body>
</html>

