<?php
	require '../../controller/dashboard/dbConnection.php';
	$all_staff = getAll("SELECT * FROM staff INNER JOIN cabang_bank ON staff.b_id = cabang_bank.b_id");
?>

<?php require_once("../format/head_format_start.php"); ?>
	<title>Dashboard Staff</title>
<?php require_once("../format/head_format_end.php"); ?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html">
					<img src="../../assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo">
				</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="../../assets/img/user.png" class="img-circle" alt="Avatar"> <span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<!-- dashboard -->
						<li><a href="#" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<!-- view user  -->
						<li><a href="#" class=""><i class="lnr lnr-code"></i> <span>Daftar User</span></a></li>
						<!-- view pengepul -->
						<li><a href="#" class=""><i class="lnr lnr-chart-bars"></i> <span>Daftar Pengepul</span></a></li>
						<!--  view transaksi user -->
						<li><a href="../admin_view_transaksi_user.php" class=""><i class="lnr lnr-alarm"></i> <span>Transaksi User</span></a></li>
						<!-- view transaksi pengepul -->
						<li><a href="../admin_view_transaksi_pengepul.php" class=""><i class="lnr lnr-cog"></i> <span>Transaksi Pengepul</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">

					<!-- END OVERVIEW -->
					<div class="row">
                        <div class="">
							<!-- TABLE HOVER -->
							<div class="panel panel-headline">
								<div class="panel-heading">
									<h3 class="panel-title">Daftar Staff</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>s_id</th>
												<th>b_nama</th>
												<th>s_nama</th>
												<th>s_alamat</th>
												<th>s_telepon</th>
												<th>edit</th>
												<th>hapus</th>
											</tr>
										</thead>
										<tbody>
										<?php
											while($staff = mysqli_fetch_array($all_staff)) {
										?>
											<tr>
												<td><?php echo $staff['s_id']; ?></td>
												<td><?php echo $staff['b_nama']; ?></td>
												<td><?php echo $staff['s_nama']; ?></td>
												<td><?php echo $staff['s_alamat']; ?></td>
												<td><?php echo $staff['s_telepon']; ?></td>
												<td>
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdate-<?php echo $staff['s_id']; ?>">Edit Staff</button>
													<div class="modal fade" id="modalUpdate-<?php echo $staff['s_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Update</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<form method="POST" action="../../controller/dashboard/pengguna/editStaff.php">
																	<div class="modal-body">
																		<div class="input-group col-md-12" style="margin-top: 15px">
																			<input class="form-control" type="text" name="s_id" id="s_id" value="<?php echo $staff['s_id']; ?>">
																		</div>
																		<div class="input-group col-md-12" style="margin-top: 15px">
																			<input class="form-control" type="text" name="s_nama" id="s_nama" placeholder="nama" value="<?php echo $staff['s_nama']; ?>">
																		</div>
																		<div class="input-group col-md-12" style="margin-top: 15px">
																			<select class="form-control" name="bank" id="bank">
																				<?php
																					$all_bank = getAll("SELECT * FROM cabang_bank");
																					while($bank = mysqli_fetch_array($all_bank)) {
																				?>
																					<?php 
																						if($bank['b_nama'] == $staff['b_nama']) {
																					?>
																						<option value="<?php echo $bank['b_id']?>" selected="selected"><?php echo $bank['b_nama']?></option>
																					<?php 
																						} else {
																					?>
																						<option value="<?php echo $bank['b_id']?>"><?php echo $bank['b_nama']?></option>
																					<?php 
																						}
																					?>
																				<?php
																					}
																				?>
																			</select>
																		</div>
																		<div class="input-group col-md-12" style="margin-top: 15px">
																			<input class="form-control" type="text" name="s_alamat" id="s_alamat" placeholder="alamat" value="<?php echo $staff['s_alamat']; ?>">
																		</div>
																		<div class="input-group col-md-12" style="margin-top: 15px">
																			<input class="form-control" type="text" name="s_telepon" id="s_telepon" placeholder="telepon" value="<?php echo $staff['s_telepon']; ?>">
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																		<button class="btn btn-primary" type="submit">Save changes</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</td>
												<td>
													<form method="POST" action="../../controller/dashboard/pengguna/deleteStaff.php">
														<div class="input-group">
															<input class="form-control" type="text" name="s_id" id="s_id" value="<?php echo $staff['s_id']; ?>" style="display: none;">
														</div>
														<button class="btn btn-danger" type="submit">Delete Staff</button>
													</form>
												</td>
											</tr>
										<?php
											}
										?>
										</tbody>
									</table>
									<div style="flex: 1;">
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">Tambah</button>
										<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form method="POST" action="../../controller/dashboard/pengguna/createStaff.php">
														<div class="modal-body">
															<div class="input-group col-md-12" style="margin-top: 15px">
																<input class="form-control" type="text" name="s_nama" id="s_nama" placeholder="nama">
															</div>
															<div class="input-group col-md-12" style="margin-top: 15px">
																<select class="form-control" name="bank" id="bank">
																	<?php
																		$all_bank = getAll("SELECT * FROM cabang_bank");
																		while($bank = mysqli_fetch_array($all_bank)) {
																	?>
																		<option value="<?php echo $bank['b_id']?>"><?php echo $bank['b_nama']?></option>
																	<?php
																		}
																	?>
																</select>
															</div>
															<div class="input-group col-md-12" style="margin-top: 15px">
																<input class="form-control" type="text" name="s_alamat" id="s_alamat" placeholder="alamat">
															</div>
															<div class="input-group col-md-12" style="margin-top: 15px">
																<input class="form-control" type="text" name="s_telepon" id="s_telepon" placeholder="telepon">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button class="btn btn-primary" type="submit">Save changes</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END TABLE HOVER -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../../assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="../../assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="../../assets/scripts/klorofil-common.js"></script>
</body>

</html>
