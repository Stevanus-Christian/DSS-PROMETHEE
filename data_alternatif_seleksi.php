<h1>Data Alternatif Untuk Setiap Seleksi</h1>
<?php 
$txtcari=antiinjec($koneksi,@$_POST['txtcari']);
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
?>
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="9%">Pencarian:</td>
    <td width="14%"><input name="txtcari" type="text" size="30" value="<?php echo"$txtcari"; ?>"/></td>
    <td width="14%">
    <select name="seleksi">
    	<?php 
		$q_bea="SELECT id_seleksi, seleksi, tahun FROM seleksi ORDER BY tahun DESC, seleksi ASC";
		$h_bea=$koneksi->query($q_bea);
		while($d_bea=mysqli_fetch_array($h_bea)){
		?>
			<option value="<?php echo $d_bea['id_seleksi']; ?>" <?php if($d_bea['id_seleksi']==$seleksi) { echo "selected"; } ?>>
            	<?php echo $d_bea['tahun']." - ".$d_bea['seleksi']; ?>
            </option>
        <?php		
		}
		?>
    </select>
    </td>
    <td width="77%"><input name="" type="submit" value="Tampilkan" class="tombol"/></td>
  </tr>
</table>
</form>
<?php
if($seleksi=="") {
  $q_bea="SELECT id_seleksi FROM seleksi ORDER BY tahun DESC, seleksi ASC LIMIT 0, 1";
  $h_bea=$koneksi->query($q_bea);
  $d_bea=mysqli_fetch_array($h_bea);
  $seleksi=$d_bea['id_seleksi'];
}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
  	<th width="2%">No.</th>
    <th width="11%">Kode</th>
    <th width="82%">Alternatif</th>
	<script type="text/javascript">
    function konTambah() {
            window.location = "?page=kk-input&act=tambah";
    }
    </script>
    <th width="5%" align="center">
    <form method="post" enctype="multipart/form-data" action="?page=alternatifseleksi-input&act=tambah">
        <input type="hidden" name="seleksi" value="<?php echo $seleksi; ?>" />
        <input type='submit' class='tombol' value='Tambah'>
    </form>
    </th>
  </tr>
<?php
$halaman=@$_GET['halaman'];
$perhalaman=15;
$query_part ="SELECT c.id_seleksi_alternatif, a.id_alternatif, a.kode, a.alternatif
			  FROM alternatif as a, seleksi_alternatif as c
	    	  WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND
			  		(a.kode LIKE '%$txtcari%' OR a.alternatif LIKE '%$txtcari%')";
$hasil_part = $koneksi->query($query_part);
$jmlhalaman_part = ceil(mysqli_num_rows($hasil_part)/$perhalaman);

if (!isset($halaman))
{
$halaman=0;
}
else
{
$halaman=$halaman-1;
}
$halamannya = $halaman * $perhalaman;

$nomor=$halamannya;
$query="SELECT c.id_seleksi_alternatif, a.id_alternatif, a.kode, a.alternatif
			  FROM alternatif as a, seleksi_alternatif as c
	    	  WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND
			  		(a.kode LIKE '%$txtcari%' OR a.alternatif LIKE '%$txtcari%')
			  ORDER BY c.id_seleksi_alternatif ASC LIMIT $halamannya, $perhalaman" ;
$hquery=$koneksi->query($query);
while ($dataquery=mysqli_fetch_array($hquery)) {
$nomor=$nomor+1;
?>
<script type="text/javascript">
function konfirmasi<?php echo $dataquery[0]; ?>() {
	var answer = confirm("Anda yakin akan menghapus data ini?")
	if (answer){
		window.location = "aksi_alternatif_seleksi.php?act=hapus&id=<?php echo"$dataquery[id_seleksi_alternatif]"; ?>";
	}
}
</script>
  <tr>
  	<td><?php echo"$nomor"; ?></td>
    <td><?php echo"$dataquery[kode]"; ?></td>
    <td><?php echo"$dataquery[alternatif]"; ?></td>
    <td style="text-align:center;">
    <img src="./images/bt_del.png" width="20" alt="Hapus" border="0" title="Hapus Data" style="float:left; cursor:pointer;" onclick="konfirmasi<?php echo $dataquery[0]; ?>()"/>
    </td>
  </tr>
<?php
}
?>
</table>
<div style="margin-top:15px; padding-top:10px; clear:both; line-height:normal;">
		<div style="padding:3px; margin:1px; border:1px solid; border-color:#999999; background-color:#666666; color:#CCCCCC; float:left;">Halaman :</div> 
          <?php
			for($j=1;$j<($jmlhalaman_part+1);$j++)
			{
			?>
			<div style="padding:3px; margin:1px; border:1px solid; border-color:#77BBFF; <?php if (($halaman+1)==$j) { echo"background-color:#FFF"; } else {  echo"background-color:#B0D8FF"; } ?>; float:left;"><a href="?page=alternatif-seleksi&halaman=<?php echo"$j"; ?><?php if(@$kat<>"") { echo"&kat=@$kat"; } ?>" title="Halaman : <?php echo"$j"; ?>" style="text-decoration:none; color:#06C;"><?php echo"$j"; ?></a></div>
			<?php }
		?>
</div>