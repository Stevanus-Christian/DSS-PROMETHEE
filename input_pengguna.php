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
	$query="SELECT * FROM pengguna WHERE id_pengguna='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Pengguna</h1>
<form action="aksi_pengguna.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
<table width="100%" cellpadding="10" cellspacing="0" border="0">
  <input type="hidden" name="id" value="<?php echo @$dataquery['id_pengguna']; ?>" />
  <tr>
    <td width="17%">Nama Lengkap</td>
    <td width="2%">:</td>
    <td width="81%"><input name="nama" type="text" size="50" maxlength="100" value="<?php echo @$dataquery['nama']; ?>" class="required"></td>
  </tr>
  <tr>
    <td>Tipe</td>
    <td>:</td>
    <td>
    <select name="tipe">
    	<option value="2" <?php if(@$dataquery['tipe']==2) { echo "selected"; } ?>>Petugas</option>
    	<option value="1" <?php if(@$dataquery['tipe']==1) { echo "selected"; } ?>>Administrator</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Username</td>
    <td>:</td>
    <td><input name="username" type="text" size="30" maxlength="100" value="<?php echo @$dataquery['username']; ?>" class="required"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td>:</td>
    <td><input name="pass1" type="password" size="30" value="<?php echo @$dataquery['password']; ?>" class="required"></td>
  </tr>
  <tr>
    <td>Ulangi Password</td>
    <td>:</td>
    <td><input name="pass2" type="password" size="30" value="<?php echo @$dataquery['password']; ?>" class="required"></td>
  </tr>
  <tr>
  	<td></td>
    <td></td>
    <td colspan="3"><input name="simpan" type="submit" value="Simpan" class="tombol2"></td>
  </tr>
</table>
</form>