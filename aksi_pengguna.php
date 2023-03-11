<?php
include "./config/library.php";
include "./config/koneksi.php";


//ambil data yang didapat dari form produk
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$nama=antiinjec($koneksi,@$_POST['nama']);
$tipe=antiinjec($koneksi,@$_POST['tipe']);
$username=antiinjec($koneksi,@$_POST['username']);
$pass1=antiinjec($koneksi,@$_POST['pass1']);
$pass2=antiinjec($koneksi,@$_POST['pass2']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM pengguna WHERE username='$username'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0 && $pass1!=$pass2) {
		?>
		<script language="JavaScript">alert('Password dan Ulangi Password tidak sama.'); history.go(-1); </script>
		<?php
	}
	elseif($dcek[0]==0 && $pass1==$pass2) {
		$query= "INSERT INTO pengguna
			(nama, username, tipe, password)
			 VALUES ('$nama','$username','$tipe', '".md5($pass1)."')";
		$koneksi->query($query);
		header("location:./?page=pengguna");
	} else {
		?>
		<script language="JavaScript">alert('Username sudah digunakan.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="edit" ) {
	$qcek = "SELECT count(*) as jumlah FROM pengguna WHERE username='$username' AND id_pengguna<>'$id'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0 && $pass1!=$pass2) {
		?>
		<script language="JavaScript">alert('Password dan Ulangi Password tidak sama.'); history.go(-1); </script>
		<?php
	}
	elseif($dcek[0]==0 && $pass1==$pass2 && strlen($pass1)<=20) {
		$query= "UPDATE pengguna SET 
			     nama='$nama', username='$username', tipe='$tipe', password='".md5($pass1)."'
				 where id_pengguna='$id' ";
		$koneksi->query($query);
		header("location:./?page=pengguna");
	} elseif($dcek[0]==0 && $pass1==$pass2 && strlen($pass1)>20) {
		$query= "UPDATE pengguna SET 
			     nama='$nama', username='$username', tipe='$tipe'
				 where id_pengguna='$id' ";
		$koneksi->query($query);
		header("location:./?page=pengguna");
	} else {
		?>
		<script language="JavaScript">alert('Username sudah digunakan.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from pengguna where id_pengguna='$id' ";
	$koneksi->query($query);
	header("location:./?page=pengguna");
}

?>


