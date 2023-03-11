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
	$query="SELECT id_seleksi, seleksi, tahun, keterangan FROM seleksi WHERE id_seleksi='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Seleksi</h1>
<form action="aksi_seleksi.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
<table width="100%" cellpadding="10" cellspacing="0" border="0">
  <input type="hidden" name="id" value="<?php echo"$dataquery[id_seleksi]"; ?>" />
  <tr>
    <td width="16%">Nama Seleksi</td>
    <td width="2%">:</td>
    <td width="82%"><input name="seleksi" type="text" size="30" maxlength="50" value="<?php echo @$dataquery['seleksi']; ?>" class="required"></td>
  </tr>
  <tr>
    <td width="16%">Tahun</td>
    <td width="2%">:</td>
    <td width="82%"><input name="tahun" type="text" size="10" maxlength="4" value="<?php echo @$dataquery['tahun']; ?>" class="required number"></td>
  </tr>
  <tr>
    <td width="16%">Keterangan</td>
    <td width="2%">:</td>
    <td width="82%"><textarea name="keterangan" rows="3" cols="29"><?php echo @$dataquery['keterangan']; ?></textarea></td>
  </tr>
  <tr>
  	<td></td>
    <td></td>
    <td colspan="3"><input name="simpan" type="submit" value="Simpan" class="tombol2"></td>
  </tr>
</table>
</form>