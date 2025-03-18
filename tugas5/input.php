<?php
session_start();
if (!isset($_SESSION["email"])) {
  header("Location: index.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_destroy();
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #666;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h2 {
            color: #444;
            margin: 0;
        }
        .input-container {
            margin-bottom: 15px;
        }
        .input-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            height: 80px;
            resize: none;
        }
        .input-group {
            display: flex;
            gap: 10px;
        }
        .input-group input {
            flex: 1;
        }
        .form-section {
            display: flex;
            gap: 20px;
        }
        .form-section .left, .form-section .right {
            flex: 1;
        }
        .btn-logout {
            background-color: red;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-logout:hover {
            background-color: darkred;
        }
        .btn-submit {
            background-color: #CAB18E ;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
  <div class="container">
    <!-- HEADER -->
    <div class="header">
      <h2>Information CV</h2>
      <form method="post">
        <button class="btn-logout" type="submit">Logout</button>
      </form>
    </div>

    <!-- FORM -->
    <form method="post" action="cv.php" target="_blank" enctype="multipart/form-data">
      <div class="form-section">
        <div class="left">
          <div class="input-container">
            <label for="nama">Nama</label>
            <input id="nama" type="text" name="nama" placeholder="Nama" required>
          </div>
          <div class="input-container">
            <label for="ttl">Tempat, Tanggal Lahir</label>
            <input id="ttl" type="text" name="ttl" placeholder="Tempat, Tanggal Lahir" required>
          </div>
          <div class="input-container">
            <label for="telepon">No Telepon</label>
            <input id="telepon" type="text" name="telepon" placeholder="Masukkan Nomor Telepon Anda" required>
          </div>
          <div class="input-container">
            <label for="alamat">Alamat</label>
            <input id="alamat" type="text" name="alamat" placeholder="Alamat" required>
          </div>
        </div>

        <div class="right">
          <div class="input-container">
            <label for="about">Tentang Saya</label>
            <textarea id="about" name="about" placeholder="Isi deskripsi tentang Anda..." required></textarea>
          </div>
          <div class="input-container">
            <label for="foto">Foto</label>
            <input id="foto" type="file" name="foto" required>
          </div>
        </div>
      </div>

      <!-- Pendidikan -->
      <div class="input-container">
        <label for="pendidikan">Riwayat Pendidikan</label>
        <div class="input-group">
          <input type="text" name="thn-1" placeholder="cth: 2019-2020" required>
          <input type="text" name="pendidikan-1" placeholder="Riwayat Pendidikan 1" required>
        </div>
      </div>

      <!-- Keahlian -->
      <div class="input-container">
        <label for="keahlian">Keahlian</label>
        <input id="keahlian" type="text" name="keahlian" placeholder="cth: teamwork, public speaking" required>
      </div>

      <!-- Pengalaman -->
      <div class="input-container">
        <label for="pengalaman">Pengalaman</label>
        <div class="input-group">
          <input type="text" name="judul-1" placeholder="Judul pengalaman (cth: Magang di PT XYZ)" required>
        </div>
        <textarea name="pengalaman-1" placeholder="Deskripsi pengalaman..." required></textarea>
      </div>

      <!-- Bahasa -->
      <div class="input-container">
        <label for="bahasa">Bahasa</label>
        <input id="bahasa" type="text" name="bahasa" placeholder="cth: Inggris, Jepang, Spanyol" required>
      </div>

      <button class="btn-submit" type="submit">Simpan</button>
    </form>
  </div>
</body>

</html>