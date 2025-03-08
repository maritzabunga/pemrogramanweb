<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
$cvData = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cvData = [
        'name' => $_POST['name'],
        'birthdate' => $_POST['birthdate'],
        'introduction' => $_POST['introduction'],
        'education' => $_POST['education'],
        'experience' => $_POST['experience'],
        'skills' => $_POST['skills'],
        'photo' => $_FILES['photo']['name']
    ];

    // Upload foto
    move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $_FILES['photo']['name']);
    
    // Simpan data CV ke dalam session
    $_SESSION['cvData'] = $cvData;

    // Alihkan ke halaman cv.php
    header("Location: cv.php");
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
        }
        .container {
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: purple;
        }
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="file"] {
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: purple;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form CV</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nama" required>
            <input type="date" name="birthdate" placeholder="Tempat, Tanggal Lahir" required>
            <textarea name="introduction" placeholder="Introduction" required></textarea>
            <textarea name="education" placeholder="Riwayat Pendidikan" required></textarea>
            <textarea name="experience" placeholder="Pengalaman" required></textarea>
            <textarea name="skills" placeholder="Skill" required></textarea>
            <input type="file" name="photo" required>
            <input type="submit" value="Kirim">
        </form>
    </div>
</body>
</html>