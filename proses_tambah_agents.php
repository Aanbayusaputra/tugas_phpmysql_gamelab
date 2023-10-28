<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $agent_code = $_POST['agent_code'];
    $agent_name = $_POST['agent_name'];
    $working_area = $_POST['working_area'];
    $commission = $_POST['commission'];
    $phone_no = $_POST['phone_no'];
    $country = $_POST['country'];

    // Insert data ke tabel AGENTS
    $sql = "INSERT INTO AGENTS (AGENT_CODE, AGENT_NAME, WORKING_AREA, COMMISSION, PHONE_NO, COUNTRY)
            VALUES ('$agent_code', '$agent_name', '$working_area', '$commission', '$phone_no', '$country')";

    if ($conn->query($sql) === TRUE) {
        $response = [
            'success' => true,
            'message' => 'Data berhasil ditambahkan'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Gagal menambahkan data: ' . $conn->error
        ];
    }

    // Mengembalikan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
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
