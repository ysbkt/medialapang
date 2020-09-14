<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Manage Account</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover" id="tabel">
										<thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($penyewa as $data) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo ucwords($data->nama) ?></td>
                                                <td ><?php echo $data->email ?></td>
                                                <td ><?php echo $data->telepon ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->

        <script>
            $(document).ready( function () {
                $('#tabel').DataTable();
            } );
        </script>