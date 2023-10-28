<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $agent_code = $_GET['agent_code'];

    $sql = "DELETE FROM AGENTS WHERE AGENT_CODE='$agent_code'";

    $response = array(); // Inisialisasi array respons

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true; // Set status keberhasilan
        $response['message'] = 'Data berhasil dihapus.';
    } else {
        $response['success'] = false; // Set status kegagalan
        $response['message'] = 'Data gagal dihapus: ' . $conn->error;
    }

    // Kembalikan respons sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Jika bukan metode GET, kembalikan respons dengan status kegagalan
    $response['success'] = false;
    $response['message'] = 'Invalid request!';

    // Kembalikan respons sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
