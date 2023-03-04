<?php
	session_start();
	include("koneksi.php");
	if (@$_SESSION['userlogin'] == "")
	{
		header("location:login.php?pesan=Belum Login");
		exit;
	}
?>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SPK - PROMETHEE</title>
        <link href="./assets/css/styles.css" rel="stylesheet" />
        <link href="./assets/css/style2.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
         <input type="checkbox" id="nav-toggle">
        <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span> <span style="font-size: 25px;">SPK PROMETHEE</span>  </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a style="text-decoration:none" href="admin.php"><span class="las la-igloo"></span><span>Dashboard</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="user.php" class="active"><span class="las la-user-circle"></span><span>Pengguna</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="alternatif.php"><span class="las la-clipboard-list"></span><span>Alternatif</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="kriteria.php"><span class="las la-clipboard-list"></span><span>Kriteria</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="alternatif-kriteria.php"><span class="las la-clipboard-list"></span><span>Alternatif Kriteria</span></a>
                </li>
            </ul>
        </div>
        </div>


        <div class="main-content">
        <header> 
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>

                Pengguna
            </h2>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here">
            </div>

            <ul class="navbar-nav ml-auto ml-md-0">
                 <li class="nav-item dropdown text-uppercase">
                  <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                    <img src="./assets/img/icon-user.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />
                    Hi, <?php echo $_SESSION['userlogin']; ?>
                  </a>
                  <div class="dropdown-menu">
                    <a href="logout.php" class="dropdown-item">Logout</a>
                </li>
            </ul>
        </header>
        <main>
                    <div class="container-fluid">
                        <h1 class="mt-4 mb-5">Data Pengguna</h1>  </td>
                        <a href="add-user.php" class="btn btn-primary">Tambah Pengguna</a>
                        <div><br></div>
                        <table class="table table-bordered">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Pengguna</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Aksi</th>
                            </tr>
                            <?php
                                $queryuser = mysqli_query($db, "SELECT * FROM user ORDER BY id_user");
                                $no = 1;
                                while ($datauser = mysqli_fetch_array($queryuser))
                                {
                            ?>
                            <tr>
                            <td><?php echo $no ?></td>
                            <th scope="row"><?php echo $datauser['id_user']; ?></th>
                            <td><?php echo $datauser['username']; ?></td>
                            <td><?php echo $datauser['password']; ?></td>
                            <td class="text-center"><a href="edit-user.php?id_user=<?php echo $datauser['id_user']; ?>" class="btn btn-success col">Ubah</a> 
                            <a href="del-user.php?id_user=<?php echo $datauser['id_user']; ?>" class="btn btn-danger col">Hapus</a></td>
                            </tr>
                            <?php
                            $no++;
                                }
                            ?>
                        </table>
                    </div>
                </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>

