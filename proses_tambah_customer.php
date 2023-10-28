<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil semua data dari form
    $cust_code = $_POST['cust_code'];
    $cust_name = $_POST['cust_name'];
    $cust_city = $_POST['cust_city'];
    $working_area = $_POST['working_area'];
    $cust_country = $_POST['cust_country'];
    $grade = $_POST['grade'];
    $opening_amt = $_POST['opening_amt'];
    $receive_amt = $_POST['receive_amt'];
    $payment_amt = $_POST['payment_amt'];
    $outstanding_amt = $_POST['outstanding_amt'];
    $phone_no = $_POST['phone_no'];
    $agent_code = $_POST['agent_code'];

    // Buat query SQL untuk menambahkan data ke tabel CUSTOMER
    $sql = "INSERT INTO CUSTOMER (CUST_CODE, CUST_NAME, CUST_CITY, WORKING_AREA, CUST_COUNTRY, GRADE, OPENING_AMT, RECEIVE_AMT, PAYMENT_AMT, OUTSTANDING_AMT, PHONE_NO, AGENT_CODE)
            VALUES ('$cust_code', '$cust_name', '$cust_city', '$working_area', '$cust_country', '$grade', '$opening_amt', '$receive_amt', '$payment_amt', '$outstanding_amt', '$phone_no', '$agent_code')";

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
