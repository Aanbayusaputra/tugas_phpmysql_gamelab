<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Tambah Customer Baru</title>

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
    <h1>Tambah Customer Baru</h1>
    <form id="addCustomerForm" action="proses_tambah_customer.php" method="post">
        <label for="cust_code">Customer Code:</label>
        <input type="text" id="cust_code" name="cust_code" required>

        <label for="cust_name">Customer Name:</label>
        <input type="text" id="cust_name" name="cust_name" required>

        <label for="cust_city">Customer City:</label>
        <input type="text" id="cust_city" name="cust_city">

        <label for="working_area">Working Area:</label>
        <input type="text" id="working_area" name="working_area" required>

        <label for="cust_country">Customer Country:</label>
        <input type="text" id="cust_country" name="cust_country" required>

        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" required>

        <label for="opening_amt">Opening Amount:</label>
        <input type="text" id="opening_amt" name="opening_amt" required>

        <label for="receive_amt">Receive Amount:</label>
        <input type="text" id="receive_amt" name="receive_amt" required>

        <label for="payment_amt">Payment Amount:</label>
        <input type="text" id="payment_amt" name="payment_amt" required>

        <label for="outstanding_amt">Outstanding Amount:</label>
        <input type="text" id="outstanding_amt" name="outstanding_amt" required>

        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" required>

        <label for="agent_code">Agent Code:</label>
        <input type="text" id="agent_code" name="agent_code" required>


        <div class="btn-container">
            <input type="submit" value="Submit">
            <br>
            <a href="list_daftar_customer.php"><input type="button" value="Kembali"></a>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('addCustomerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ambil data formulir
            var formData = new FormData(this);

            // Lakukan AJAX request
            fetch('proses_tambah_customer.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Handle respons dari server
                    if (data.success) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = 'list_daftar_customer.php';
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Gagal Menambahkan data',
                            text: data.message,
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