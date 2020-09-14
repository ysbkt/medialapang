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
                                                <th>Nama Penyewa</th>
                                                <th>Nama Tempat</th>
                                                <th>Nama Lapangan</th>
                                                <th>Jenis Lapangan</th>
                                                <th>Tanggal Main</th>
                                                <th>Jam Main</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($jadwal as $data) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo ucwords($data->nama) ?></td>
                                                <td><?php echo ucwords($data->nama_tempat) ?></td>
                                                <td><?php echo ucwords($data->nama_lapangan) ?></td>
                                                <td><?php echo ucwords($data->jenis_lapangan) ?></td>
                                                <td><?php echo date('d F Y', strtotime($data->hari_main)) ?></td>
                                                <td><?php echo $data->jam_main.' - '.$data->jam_selesai ?> WIB</td>
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