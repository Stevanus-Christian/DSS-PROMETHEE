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

if ($status=="edit") { $id=@$_REQUEST['id']; }
if ($status=="tambah") { $id=0; }
	$query="SELECT id_kriteria, kriteria, preferensi, tipe_preferensi, nilai_q, nilai_p FROM kriteria WHERE id_kriteria='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Kriteria</h1>
<form action="aksi_kriteria.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
<table width="100%" cellpadding="10" cellspacing="0" border="0">
  <input type="hidden" name="id" value="<?php echo"$dataquery[id_kriteria]"; ?>" />
  <tr>
    <td width="16%">Kriteria</td>
    <td width="2%">:</td>
    <td width="82%"><input name="kriteria" type="text" size="30" maxlength="50" value="<?php echo @$dataquery['kriteria']; ?>" class="required"></td>
  </tr>
  <tr>
    <td width="16%">Preferensi (Min/Max)</td>
    <td width="2%">:</td>
    <td width="82%">
    	<select name="preferensi">
        	<option value="Min" <?php if(@$dataquery['preferensi']=="Min") { echo "selected"; } ?>>Min</option>
        	<option value="Max" <?php if(@$dataquery['preferensi']=="Max") { echo "selected"; } ?>>Max</option>
        </select>
    </td>
  </tr>
  <tr>
    <td width="16%">Keterangan</td>
    <td width="2%">:</td>
    <td width="82%">
    	<select name="tipe_preferensi">
        	<option value="1" <?php if(@$dataquery['tipe_preferensi']==1) { echo "selected"; } ?>>Kriteria Biasa</option>
        	<option value="2" <?php if(@$dataquery['tipe_preferensi']==2) { echo "selected"; } ?>>Kriteria Quasi</option>
        	<option value="3" <?php if(@$dataquery['tipe_preferensi']==3) { echo "selected"; } ?>>Kriteria Linear</option>
        	<option value="4" <?php if(@$dataquery['tipe_preferensi']==4) { echo "selected"; } ?>>Kriteria Level</option>
        	<option value="5" <?php if(@$dataquery['tipe_preferensi']==5) { echo "selected"; } ?>>Kriteria Linear &amp; area tdk berbeda</option>
        </select>
    </td>
  </tr>
  <tr>
    <td width="16%">Nilai Min (Q)</td>
    <td width="2%">:</td>
    <td width="82%"><input name="nilai_q" type="text" size="10" maxlength="5" value="<?php echo @$dataquery['nilai_q']; ?>" class="required"></td>
  </tr>
  <tr>
    <td width="16%">Nilai Max (P)</td>
    <td width="2%">:</td>
    <td width="82%"><input name="nilai_p" type="text" size="10" maxlength="5" value="<?php echo @$dataquery['nilai_p']; ?>" class="required"></td>
  </tr>
  <tr>
  	<td></td>
    <td></td>
    <td colspan="3"><input name="simpan" type="submit" value="Simpan" class="tombol2"></td>
  </tr>
</table>
</form>