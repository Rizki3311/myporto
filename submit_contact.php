<?php
$servername = "localhost";  // Nama host database
$username = "root";         // Username database
$password = "";             // Password database
$dbname = "db_form";         // Nama database

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Cegah SQL Injection
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$message = $conn->real_escape_string($message);

// Siapkan dan jalankan SQL
$sql = "INSERT INTO contact_messages(name, email, messages) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    // Tampilkan pesan sukses dan tombol kembali
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Success</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #000;
                margin: 0;
            }
            .success-container {
                background: yellow;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .success-container button {
                background-color: black;
                color: yellow;
                border-radius: 10px;
                font-weight: bold;
                padding: 10px 20px;
                border: 2px solid yellow;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .success-container button:hover {
                background-color: yellow;
            }
        </style>
    </head>
    <body>
        <div class='success-container'>
            <h1>PESAN BERHASIL DIKIRIM</h1>
            <button onclick='window.location.href=\"index.html\"'>Kembali ke Halaman Utama</button>
        </div>
    </body>
    </html>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>