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
                                                <th>Kode Unik</th>
                                                <th>Lama Main</th>
                                                <th>Harga</th>
                                                <th>Down Payment</th>
                                                <th>Kekurangan</th>
                                                <th>Status</th>
                                                <th>Photo</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($pembayaran as $data) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo ucwords($data->nama) ?></td>
                                                <td><?php echo $data->kode_jadwal ?></td>
                                                <td><?php echo $data->jam_selesai - $data->jam_main ?> Jam</td>
                                                <td>Rp <?php echo number_format($data->total_pemesanan,0,",",".") ?></td>
                                                <td>Rp <?php echo number_format($data->dp,0,",",".") ?></td>
                                                <td>Rp <?php echo number_format($data->total_pemesanan - $data->dp,0,",",".") ?></td>
                                                <td><?php echo ucwords($data->status_tf) ?></td>
                                                <td></td>
                                                <td>
                                                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i></button>
                                                	<button type="button" class="btn btn-danger"><i class="fa fa-close"></i></button>
                                                </td>
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