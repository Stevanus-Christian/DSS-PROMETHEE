<h1>Data Nilai Kriteria Setiap Alternatif</h1>
<?php 
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
$stat=antiinjec($koneksi,@$_REQUEST['stat']);
?>
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%">Nama Seleksi</td>
    <td width="3%">
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
    <td width="83%"><input name="" type="submit" value="Tampilkan" class="tombol"/></td>
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


$qk="SELECT a.*, b.kriteria FROM seleksi_kriteria as a, kriteria as b WHERE a.id_kriteria=b.id_kriteria AND a.id_seleksi='$seleksi'";
$hk=$koneksi->query($qk);
$jmlkkolom=mysqli_num_rows($hk);
?>
<style>
	.test table { border:1px solid #000000; }
	.test table tr td { border:1px dotted #333333; }
	.test table tr th { border:1px dotted #333333; }
	.okok { background-color:#DDD; color:#09C; }
</style>
<div class="test2">
<form action="aksi_nilai.php" method="post" enctype="multipart/form-data" id="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <th width="24" rowspan="2">No.</th>
    <th width="74" rowspan="2">Kode</th>
    <th width="162" rowspan="2">Nama Alternatif</th>
    <th colspan="<?php echo $jmlkkolom; ?>"><div style="text-align:center;">Nilai Kriteria</div></th>
    </tr>
  <tr>
    <?php 
		while($dk=mysqli_fetch_array($hk)){
	?>
    <th width="97"><div style="text-align:center;"><?php echo "$dk[kriteria]"; ?></div></th>
    <?php } ?>
  </tr>
  
<?php
$no=0;
$queryX="SELECT a.id_alternatif, a.kode, a.alternatif, c.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as c
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' ORDER BY c.id_seleksi_alternatif ASC";
$hqueryX=$koneksi->query($queryX);
while ($dquX=mysqli_fetch_array($hqueryX)){
	$no=$no+1;
?>
  <tr>
    <td><?php echo"$no"; ?></td>
    <td><?php echo"$dquX[kode]"; ?></td>
    <td><?php echo"$dquX[alternatif]"; ?></td>
    <?php
		$urut=0;
		$qk2="SELECT a.*, b.kriteria FROM seleksi_kriteria as a, kriteria as b WHERE a.id_kriteria=b.id_kriteria AND a.id_seleksi='$seleksi'";
		$hk2=$koneksi->query($qk2);
		while($dk2=mysqli_fetch_array($hk2)){
			$urut=$urut+1;
    
		//Ambil Nilai yang sudah disimpan (lalu tampilkan)
		$qn="SELECT nilai FROM nilai_kriteria WHERE id_seleksi_kriteria='$dk2[0]' and id_seleksi_alternatif='$dquX[id_seleksi_alternatif]'";
		$hn=$koneksi->query($qn);
		$dn=mysqli_fetch_array($hn);
		?>
        <td>
        <div style="text-align:center;">
        <input type="text" name="nilai[<?php echo $dk2['id_seleksi_kriteria'];?>][<?php echo $dquX['id_seleksi_alternatif']; ?>]" value="<?php echo @$dn['nilai']; ?>" size="8">
        </div>
        </td>
    <?php } ?>
    </tr>
<?php } ?>
    <tr>
      <td>&nbsp;</td>
      <td>
      <input type="hidden" name="seleksi" value="<?php echo"$seleksi"; ?>" />
      <input type="submit" name="btn_simpan" value="Simpan" class="tombol2">
      </td>
      <td>&nbsp;</td>
      <td colspan="<?php echo $jmlkkolom; ?>"><?php if($stat=="ok") { ?> <span style="font-size:14px; color:#0066CC; font-weight:bold;"><?php echo "Data berhasil disimpan."; ?></span><?php } ?> </td>
    </tr>
</table>
</form>
</div>