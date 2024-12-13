<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "project_web");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data statistik
$total_penduduk = $conn->query("SELECT COUNT(*) as total FROM penduduk_masuk")->fetch_assoc()['total'];
$total_kelahiran = $conn->query("SELECT COUNT(*) as total FROM kelahiran")->fetch_assoc()['total'];
$total_kematian = $conn->query("SELECT COUNT(*) as total FROM kematian")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Data Kependudukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Reset and General Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #2c3e50;
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .logo {
            padding: 20px;
            text-align: center;
        }

        .sidebar .logo img {
            width: 150px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            position: relative;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            text-decoration: none;
            color: #ecf0f1;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .sidebar ul li a i {
            margin-right: 15px;
            font-size: 20px;
        }

        .sidebar ul li .submenu {
            display: none;
            padding-left: 30px;
            background: #34495e;
        }

        .sidebar ul li.active .submenu {
            display: block;
        }

        .sidebar ul li .submenu li a {
            color: #bdc3c7;
            font-size: 14px;
        }

        .sidebar ul li .submenu li a:hover {
            color: #ecf0f1;
        }

        .sidebar .logout {
            margin-top: auto;
            padding: 15px 20px;
            background-color: #e74c3c;
            color: white;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .sidebar .logout:hover {
            background-color: #c0392b;
        }

        /* Content Styling */
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .card-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            width: calc(33.33% - 20px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card .icon {
            font-size: 40px;
            color: #3498db;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .card p {
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="icon/logo.png" alt="Logo">
        </div>
        <ul>
        <ul>
    <li>
    <ul>
    <li>
        <a href="dashboard.php">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="#" onclick="toggleMenu(this)">
            <i class="fas fa-table"></i>
            <span>Kelola Data</span>
        </a>
        <ul class="submenu">
            <li><a href="penduduk.php"><i class="far fa-circle"></i> Data Penduduk</a></li>
            <li><a href="data_kk.php"><i class="far fa-circle"></i> Data KK</a></li>
        </ul>
    </li>
    <li>
        <a href="#" onclick="toggleMenu(this)">
            <i class="fas fa-cogs"></i>
            <span>Sirkulasi Penduduk</span>
        </a>
        <ul class="submenu">
            <li><a href="data_lahir.php"><i class="far fa-circle"></i> Data Lahir</a></li>
            <li><a href="data_meninggal.php"><i class="far fa-circle"></i> Data Meninggal</a></li>
            <li><a href="data_pendatang.php"><i class="far fa-circle"></i> Data Pendatang</a></li>
            <li><a href="data_pindah.php"><i class="far fa-circle"></i> Data Pindah</a></li>
        </ul>
    </li>
    <li>
        <a href="#" onclick="toggleMenu(this)">
            <i class="fas fa-file"></i>
            <span>Kelola Surat</span>
        </a>
        <ul class="submenu">
            <li><a href="surat_domisili.php"><i class="far fa-circle"></i> Surat Keterangan Domisili</a></li>
            <li><a href="surat_kelahiran.php"><i class="far fa-circle"></i> Surat Keterangan Kelahiran</a></li>
            <li><a href="surat_kematian.php"><i class="far fa-circle"></i> Surat Keterangan Kematian</a></li>
            <li><a href="surat_pendatang.php"><i class="far fa-circle"></i> Surat Keterangan Pendatang</a></li>
            <li><a href="surat_pindah.php"><i class="far fa-circle"></i> Surat Keterangan Pindah</a></li>
        </ul>
    </li>
    <li>
        <a href="laporan.php">
            <i class="fas fa-chart-bar"></i>
            <span>Laporan</span>
        </a>
    </li>
</ul>


            </li>
        </ul>
        <div class="logout" onclick="logout()">Logout</div>
    </div>

    <div class="content">
        <h1>Selamat Datang, Admin!</h1>
        <div class="card-container">
            <div class="card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h3><?php echo $total_penduduk; ?></h3>
                <p>Total Penduduk</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-baby"></i></div>
                <h3><?php echo $total_kelahiran; ?></h3>
                <p>Total Kelahiran</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-skull-crossbones"></i></div>
                <h3><?php echo $total_kematian; ?></h3>
                <p>Total Kematian</p>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu(element) {
            const parent = element.parentElement;
            parent.classList.toggle('active');
        }

        function logout() {
            if (confirm("Anda yakin ingin logout?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</body>
</html>
