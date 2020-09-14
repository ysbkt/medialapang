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
                                                <th>Pemilik</th>
                                                <th>Tempat</th>
                                                <th>Jam Operasional</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Reason</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($penyedia as $data) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo ucwords($data->nama_pemilik) ?></td>
                                                <td><?php echo ucwords($data->nama_tempat) ?></td>
                                                <td><?php echo $data->jam_buka.' - '.$data->jam_tutup ?> WIB</td>
                                                <td ><?php echo $data->email ?></td>
                                                <td ><?php echo ucwords($data->alamat.', '.$data->kelurahan.', '.$data->kecamatan.', '.$data->kotamadya.', '.$data->kodepos) ?></td>
                                                <td><?php echo $data->telepon ?></td>
                                                <td><?php echo ucwords($data->status) ?></td>
                                                <td><?php echo ucwords($data->reason) ?></td>
                                                <td>
                                                	<a href="#" onclick="Acc_Account(<?php echo $data->id_penyedia;?>)" class="btn btn-sm btn-success" alt="Approve" title="Approve"><i class="fa fa-check"></i></a>
                                                    <a href="#" onclick="delete_account(<?php echo $data->id_penyedia;?>)" class="btn btn-sm btn-danger" alt="Reject" title="Reject"><i class="fa fa-close"></i></a></td>
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