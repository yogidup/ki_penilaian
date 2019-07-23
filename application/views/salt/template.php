<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php echo $page_info['site_title'];?></title>

    <!-- Template & FontAwesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/');?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/fontawesome/');?>css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/');?>css/main.css">

    <!-- Datatables -->
    <link href="<?php echo base_url('assets/datatables/');?>jquery.dataTables.min.css" rel="stylesheet">
	<script src="<?php echo base_url('assets/datatables/');?>jquery-3.3.1.js"></script>
	<script src="<?php echo base_url('assets/datatables/');?>jquery.dataTables.min.js"></script>
	
	<!-- Sweet Alert 2 -->
	<script src="<?php echo base_url('assets/swal2/');?>sweetalert2.all.min.js"></script>
	<script src="<?php echo base_url('assets/swal2/');?>promise-polyfill"></script>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-white flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-2 text-center" href="<?php echo base_url('index.php/salt/');?>"><?php echo $admin['first_name'].' '.$admin['last_name']?></a>
        <div class="navbar-nav px-3" style="width: 100%;">
            <div class="d-flex align-items-center justify-content-between">
                <ul class="arrow-section m-0">
                    <?php echo $page_info['page_title'];?>
                </ul>
                <a class="btn btn-danger btn-sm" style="font-size: 0.8rem;" href="<?php echo base_url('index.php/admin_login/end_session/');?>"><i class="fa fa-power-off" aria-hidden="true"></i> Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar mt-4">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/salt/');?>">
                                <i class="fa fa-home" aria-hidden="true"></i> 
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/admin/');?>">
                                <i class="fa fa-user" aria-hidden="true"></i> 
                                Admin
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="<?php echo base_url('index.php/division/');?>">
                                <i class="fa fa-university" aria-hidden="true"></i>
                                Divisi
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="<?php echo base_url('index.php/role/');?>">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                Jabatan
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="<?php echo base_url('index.php/aspect/');?>">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                Aspek Penilaian
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="<?php echo base_url('index.php/permission/');?>">
                                <i class="fa fa-gavel" aria-hidden="true"></i>
                                Hak Akses
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="<?php echo base_url('index.php/user/');?>">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Pengguna
                            </a>
                        </li>
                        <!-- li class="nav-item ">
                            <a class="nav-link " href="#">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                Evaluasi
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="#">
                                <i class="fa fa-newspaper" aria-hidden="true"></i>
                                Laporan Evaluasi
                            </a>
                        </li -->
                    </ul>
                </div>
            </nav>

            <main id="tables" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-4">
				<?php echo $main_content;?>
            </main>
        </div>
    </div>
</body>

</html>
