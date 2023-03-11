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
	$query="SELECT id_seleksi_kriteria, id_seleksi, id_kriteria, bobot FROM seleksi_kriteria WHERE id_seleksi_kriteria='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Seleksi &amp; Kriteria</h1>
<form action="aksi_seleksi_kriteria.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
<table width="100%" cellpadding="10" cellspacing="0" border="0">
  <input type="hidden" name="id" value="<?php echo @$dataquery['id_seleksi_kriteria']; ?>" />
  <tr>
    <td width="16%">Nama Seleksi</td>
    <td width="2%">:</td>
    <td width="82%">
    <select name="seleksi">
    	<?php
        $q_bea="SELECT id_seleksi, seleksi, tahun FROM seleksi ORDER BY tahun DESC, seleksi ASC" ;
        $h_bea=$koneksi->query($q_bea);
        while($d_bea=mysqli_fetch_array($h_bea)) {
    	?>
		<option value="<?php echo $d_bea[0]; ?>" <?php if($d_bea[0]==@$dataquery['id_seleksi']) { echo "selected"; } ?>><?php echo $d_bea[2]; ?> - <?php echo $d_bea[1]; ?></option>
        <?php } ?>
    </select>
    </td>
  </tr>
  <tr>
    <td width="16%">Nama Kriteria</td>
    <td width="2%">:</td>
    <td width="82%">
    <select name="kriteria">
    	<?php
        $q_kri="SELECT id_kriteria, kriteria FROM kriteria ORDER BY kriteria ASC" ;
        $h_kri=$koneksi->query($q_kri);
        while($d_kri=mysqli_fetch_array($h_kri)) {
    	?>
		<option value="<?php echo $d_kri[0]; ?>" <?php if($d_kri[0]==@$dataquery['id_kriteria']) { echo "selected"; } ?>><?php echo $d_kri[1]; ?></option>
        <?php } ?>
    </select>
    </td>
  </tr>
  <tr>
    <td width="16%">Bobot Kriteria</td>
    <td width="2%">:</td>
    <td width="82%"><input name="bobot" type="text" size="10" maxlength="3" value="<?php echo @$dataquery['bobot']; ?>" class="required number"></td>
  </tr>
  <tr>
  	<td></td>
    <td></td>
    <td colspan="3"><input name="simpan" type="submit" value="Simpan" class="tombol2"></td>
  </tr>
</table>
</form>