<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $update_query = "UPDATE CUSTOMER 
                     SET CUST_NAME='$cust_name', CUST_CITY='$cust_city', WORKING_AREA='$working_area',
                         CUST_COUNTRY='$cust_country', GRADE='$grade', OPENING_AMT='$opening_amt',
                         RECEIVE_AMT='$receive_amt', PAYMENT_AMT='$payment_amt', 
                         OUTSTANDING_AMT='$outstanding_amt', PHONE_NO='$phone_no', AGENT_CODE='$agent_code'
                     WHERE CUST_CODE='$cust_code'";

    $response = array(); // Inisialisasi array respons

    if ($conn->query($update_query) === TRUE) {
        $response['success'] = true; // Set status keberhasilan
        $response['message'] = 'Data berhasil diperbarui.';
    } else {
        $response['success'] = false; // Set status kegagalan
        $response['message'] = 'Data gagal diperbarui: ' . $conn->error;
    }

    // Kembalikan respons sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Jika bukan metode POST, kembalikan respons dengan status kegagalan
    $response['success'] = false;
    $response['message'] = 'Invalid request!';

    // Kembalikan respons sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
