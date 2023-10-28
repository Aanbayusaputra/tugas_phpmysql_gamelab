<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('https://mayang.klopos.com/image_spanduk/temp/530/530030275200221117234622.jpg');
            /* Ganti dengan URL atau path ke gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            color: #fff;
            overflow-x: hidden;
            /* Mengatasi scroll horizontal */
        }

        header {
            background-color: rgba(0, 0, 0, 0.7);
            /* Transparansi */
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
            /* Efek bayangan */
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: rgba(0, 0, 0, 0.5);
            /* Transparansi */
            padding: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            /* Efek bayangan */
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Warna ketika dihover */
        }

        ul {
            list-style: none;
            padding: 0;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            /* Transparansi */
            padding: 15px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.2);

        }
    </style>
</head>

<body>
    <header>
        <h1 style="margin: 0; font-size: 36px;">Halo, Selamat Datang</h1>
    </header>

    <nav>
        <ul>
            <li><a href="form_tambah_agents.php">Tambah Agent Baru</a></li>
            <li><a href="form_tambah_customer.php">Tambah Customer Baru</a></li>
            <li><a href="list_daftar_agents.php">List Daftar Agent</a></li>
            <li><a href="list_daftar_customer.php">List Daftar Customer</a></li>
        </ul>
    </nav>



    <footer>
        <p style="margin: 0;">&copy; 2023 Aan Bayu Saputra. All Rights Reserved.</p>
    </footer>
</body>

</html>