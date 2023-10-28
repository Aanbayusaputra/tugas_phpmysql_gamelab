<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Edit Customer</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"],
        input[type="button"] {
            width: 100%;
            background-color: #000;
            color: #fff;
            border: 0;
            padding: 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #333;
        }

        .btn-container {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Edit Customer</h1>
    <?php
    include 'config.php';

    $cust_code = $_GET['cust_code'];
    $result = $conn->query("SELECT * FROM CUSTOMER WHERE CUST_CODE='$cust_code'");
    $row = $result->fetch_assoc();
    ?>

    <form id="updateForm" method="post">
        <input type="hidden" name="cust_code" value="<?php echo $row['CUST_CODE']; ?>">

        <label for="cust_name">Customer Name:</label>
        <input type="text" id="cust_name" name="cust_name" value="<?php echo $row['CUST_NAME']; ?>" required>

        <label for="cust_city">Customer City:</label>
        <input type="text" id="cust_city" name="cust_city" value="<?php echo $row['CUST_CITY']; ?>" required>

        <label for="working_area">Working Area:</label>
        <input type="text" id="working_area" name="working_area" value="<?php echo $row['WORKING_AREA']; ?>" required>

        <label for="cust_country">Customer Country:</label>
        <input type="text" id="cust_country" name="cust_country" value="<?php echo $row['CUST_COUNTRY']; ?>" required>

        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" value="<?php echo $row['GRADE']; ?>" required>

        <label for="opening_amt">Opening Amount:</label>
        <input type="text" id="opening_amt" name="opening_amt" value="<?php echo $row['OPENING_AMT']; ?>" required>

        <label for="receive_amt">Receive Amount:</label>
        <input type="text" id="receive_amt" name="receive_amt" value="<?php echo $row['RECEIVE_AMT']; ?>" required>

        <label for="payment_amt">Payment Amount:</label>
        <input type="text" id="payment_amt" name="payment_amt" value="<?php echo $row['PAYMENT_AMT']; ?>" required>

        <label for="outstanding_amt">Outstanding Amount:</label>
        <input type="text" id="outstanding_amt" name="outstanding_amt" value="<?php echo $row['OUTSTANDING_AMT']; ?>" required>

        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" value="<?php echo $row['PHONE_NO']; ?>" required>

        <label for="agent_code">Agent Code:</label>
        <input type="text" id="agent_code" name="agent_code" value="<?php echo $row['AGENT_CODE']; ?>" required>

        <div class="btn-container">
            <input type="submit" value="Update">
            <br>
            <a href="list_daftar_customer.php"><input type="button" value="Kembali"></a>
        </div>
    </form>

    <script>
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ambil data formulir
            var formData = new FormData(this);

            // Lakukan AJAX request
            fetch('proses_edit_customer.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Handle respons dari server
                    if (data.success) {
                        Swal.fire({
                            title: 'Do you want to save the changes?',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Save',
                            denyButtonText: 'Don\'t save',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire('Data berhasil diperbarui', '', 'success').then(function() {
                                    window.location.href = 'list_daftar_customer.php';
                                });
                            } else if (result.isDenied) {
                                Swal.fire({
                                    title: 'Changes are not saved',
                                    text: 'Are you sure you want to leave without saving?',
                                    // showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, leave',
                                    // denyButtonText: 'Tidak',
                                }).then((discardResult) => {
                                    if (discardResult.isConfirmed) {
                                        // Redirect ke halaman list daftar customer jika memilih untuk tidak menyimpan perubahan
                                        window.location.href = 'list_daftar_customer.php';
                                    }
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Perbarui data',
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

</body>

</html>