<h1>Data Penentuan Alternatif Terbaik Metode PROMETHEE (Hasil Ranking)</h1>
<?php 
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);

if($seleksi!="") {	
?>
<h3>Hasil Ranking Berdasarkan PROMETHEE I</h3>
<p style="margin-bottom:10px; color:#999;">Alternatif dengan nilai Leaving Flow (LF) paling besar merupakan alternatif terbaik, dan alternatif dengan nilai entering Flow (EF) paling kecil adalah alternatif terbaik berdasarkan nilai EF. Jika ranking antara LF dan EF tidak sama maka dilanjutkan ke tahap Promethee II</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <th width="24" style="vertical-align:middle;">No.</th>
    <th width="80" style="vertical-align:middle;">Kode</th>
    <th width="162" style="vertical-align:middle;">Nama Alternatif</th>
    <th width="63" style="vertical-align:middle;">LF</th>
    <th width="63" style="vertical-align:middle;">Rank</th>
    <th width="80" style="vertical-align:middle;">Kode</th>
    <th width="162" style="vertical-align:middle;">Nama Alternatif</th>
    <th width="68" style="vertical-align:middle;">EF</th>
    <th width="76" style="vertical-align:middle;">Rank</th>
  </tr>
  
<?php
$no=0;
$no_i=0;

$queryX="SELECT a.id_alternatif FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY c.id_seleksi_alternatif ASC";
$hqueryX=$koneksi->query($queryX);
while ($dquX=mysqli_fetch_array($hqueryX)){
$no=$no+1;
?>
  <tr>
  	<?php
    $q_pes1="SELECT a.id_alternatif, a.kode, a.alternatif, c.id_seleksi_alternatif, d.nilai_lf, d.nilai_ef, d.nilai_nf FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
             WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY d.nilai_lf DESC LIMIT $no_i,$no";
    $h_pes1=$koneksi->query($q_pes1);
    $d_pes1=mysqli_fetch_array($h_pes1);
	?>
    <td><?php echo"$no"; ?></td>
    <td><?php echo"$d_pes1[kode]"; ?></td>
    <td><?php echo"$d_pes1[alternatif]"; ?></td>
    <td><?php echo number_format($d_pes1['nilai_lf'], 3, ',', '.'); ?></td>
    <td><?php echo"$no"; ?></td>
  	<?php
    $q_pes2="SELECT a.id_alternatif, a.kode, a.alternatif, c.id_seleksi_alternatif, d.nilai_lf, d.nilai_ef, d.nilai_nf FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
             WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY d.nilai_ef ASC LIMIT $no_i,$no";
    $h_pes2=$koneksi->query($q_pes2);
    $d_pes2=mysqli_fetch_array($h_pes2);
	?>
    <td><?php echo"$d_pes2[kode]"; ?></td>
    <td><?php echo"$d_pes2[alternatif]"; ?></td>
    <td><?php echo number_format($d_pes2['nilai_ef'], 3, ',', '.'); ?></td>
    <td><?php echo"$no"; ?></td>
    </tr>
<?php  $no_i=$no_i+1; } ?>
    <tr>
      <td colspan="9">
      <form action="cetak_promethee1.php" method="post" enctype="multipart/form-data" target="_blank">
      <input type="hidden" name="seleksi" value="<?php echo"$seleksi"; ?>" />
      <input type="submit" name="btn_next" value="Cetak" class="tombol2">
      </form>
      </td>
    </tr>
</table>
<br />
<h3>Hasil Ranking Berdasarkan PROMETHEE II</h3>
<p style="margin-bottom:10px; color:#999;">Alternatif dengan nilai Net Flow (NF) paling besar merupakan alternatif terbaik.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <th width="34" style="vertical-align:middle;">No.</th>
    <th width="132" style="vertical-align:middle;">Kode</th>
    <th width="251" style="vertical-align:middle;">Nama Alternatif</th>
    <th width="81" style="vertical-align:middle;">NF</th>
    <th width="732" style="vertical-align:middle;">Rank</th>
  </tr>
  
<?php
$no=0;

$q_pes1="SELECT  a.id_alternatif, a.kode, a.alternatif, c.id_seleksi_alternatif, d.nilai_lf, d.nilai_ef, d.nilai_nf FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY d.nilai_nf DESC";
$h_pes1=$koneksi->query($q_pes1);
while ($d_pes1=mysqli_fetch_array($h_pes1)){
$no=$no+1;
?>
  <tr>
    <td><?php echo"$no"; ?></td>
    <td><?php echo"$d_pes1[kode]"; ?></td>
    <td><?php echo"$d_pes1[alternatif]"; ?></td>
    <td><?php echo number_format($d_pes1['nilai_nf'], 3, ',', '.'); ?></td>
    <td><?php echo"$no"; ?></td>
  </tr>
<?php } ?>
    <tr>
      <td colspan="5">
      <form action="cetak_promethee2.php" method="post" enctype="multipart/form-data" target="_blank">
      <input type="hidden" name="seleksi" value="<?php echo"$seleksi"; ?>" />
      <input type="submit" name="btn_next" value="Cetak" class="tombol2">
      </form>
      </td>
    </tr>
</table>

<?php } ?>