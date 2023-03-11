<?php 
$status=antiinjec($koneksi,@$_GET['act']);
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
$txtcari="";
?>
<h1><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Alternatif Untuk Setiap Seleksi</h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13%">Nama Seleksi :</td>
    <td width="87%">
    	<?php 
		$q_per="SELECT id_seleksi, seleksi, tahun FROM seleksi WHERE id_seleksi='$seleksi'";
		$h_per=$koneksi->query($q_per);
		$d_per=mysqli_fetch_array($h_per);
		echo $d_per['tahun']." - ".$d_per['seleksi'];
		?>
    </td>
  </tr>
</table>

<form action="aksi_alternatif_seleksi.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
<input type="hidden" name="seleksi" value="<?php echo $seleksi; ?>" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
  	<th width="2%">No.</th>
    <th width="2%" align="center"><img src="images/check.png" width="15"/></th>
    <th width="10%">Kode</th>
    <th width="86%">Alternatif</th>
  </tr>
<?php
$nomor=0;
$query="SELECT id_alternatif, kode, alternatif
		FROM alternatif as a
	    WHERE id_alternatif NOT IN (SELECT id_alternatif FROM seleksi_alternatif WHERE id_seleksi='$seleksi') AND
			  (kode LIKE '%$txtcari%' OR alternatif LIKE '%$txtcari%')
		ORDER BY kode ASC" ;
$hquery=$koneksi->query($query);
while ($dataquery=mysqli_fetch_array($hquery)) {
$nomor=$nomor+1;
?>
  <tr>
  	<td><?php echo"$nomor"; ?></td>
    <td align="center">
    <input type="checkbox" name="id_alternatif[]" value="<?php echo"$dataquery[id_alternatif]"; ?>"/>
    </td>
    <td><?php echo"$dataquery[kode]"; ?></td>
    <td><?php echo"$dataquery[alternatif]"; ?></td>
  </tr>
<?php
}
?>
<tr>
    <td colspan="10"><input type='submit' class='tombol' value='Simpan'></td>
</tr>
</table>
</form>