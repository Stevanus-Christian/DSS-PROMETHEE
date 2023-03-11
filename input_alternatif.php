<script type='text/javascript' src='./js/jquery.min.js?ver=3.1.2'></script>
<script type="text/javascript" src="./js/custom.js"></script>
<script type="text/javascript" src="./js/jquery.validate.js"></script>

<script type="text/javascript">
// Forms Validator
$j(function() {
   $j("#form1").validate();
});
</script>

<?php
$status=antiinjec($koneksi,@$_GET['act']);

if ($status=="edit") { $id=antiinjec($koneksi,@$_REQUEST['id']); }
if ($status=="tambah") { $id=0; }
	$query="SELECT id_alternatif, kode, alternatif FROM alternatif WHERE id_alternatif='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Peserta (Siswa-Siswi)</h1>
<form action="aksi_alternatif.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
<table width="100%" cellpadding="10" cellspacing="0" border="0">
  <input type="hidden" name="id" value="<?php echo @$dataquery['id_alternatif']; ?>" />
  <tr>
    <td width="16%">Kode</td>
    <td width="2%">:</td>
    <td width="82%"><input name="kode" type="text" size="25" maxlength="20" value="<?php echo @$dataquery['kode']; ?>" class="required number"></td>
  </tr>
  <tr>
    <td width="16%">Nama Alternatif</td>
    <td width="2%">:</td>
    <td width="82%"><input name="alternatif" type="text" size="40" maxlength="50" value="<?php echo @$dataquery['alternatif']; ?>" class="required"></td>
  </tr>
  <tr>
  	<td></td>
    <td></td>
    <td colspan="3"><input name="simpan" type="submit" value="Simpan" class="tombol2"></td>
  </tr>
</table>
</form>