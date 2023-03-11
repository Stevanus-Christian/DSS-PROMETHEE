<h1>Data Kriteria Untuk Setiap Seleksi</h1>
<?php 
$txtcari=antiinjec($koneksi,@$_POST['txtcari']);
?>
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="9%">Pencarian :</td>
    <td width="14%"><input name="txtcari" type="text" size="30" value="<?php echo"$txtcari"; ?>"/></td>
    <td width="77%"><input name="" type="submit" value="Cari" class="tombol"/></td>
  </tr>
</table>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
  	<th width="2%">No.</th>
    <th width="23%">Seleksi</th>
    <th width="22%">Kriteria</th>
    <th width="48%">Bobot</th>
	<script type="text/javascript">
    function konTambah() {
            window.location = "?page=seleksikriteria-input&act=tambah";
    }
    </script>
    <th width="5%" align="center"><input type='button' class='tombol' value='Tambah' onclick="konTambah()"></th>
  </tr>
<?php
$halaman=@$_GET['halaman'];
$perhalaman=15;
$query_part ="SELECT a.id_seleksi_kriteria, a.id_seleksi, a.id_kriteria, b.seleksi, c.kriteria, a.bobot
			  FROM seleksi_kriteria as a, seleksi as b, kriteria as c
	    	  WHERE a.id_seleksi=b.id_seleksi AND a.id_kriteria=c.id_kriteria AND 
			  		(b.seleksi LIKE '%$txtcari%' OR c.kriteria LIKE '%$txtcari%')";
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
$query="SELECT a.id_seleksi_kriteria, a.id_seleksi, a.id_kriteria, b.seleksi, c.kriteria, a.bobot
			  FROM seleksi_kriteria as a, seleksi as b, kriteria as c
	    	  WHERE a.id_seleksi=b.id_seleksi AND a.id_kriteria=c.id_kriteria AND 
			  		(b.seleksi LIKE '%$txtcari%' OR c.kriteria LIKE '%$txtcari%') ORDER BY b.seleksi ASC, c.id_kriteria ASC LIMIT $halamannya, $perhalaman" ;
$hquery=$koneksi->query($query);
while ($dataquery=mysqli_fetch_array($hquery)) {
$nomor=$nomor+1;
?>
<script type="text/javascript">
function konfirmasi<?php echo $dataquery[0]; ?>() {
	var answer = confirm("Anda yakin akan menghapus data ini?")
	if (answer){
		window.location = "aksi_seleksi_kriteria.php?act=hapus&id=<?php echo"$dataquery[0]"; ?>";
	}
}
</script>
  <tr>
  	<td><?php echo"$nomor"; ?></td>
    <td><?php echo"$dataquery[seleksi]"; ?></td>
    <td><?php echo"$dataquery[kriteria]"; ?></td>
    <td><?php echo"$dataquery[bobot]"; ?></td>
    <td align="center">
    <a href="?page=seleksikriteria-input&act=edit&id=<?php echo"$dataquery[0]"; ?>">
    <img src="./images/bt_edit.png" width="23" alt="Ubah" border="0" title="Ubah Data" style="float:left;"/>
    </a>
    <img src="./images/bt_del.png" width="23" alt="Hapus" border="0" title="Hapus Data" style="float:left; cursor:pointer;" onclick="konfirmasi<?php echo $dataquery[0]; ?>()"/>
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
			<div style="padding:3px; margin:1px; border:1px solid; border-color:#77BBFF; <?php if (($halaman+1)==$j) { echo"background-color:#FFF"; } else {  echo"background-color:#B0D8FF"; } ?>; float:left;"><a href="?page=seleksikriteria&halaman=<?php echo"$j"; ?><?php if(@$kat<>"") { echo"&kat=@$kat"; } ?>" title="Halaman : <?php echo"$j"; ?>" style="text-decoration:none; color:#06C;"><?php echo"$j"; ?></a></div>
			<?php }
		?>
</div>