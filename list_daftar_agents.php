<?php
include 'config.php';

// Inisialisasi variabel $result
$result = $conn->query("SELECT * FROM AGENTS");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>List Daftar Agent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
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

        .action-icons i {
            margin-right: 5px;
        }

        .delete-btn {
            color: #fff;
            background-color: #e74c3c;

        }
    </style>
</head>

<body>
    <h1>List Daftar Agent</h1>
    <br>
    <a href="form_tambah_agents.php">Tambah Agent Baru</a>
    <a href="index.php">Kembali ke Halaman Utama</a>

    <?php
    // Periksa apakah $result tidak null sebelum menggunakan fetch_assoc
    if ($result) :
    ?>
        <table>
            <tr>
                <th>Agent Code</th>
                <th>Agent Name</th>
                <th>Working Area</th>
                <th>Commission</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Action</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) :
            ?>
                <tr>
                    <td><?php echo $row['AGENT_CODE']; ?></td>
                    <td><?php echo $row['AGENT_NAME']; ?></td>
                    <td><?php echo $row['WORKING_AREA']; ?></td>
                    <td><?php echo $row['COMMISSION']; ?></td>
                    <td><?php echo $row['PHONE_NO']; ?></td>
                    <td><?php echo $row['COUNTRY']; ?></td>
                    <td class="action-icons">
                        <a href='form_edit_agents.php?agent_code=<?php echo $row['AGENT_CODE']; ?>'><i class='fas fa-edit'></i>Edit</a>
                        |
                        <a href='#' class='delete-btn' data-agent-code='<?php echo $row['AGENT_CODE']; ?>'><i class='fas fa-trash-alt'></i>Hapus</a>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>
        </table>
    <?php
    else :
        echo "<p>Tidak ada data</p>";
    endif;
    ?>

    <script>
        // Tambahkan event listener pada class 'delete-btn'
        var deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Ambil kode agen dari atribut data-agent-code
                var agentCode = this.getAttribute('data-agent-code');

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
                        fetch('proses_hapus_agents.php?agent_code=' + agentCode)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Tampilkan pesan berhasil dihapus
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: data.message
                                    }).then(function() {
                                        // Redirect ke halaman list daftar agen
                                        window.location.href = 'list_daftar_agents.php';
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