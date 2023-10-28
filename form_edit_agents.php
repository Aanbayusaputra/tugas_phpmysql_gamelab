<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Edit Agent</title>
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
    <form id="updateForm" action="proses_edit_agents.php" method="post">
        <h1>Edit Agent</h1>
        <?php
        include 'config.php';

        $agent_code = $_GET['agent_code'];
        $result = $conn->query("SELECT * FROM AGENTS WHERE AGENT_CODE='$agent_code'");
        $row = $result->fetch_assoc();
        ?>

        <input type="hidden" name="agent_code" value="<?php echo $row['AGENT_CODE']; ?>">

        <label for="agent_name">Agent Name:</label>
        <input type="text" id="agent_name" name="agent_name" value="<?php echo $row['AGENT_NAME']; ?>" required>

        <label for="working_area">Working Area:</label>
        <input type="text" id="working_area" name="working_area" value="<?php echo $row['WORKING_AREA']; ?>" required>

        <label for="commission">Commission:</label>
        <input type="text" id="commission" name="commission" value="<?php echo $row['COMMISSION']; ?>" required>

        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" value="<?php echo $row['PHONE_NO']; ?>" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" value="<?php echo $row['COUNTRY']; ?>" required>

        <div class="btn-container">
            <input type="submit" value="Submit">
            <br>
            <a href="list_daftar_agents.php"><input type="button" value="Kembali"></a>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ambil data formulir
            var formData = new FormData(this);

            // Lakukan AJAX request
            fetch('proses_edit_agents.php', {
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
                                    window.location.href = 'list_daftar_agents.php';
                                });
                            } else if (result.isDenied) {
                                Swal.fire({
                                    title: 'Changes are not saved',
                                    text: 'Are you sure you want to leave without saving?',
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, leave',
                                    cancelButtonText: 'No, stay'
                                }).then((leaveResult) => {
                                    if (leaveResult.isConfirmed) {
                                        window.location.href = 'list_daftar_agents.php';
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