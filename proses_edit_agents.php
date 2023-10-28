<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agent_code = $_POST['agent_code'];
    $agent_name = $_POST['agent_name'];
    $working_area = $_POST['working_area'];
    $commission = $_POST['commission'];
    $phone_no = $_POST['phone_no'];
    $country = $_POST['country'];

    $sql = "UPDATE AGENTS SET AGENT_NAME='$agent_name', WORKING_AREA='$working_area', COMMISSION='$commission', PHONE_NO='$phone_no', COUNTRY='$country' WHERE AGENT_CODE='$agent_code'";

    if ($conn->query($sql) === TRUE) {
        $response = [
            'success' => true,
            'message' => 'Data berhasil diperbarui'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Gagal memperbarui data: ' . $conn->error
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
