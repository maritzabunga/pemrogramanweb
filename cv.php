<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

// Ambil data dari session
$cvData = $_SESSION['cvData'] ?? null;

if (!$cvData) {
    header("Location: form.php");
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        color: #2c3e50;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px;
        background-color: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    h2 {
        color: #6a1b9a;
        border-bottom: 3px solid #6a1b9a;
        padding-bottom: 10px;
        margin-bottom: 30px;
        text-align: left;
        font-size: 28px;
    }
    .cv-section {
        margin-bottom: 30px;
        padding: 15px;
        border-left: 3px solid #e1bee7;
        padding-left: 20px;
    }
    .cv-section h3 {
        color: #6a1b9a;
        margin: 0 0 15px 0;
        font-size: 20px;
        text-transform: uppercase;
    }
    img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        float: right;
        margin: -40px 0 20px 20px;
        border: 3px solid #6a1b9a;
    }
    .personal-info {
        overflow: hidden;
        margin-bottom: 30px;
    }
    .personal-info p {
        margin: 5px 0;
        font-size: 16px;
    }
    .personal-info strong {
        color: #6a1b9a;
        display: inline-block;
        width: 150px;
    }
    a {
        color: #6a1b9a;
        text-decoration: none;
        margin-right: 20px;
    }
    a:hover {
        text-decoration: underline;
    }
    .skills p {
        margin: 8px 0;
        padding-left: 20px;
        position: relative;
    }
    .skills p::before {
        content: "▹";
        color: #6a1b9a;
        position: absolute;
        left: 0;
    }
    .hobbies p {
        display: inline-block;
        background: #f3e5f5;
        padding: 5px 15px;
        border-radius: 15px;
        margin: 5px 3px;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Curriculum Vitae</h2>
        <div class="personal-info">
            <h3>Informasi Pribadi</h3>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($cvData['name']); ?></p>
            <p><strong>Tempat, Tanggal Lahir:</strong> <?php echo htmlspecialchars($cvData['birthdate']); ?></p>
            <img src="uploads/<?php echo htmlspecialchars($cvData['photo']); ?>" alt="Foto Anda">
        </div>
        <div class="cv-section">
            <h3>Introduction</h3>
            <p><?php echo nl2br(htmlspecialchars($cvData['introduction'])); ?></p>
        </div>
        <div class="cv-section">
            <h3>Riwayat Pendidikan</h3>
            <p><?php echo nl2br(htmlspecialchars($cvData['education'])); ?></p>
        </div>
        <div class="cv-section">
            <h3>Pengalaman Kerja</h3>
            <p><?php echo nl2br(htmlspecialchars($cvData['experience'])); ?></p>
        </div>
        <div class="cv-section">
            <h3>Skill</h3>
            <p><?php echo nl2br(htmlspecialchars($cvData['skills'])); ?></p>
        </div>
        <div class="cv-section">
            <a href="form.php">Edit CV</a> | <a href="index.php">Logout</a>
        </div>
    </div>
</body>
</html>