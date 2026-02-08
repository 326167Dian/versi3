<?php
session_start();
error_reporting(0);
include "timeout.php";
include "../configurasi/koneksi.php";

$nama = $db->prepare("SELECT * FROM setheader");
$nama->execute();
$r = $nama->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['login'] == 1) {
	if (!cek_login()) {
		$_SESSION['login'] = 0;
	}
}
if ($_SESSION['login'] == 0) {
	header('location:logout.php');
} else {
	if (empty($_SESSION['username']) and empty($_SESSION['passuser']) and $_SESSION['login'] == 0) {
		echo "<link href=css/style.css rel=stylesheet type=text/css>";
		echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
	} else {
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>SMART INVENTORY FOR APOTEK</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/mysifalogo.ico" />
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/vendors.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/daterangepicker.min.css" />
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/theme.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bs3-compat.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/custom-toast.css" />
    <!--! END: Custom CSS-->
    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <!--[if lt IE 9]>
			<script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
	<!--Font Awesome-->
	<link rel="stylesheet" href="assets/vendors/css/fontawesome.min.css" />
	<!--DataTable-->
	<link rel="stylesheet" href="assets/vendors/css/dataTables.bs5.min.css">
	
	<!--! Load jQuery early so modules can use it !-->
	<script src="assets/vendors/js/jquery.min.js"></script>
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Navigation Manu !-->
    <!--! ================================================================ !-->
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header bg-gray-300">
                <a href="index.html" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/mysifalogo.png" alt="" class="logo logo-sm" />
                    <span class="logo-mini"><marquee><b><?= $r['satu']  ?></b></marquee></span>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="?module=home" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Dashboards</span>
                        </a>
                        
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-database"></i></span>
                            <span class="nxl-mtext">Data Master</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <?php if ($_SESSION['mpengguna'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=admin"><i class="fa fa-user"></i> Operator</a></li><?php } ?>
							<?php if ($_SESSION['mheader'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=setheader"><i class="fa fa-align-center"></i> Header Struk</a></li><?php } ?>
							<?php if ($_SESSION['mjenisbayar'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=carabayar"><i class="fa fa-barcode"></i> Jenis Pembayaran</a></li><?php } ?>
							<?php if ($_SESSION['mpelanggan'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=pelanggan"><i class="fa fa-users"></i> Pelanggan</a></li><?php } ?>
							<?php if ($_SESSION['msupplier'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=supplier"><i class="fa fa-truck"></i> Supplier</a></li><?php } ?>
							<?php if ($_SESSION['msatuan'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=satuan"><i class="fa fa-flag"></i> Satuan</a></li><?php } ?>
							<?php if ($_SESSION['mjenisobat'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=jenisobat"><i class="fa fa-tags"></i> Jenis Obat & Rak Obat</a></li><?php } ?>
							<?php if ($_SESSION['mbarang'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=barang"><i class="fa fa-book"></i> Item Barang</a></li><?php } ?>
							<?php if ($_SESSION['komisi'] == "Y") { ?><li class="nxl-item"><a class="nxl-link" href="?module=komisi"><i class="fa fa-usd"></i> Komisi Pegawai</a></li><?php } ?>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-briefcase"></i></span>
                            <span class="nxl-mtext">Inventory</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="apps-chat.html">Chat</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="apps-email.html">Email</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="apps-tasks.html">Tasks</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="apps-notes.html">Notes</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="apps-storage.html">Storage</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="apps-calendar.html">Calendar</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-dollar-sign"></i></span>
                            <span class="nxl-mtext">Transaksi</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="proposal.html">Proposal</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="proposal-view.html">Proposal View</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="proposal-edit.html">Proposal Edit</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="proposal-create.html">Proposal Create</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-trending-up"></i></span>
                            <span class="nxl-mtext">Laporan</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="payment.html">Payment</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="invoice-view.html">Invoice View</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="invoice-create.html">Invoice Create</a></li>
                        </ul>
                    </li>
                    
                </ul>
                
            </div>
        </div>
    </nav>
    <!--! ================================================================ !-->
    <!--! [End]  Navigation Manu !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Header !-->
    <!--! ================================================================ !-->
    <header class="nxl-header">
        <div class="header-wrapper bg-gray-300">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-4">
                <!--! [Start] nxl-head-mobile-toggler !-->
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <!--! [Start] nxl-head-mobile-toggler !-->
                <!--! [Start] nxl-navigation-toggle !-->
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <!--! [End] nxl-navigation-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu-toggle !-->
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                        <i class="feather-align-left"></i>
                    </a>
                </div>
                <!--! [End] nxl-lavel-mega-menu-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu !-->
                <div class="nxl-drp-link nxl-lavel-mega-menu">
                    <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                        <a href="javascript:void(0)" id="nxl-lavel-mega-menu-hide">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!--! [End] nxl-lavel-mega-menu !-->
            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0" onclick="$('body').fullScreenHelper('toggle');">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="dropdown nxl-h-item">
                        <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button" data-bs-auto-close="outside">
                            <i class="feather-bell"></i>
                            <span class="badge bg-danger nxl-h-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                            <div class="d-flex justify-content-between align-items-center notifications-head">
                                <h6 class="fw-bold text-dark mb-0">Notifications</h6>
                                <a href="javascript:void(0);" class="fs-11 text-success text-end ms-auto" data-bs-toggle="tooltip" title="Make as Read">
                                    <i class="feather-check"></i>
                                    <span>Make as Read</span>
                                </a>
                            </div>
                            <div class="notifications-item">
                                <img src="assets/images/avatar/2.png" alt="" class="rounded me-3 border" />
                                <div class="notifications-desc">
                                    <a href="javascript:void(0);" class="font-body text-truncate-2-line"> <span class="fw-semibold text-dark">Malanie Hanvey</span> We should talk about that at lunch!</a>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="notifications-date text-muted border-bottom border-bottom-dashed">2 minutes ago</div>
                                        <div class="d-flex align-items-center float-end gap-2">
                                            <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300" data-bs-toggle="tooltip" title="Make as Read"></a>
                                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="feather-x fs-12"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="notifications-item">
                                <img src="assets/images/avatar/3.png" alt="" class="rounded me-3 border" />
                                <div class="notifications-desc">
                                    <a href="javascript:void(0);" class="font-body text-truncate-2-line"> <span class="fw-semibold text-dark">Valentine Maton</span> You can download the latest invoices now.</a>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="notifications-date text-muted border-bottom border-bottom-dashed">36 minutes ago</div>
                                        <div class="d-flex align-items-center float-end gap-2">
                                            <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300" data-bs-toggle="tooltip" title="Make as Read"></a>
                                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="feather-x fs-12"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="notifications-item">
                                <img src="assets/images/avatar/4.png" alt="" class="rounded me-3 border" />
                                <div class="notifications-desc">
                                    <a href="javascript:void(0);" class="font-body text-truncate-2-line"> <span class="fw-semibold text-dark">Archie Cantones</span> Don't forget to pickup Jeremy after school!</a>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="notifications-date text-muted border-bottom border-bottom-dashed">53 minutes ago</div>
                                        <div class="d-flex align-items-center float-end gap-2">
                                            <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300" data-bs-toggle="tooltip" title="Make as Read"></a>
                                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="feather-x fs-12"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center notifications-footer">
                                <a href="javascript:void(0);" class="fs-13 fw-semibold text-dark">Alls Notifications</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                            <img src="assets/images/usericon_doctor.png" alt="user-image" class="img-fluid user-avtar me-0" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/usericon_doctor.png" alt="user-image" class="img-fluid user-avtar" />
                                    <div>
                                        <h6 class="text-dark mb-0"><?=$_SESSION['namauser']?></h6>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <span class="hstack">
                                    <i class="wd-10 ht-10 border border-2 border-gray-1 bg-success rounded-circle me-2"></i>
                                    <span>Active</span>
                                </span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Profile Details</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item">
                                <i class="feather-log-out"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>
    <!--! ================================================================ !-->
    <!--! [End] Header !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="mb-2">Dashboard</h5>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="?module=<?=$_GET['module']?>"><?=ucwords($_GET['module'])?></a></li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
					<div class="card stretch stretch-full table-responsive">
                        <?php include "content_admin.php"; ?>
					    <!--<div class="card-body">-->
         <!--               </div>-->
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
        <!-- [ Footer ] start -->
        <!--<footer class="footer">-->
        <!--    <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">-->
        <!--        <span>Copyright ©</span>-->
        <!--        <script>-->
        <!--            document.write(new Date().getFullYear());-->
        <!--        </script>-->
        <!--    </p>-->
        <!--    <p><span>By: <a target="_blank" href="https://wrapbootstrap.com/user/theme_ocean" target="_blank">theme_ocean</a></span> • <span>Distributed by: <a target="_blank" href="https://themewagon.com" target="_blank">ThemeWagon</a></span></p>-->
        <!--    <div class="d-flex align-items-center gap-4">-->
        <!--        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>-->
        <!--        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>-->
        <!--        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>-->
        <!--    </div>-->
        <!--</footer>-->
        <!-- [ Footer ] end -->
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="assets/vendors/js/vendors.min.js"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="assets/vendors/js/daterangepicker.min.js"></script>
    <script src="assets/vendors/js/apexcharts.min.js"></script>
    <script src="assets/vendors/js/circle-progress.min.js"></script>
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="assets/js/common-init.min.js"></script>
    <?php if (empty($_GET['module']) || $_GET['module'] == 'home') { ?>
    <script src="assets/js/dashboard-init.min.js"></script>
    <?php } ?>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="assets/js/theme-customizer-init.min.js"></script>
    <!--! END: Theme Customizer !-->
    
    <script src="assets/vendors/js/dataTables.min.js"></script>
    <script src="assets/vendors/js/dataTables.bs5.min.js"></script>
    <script src="assets/js/bs3-compat.js"></script>
    <script>
    	$(function() {
    		if($("#example1").length) $("#example1").DataTable();
    		if($("#example3").length) $("#example3").DataTable();
    		if($("#example4").length) $("#example4").DataTable();
    		if($('#example2').length) {
    			$('#example2').DataTable({
    				"paging": true,
    				"lengthChange": true,
    				"searching": true,
    				"ordering": true,
    				"info": true,
    				"autoWidth": true
    			});
    		}
    	});

    	function formatRupiah(num) {
    		let rupiahFormat = new Intl.NumberFormat('id-ID', {
    			currency: 'IDR',
    		}).format(num);

    		return rupiahFormat;
    	}

    </script>
</body>

</html>
<?php
	}
}
?>