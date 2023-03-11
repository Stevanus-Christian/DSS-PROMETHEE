<?php
include "./config/library.php";
include "./config/koneksi.php";


//ambil data yang didapat dari form
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$kode=antiinjec($koneksi,@$_POST['kode']);
$alternatif=antiinjec($koneksi,@$_POST['alternatif']);
$nama_orang_tua=antiinjec($koneksi,@$_POST['nama_orang_tua']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM alternatif WHERE kode='$kode'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO alternatif (kode, alternatif) VALUES ('$kode','$alternatif')";
		$koneksi->query($query);
		header("location:./?page=alternatif");
	} else {
		?>
		<script language="JavaScript">alert('Alternatif sudah terdaftar.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="edit" ) {
	$qcek = "SELECT count(*) as jumlah FROM alternatif WHERE kode='$kode' AND id_alternatif<>'$id'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE alternatif SET kode='$kode', alternatif='$alternatif'
				 WHERE id_alternatif='$id' ";
		$koneksi->query($query);
		header("location:./?page=alternatif");
	} else {
		?>
		<script language="JavaScript">alert('Alternatif sudah terdaftar.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from alternatif where id_alternatif='$id' ";
	$koneksi->query($query);
	header("location:./?page=alternatif");
}

?>


