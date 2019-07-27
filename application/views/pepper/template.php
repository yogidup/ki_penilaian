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
	
	<!-- Sweet Chart JS -->
	<script src="<?php echo base_url('assets/chartjs/');?>Chart.bundle.min.js"></script>
    <link href="<?php echo base_url('assets/chartjs/');?>Chart.min.css" rel="stylesheet">
	<script src="<?php echo base_url('assets/chartjs/');?>Chart.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-white flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-2 text-center" href="<?php echo base_url('index.php/pepper/');?>"><?php echo $user['first_name'].' '.$user['last_name']?></a>
        <div class="navbar-nav px-3" style="width: 100%;">
            <div class="d-flex align-items-center justify-content-between">
                <ul class="arrow-section m-0">
                    <?php echo $page_info['page_title'];?>
                </ul>
                <?php if($this->session->userdata('admin_session') === TRUE):?>
                <a class="btn btn-info btn-sm" style="font-size: 0.8rem;" href="<?php echo base_url('index.php/user/');?>"><i class="fa fa-exclamation" aria-hidden="true"></i> Kembali ke daftar karyawan</a>
                <?php endif;?>
                <a class="btn btn-danger btn-sm" style="font-size: 0.8rem;" href="<?php echo base_url('index.php/login/end_session/');?>"><i class="fa fa-power-off" aria-hidden="true"></i> Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar mt-4">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/pepper/');?>">
                                <i class="fa fa-home" aria-hidden="true"></i> 
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/user_evaluation/');?>">
                                <i class="fa fa-newspaper" aria-hidden="true"></i> 
                                <?php if($user['priority'] == 1):?>
									Lihat Evaluasi
                                <?php else:?>
									Lihat Evaluasi Saya
                                <?php endif;?>
                            </a>
                        </li>
						<?php $check = $this->report_permission_model->get_permission(array('subject.id' => $user['id'], 'relation.permission' => 'edit'))->row_array();
						if($check == TRUE):?>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/user_report/');?>">
                                <i class="fa fa-magic" aria-hidden="true"></i> 
                                Buat Laporan Evaluasi
                            </a>
                        </li>
						<?php endif;?>
						<?php $check = $this->user_model->select_where(array('user.id' => $user['id']))->row_array();
						if($check['priority'] == 1):?>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/user_report/waiting_approval/');?>">
                                <i class="fa fa-coffee" aria-hidden="true"></i> 
                                Menunggu Persetujuan
                            </a>
                        </li>
						<?php endif;?>
						<hr />
                        <!-- li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/pepper/');?>">
                                <i class="fa fa-cog" aria-hidden="true"></i> 
                                Ganti Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('index.php/pepper/');?>">
                                <i class="fa fa-cog" aria-hidden="true"></i> 
                                Ganti Password
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
