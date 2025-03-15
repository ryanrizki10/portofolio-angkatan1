<?php
require_once "../koneksi.php";
session_start();

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $foto = $_FILES['foto'];

    if ($foto['error'] == 0) {
        $fileName = uniqid() . '_' . basename($foto['name']);
        $filePath = "../assets/uploads/" . $fileName;
        move_uploaded_file($foto['tmp_name'], $filePath);

        $insert = mysqli_query($conn, "INSERT INTO project (nama, kategori, foto) VALUES ('$nama', '$kategori', '$$fileName')");
        if ($insert) {
            header("Location: project.php?kirim=sukses");
        } else {
            header("Location: tambah-project2.php?=erorr");
        }
    }
}


// $foto = $_FILES['nama'];




if (isset($_POST['simpan'])) {
    $nama_service = $_POST['nama_service'];
    $foto = $_FILES['foto'];

    if ($foto['error'] == 0) {
        $fileName = uniqid() . '_' . basename($foto['name']);
        $filePath = "../assets/uploads/" . $fileName;
        move_uploaded_file($foto['tmp_name'], $filePath);
    }

    $insert = mysqli_query($conn, "INSERT INTO services (nama_service, foto) VALUES ('$nama_service', '$fileName')");
    if ($insert) {
        header("Location: services.php");
    }

}








if (isset($_GET['idEdt'])) {
    $idEdt = base64_decode($_GET['idEdt']);
    $edit = mysqli_query($conn, "SELECT * FROM resume WHERE id = $idEdt");
    $rowEdt = mysqli_fetch_assoc($edit);
}
if (isset($_GET['idEdt']) && isset($_POST['edit'])) {
    $idEdt = base64_decode($_GET['idEdt']);

    $tahunAwal = $_POST['tahun_awal'];
    $tahunAkhir = $_POST['tahun_akhir'];
    $skill = $_POST['skill'];
    $instansi = $_POST['instansi'];
    $deskripsi = $_POST['deskripsi'];


    $update = mysqli_query($conn, "UPDATE resume SET tahun_awal='$tahunAwal', tahun_akhir='$tahunAkhir', skill='$skill', instansi='$instansi', deskripsi='$deskripsi'  WHERE id = $idEdt");

    if ($update) {
        header("Location: resume.php");
    } else {
        header("Location: editresume.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <?php require_once "../inc/navbar.php"; ?>
    <?php require_once "../inc/sidebar.php"; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Blank Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'EDIT' : 'ADD' ?>Project</h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Nama</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama Website" required
                                            value="<?php echo isset($_GET['edit']) ? $rowEdt['nama'] : ''; ?>">

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Kategori</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="kategori"
                                            placeholder="Masukkan Nama Kategori" required
                                            value="<?php echo isset($_GET['edit']) ? $rowEdt['kategori'] : ''; ?>">

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2">
                                            <label for="">Foto</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="foto">
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2 offset-md-2">
                                        <?php if (isset($_GET['edit'])) {
                                            ?>
                                            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                            <?php
                                        } ?>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>