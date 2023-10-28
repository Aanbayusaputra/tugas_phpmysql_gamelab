<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cust_code'])) {
    $cust_code = $_GET['cust_code'];

    // Hapus data dari database
    $sql = "DELETE FROM CUSTOMER WHERE CUST_CODE='$cust_code'";

    if ($conn->query($sql) === TRUE) {
        // Pesan berhasil dihapus
        $response = [
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ];
    } else {
        // Pesan gagal dihapus
        $response = [
            'success' => false,
            'message' => 'Gagal menghapus data: ' . $conn->error
        ];
    }

    // Mengembalikan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Jika bukan request GET atau tidak ada parameter cust_code
    $response = [
        'success' => false,
        'message' => 'Invalid request!'
    ];

    // Mengembalikan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Tutup koneksi
$conn->close();
