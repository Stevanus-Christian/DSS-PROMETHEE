<?php
include("./config/library.php");
include("./config/koneksi.php");


$username=antiinjec($koneksi,@$_POST['username']);
$password=md5(antiinjec($koneksi,@$_POST['pass']));

$query="SELECT id_pengguna, username FROM pengguna WHERE username='$username' AND password='$password'";
$hasil=$koneksi->query($query);
$userjum=mysqli_fetch_array($hasil);
if (@$userjum['username']<>"") {

$_SESSION['ses_nama_pengguna']=@$userjum['username'];
?>

<script language="JavaScript">document.location='./'</script>
<?php
} else {
?>

<script language="JavaScript">
document.location='login.php?err=1'</script><?php
}
?>