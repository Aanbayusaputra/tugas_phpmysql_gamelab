<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "coba";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Gagal terhubung dengan database: " . $conn->connect_error);
}
// echo "Koneksi berhasil terhubung";
