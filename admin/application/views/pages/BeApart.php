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
									<h3 class="panel-title">Question on Be A Part</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover" id="tabel" style="width: 100%;">
										<thead>
											<tr>
                                            <th>#</th>
                                            <th style="max-width: 10%;">Name</th>
                                            <th>Email</th>
                                            <th>Telepon</th>
                                            <th>Bidang Perusahaan</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Deskripsi</th>
                                            <th>Service</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($beapart as $data) { ?>
											<tr>
												<td><?php echo $no++ ?></td>
	                                            <td><?php echo ucwords($data->nama) ?></td>
	                                            <td><?php echo $data->email ?></td>
	                                            <td><?php echo $data->telepon ?></td>
	                                            <td><?php echo ucwords($data->bidang_perusahaan) ?></td>
	                                            <td><?php echo ucwords($data->nama_perusahaan) ?></td>
	                                            <td><?php echo ucfirst($data->deskripsi) ?></td>
	                                            <td><?php echo $data->service ?></td>
	                                            <!-- <td>
	                                            	<a href="#" onclick="edit_account(#)" class="btn btn-success"><i class="fa fa-mail-reply"></i></a>
	                                            </td> -->
                                        	</tr>
                                        	<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- <a href="#" onclick="add_account()" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Account</a> -->
							<!-- END TABLE HOVER -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->

		<script type="text/javascript">
		$(document).ready(function() {
		    $('#tabel').DataTable();
		});
		</script>