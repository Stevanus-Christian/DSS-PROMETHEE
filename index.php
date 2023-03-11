<?php
include "./config/library.php";
include "./config/koneksi.php";

$ses_nama_pengguna=@$_SESSION['ses_nama_pengguna'];

if($ses_nama_pengguna=="")
{ 
	?>
	<script language="JavaScript">document.location='login.php'</script>
	<?php 
} else { 
	$queryadm="SELECT * FROM pengguna WHERE username='$ses_nama_pengguna'";
	$hasiladm=$koneksi->query($queryadm);
	$dataadm=mysqli_fetch_array($hasiladm);
	
	if($dataadm['tipe']==1) { $tipe_pengguna="Administrator"; }
	elseif($dataadm['tipe']==2) { $tipe_pengguna="Petugas"; }
?>
<!DOCTYPE html>
<title>Perhitungan Metode PROMETHEE | Sistem Pendukung Keputusan Metode PROMETHEE</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="styles/elegant-press.css" type="text/css" />
<script src="scripts/elegant-press.js" type="text/javascript"></script>
<!--[if IE]><style>#header h1 a:hover{font-size:75px;}</style><![endif]-->
</head>
<body>
<div class="main-container">
  <header>
    <h1><a href="http://anindyadev.com/source-code-program.htm" target="_blank">SPK METODE PROMETHEE</a></h1>
    <p id="tagline">Preference Ranking Organization Method for Enrichment Evaluation</p>
    
  <div id="sub-headline">
    <div class="tagline_left">&nbsp;&nbsp;Selamat Datang: <?php echo $dataadm['nama']." (".$tipe_pengguna; ?>) | 
    <a href="?page=ubah-password">Ubah Password</a> - <a href="logout.php">Logout</a></div>
    <br class="clear" />
  </div>
  </header>
</div>

<div class="main-container">
  <div id="nav-container">
   <nav> 
    <ul class="nav">
      <li><a href="./">Beranda</a></li>
      <li><a href="?page=seleksi">1. Seleksi</a>
      <li><a href="?page=kriteria">2. Kriteria</a></li>
      <li><a href="?page=seleksikriteria">3. Kriteria Seleksi</a>
      <li><a href="#">4. Data Alternatif</a>
        <ul>
          <li><a href="?page=alternatif">4.1 Daftar Alternatif</a>
          <li><a href="?page=alternatif-seleksi">4.2 Alternatif Yang Diseleksi</a></li>
        </ul>
      </li>
      <li><a href="?page=nilai">5. Data Nilai</a></li>
      <li><a href="?page=seleksi-proses"><b>6. Seleksi Promethee</b></a></li>
	  <?php if($dataadm['tipe']==1) { ?>
      <li><a href="?page=pengguna">Pengguna</a></li>
      <?php } ?>
    </ul>
   </nav> 
    <div class="clear"></div>
  </div>
</div>

<div class="main-container">
  <div class="container1">
    <div class="box">
    	<?php
			$page=antiinjec($koneksi,@$_GET['page']);
			if($page=="seleksi" && $dataadm['tipe']==1){ include "data_seleksi.php"; }	
			elseif($page=="seleksi-input" && $dataadm['tipe']==1){ include "input_seleksi.php"; }
			elseif($page=="kriteria" && $dataadm['tipe']==1){ include "data_kriteria.php"; }
			elseif($page=="kriteria-input" && $dataadm['tipe']==1){ include "input_kriteria.php"; }
			elseif($page=="seleksikriteria" && $dataadm['tipe']==1){ include "data_seleksi_kriteria.php"; }
			elseif($page=="seleksikriteria-input" && $dataadm['tipe']==1){ include "input_seleksi_kriteria.php"; }
			
			elseif($page=="alternatif"){ include "data_alternatif.php"; }
			elseif($page=="alternatif-input"){ include "input_alternatif.php"; }
			elseif($page=="alternatif-seleksi"){ include "data_alternatif_seleksi.php"; }
			elseif($page=="alternatifseleksi-input"){ include "input_alternatif_seleksi.php"; }	
			
			elseif($page=="pengguna" && $dataadm['tipe']==1){ include "data_pengguna.php"; }
			elseif($page=="pengguna-input" && $dataadm['tipe']==1){ include "input_pengguna.php"; }

			elseif($page=="nilai"){ include "data_nilai.php"; }
			elseif($page=="seleksi-proses"){ include "data_seleksi_hasil.php"; }
			elseif($page=="seleksi-rank"){ include "data_seleksi_rank.php"; }
			
			elseif($page=="ubah-password"){ include "set_password.php"; }
			else { 
        //include "";
      }
		?>
      <div class="clear"></div>
    </div>
  </div>

  <footer>
    <p class="tagline_left"><a href="" target="_blank">SPK Metode Promethee</a> | Developed By <a href="" target="_blank">anindyadev.com</a></p>
    <p class="tagline_right"></p>
    <br class="clear" />
  </footer>
  <br>
</div>
<!-- Free template distributed by http://freehtml5templates.com -->
    </body>
</html>
<?php } ?>