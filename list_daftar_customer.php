<?php
include 'config.php';

$result = $conn->query("SELECT * FROM CUSTOMER");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Pastikan URL Font Awesome di atas sudah diperbarui sesuai versi terbaru -->
    <title>List Daftar Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 3px;
        }

        a:hover {
            background-color: #2980b9;
        }

        .action-column {
            text-align: center;
        }

        .action-column a {
            margin: 0 5px;
            color: #fff;
            border-radius: 3px;
            padding: 5px 10px;
            display: inline-block;
        }

        .edit-btn {
            background-color: #2ecc71;

        }

        .delete-btn {
            background-color: #e74c3c;

        }
    </style>
</head>

<body>
    <h1>List Daftar Customer</h1>
    <br>
    <a href="form_tambah_customer.php">Tambah Customer Baru</a>
    <a href="index.php">Kembali ke Halaman Utama</a>

    <table>
        <tr>
            <th>Customer Code</th>
            <th>Customer Name</th>
            <th>Customer City</th>
            <th>Working Area</th>
            <th>Customer Country</th>
            <th>Grade</th>
            <th>Opening Amount</th>
            <th>Receive Amount</th>
            <th>Payment Amount</th>
            <th>Outstanding Amount</th>
            <th>Phone No</th>
            <th>Agent Code</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['CUST_CODE']}</td>
                    <td>{$row['CUST_NAME']}</td>
                    <td>{$row['CUST_CITY']}</td>
                    <td>{$row['WORKING_AREA']}</td>
                    <td>{$row['CUST_COUNTRY']}</td>
                    <td>{$row['GRADE']}</td>
                    <td>{$row['OPENING_AMT']}</td>
                    <td>{$row['RECEIVE_AMT']}</td>
                    <td>{$row['PAYMENT_AMT']}</td>
                    <td>{$row['OUTSTANDING_AMT']}</td>
                    <td>{$row['PHONE_NO']}</td>
                    <td>{$row['AGENT_CODE']}</td>
                    <td class='action-column'>
                        <a href='form_edit_customer.php?cust_code={$row['CUST_CODE']}' class='edit-btn'><i class='fas fa-edit'></i>Edit</a>
                        <a href='proses_hapus_customer.php?cust_code={$row['CUST_CODE']}' class='delete-btn'><i class='fas fa-trash-alt'></i>Hapus</a>
                    </td>
                </tr>";
        }
        ?>
    </table>

    <script>
        // Tambahkan event listener pada class 'delete-btn'
        var deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Ambil URL dari tombol Hapus
                var deleteUrl = this.getAttribute('href');

                // Tampilkan SweetAlert konfirmasi
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan AJAX request untuk menghapus data
                        fetch(deleteUrl)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Tampilkan pesan berhasil dihapus
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: data.message
                                    }).then(function() {
                                        // Redirect ke halaman list daftar customer
                                        window.location.href = 'list_daftar_customer.php';
                                    });
                                } else {
                                    // Tampilkan pesan gagal dihapus
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                });
            });
        });
    </script>
</body>

</html>