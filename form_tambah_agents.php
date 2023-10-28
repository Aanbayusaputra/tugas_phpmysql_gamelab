<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Tambah Agent Baru</title>
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
    <form id="addAgentForm" action="proses_tambah_agents.php" method="post">
        <h1>Tambah Agent Baru</h1>
        <label for="agent_code">Agent Code:</label>
        <input type="text" id="agent_code" name="agent_code" required>

        <label for="agent_name">Agent Name:</label>
        <input type="text" id="agent_name" name="agent_name" required>

        <label for="working_area">Working Area:</label>
        <input type="text" id="working_area" name="working_area" required>

        <label for="commission">Commission:</label>
        <input type="text" id="commission" name="commission" required>

        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country">

        <div class="btn-container">
            <input type="submit" value="Submit">
            <br>
            <a href="list_daftar_agents.php"><input type="button" value="Kembali"></a>
        </div>
    </form>

    <script>
        document.getElementById('addAgentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ambil data formulir
            var formData = new FormData(this);

            // Lakukan AJAX request
            fetch('proses_tambah_agents.php', {
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
                            window.location.href = 'list_daftar_agents.php';
                        });
                    } else {
                        // Tampilkan pesan error terlebih dahulu
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Gagal Menambahkan data',
                            text: data.message,
                            footer: '<a href="">Why do I have this issue?</a>'
                        }).then(function() {
                            // Jika diperlukan, lakukan tindakan tambahan setelah menampilkan pesan error
                            // Contoh: reset formulir, fokus ke elemen tertentu, dll.
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