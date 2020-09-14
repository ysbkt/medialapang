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
									<h3 class="panel-title">Question on Countact Us</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover" id="tabel">
										<thead>
											<tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
											<?php
											$no = 1; foreach ($contact as $data) { ?>
											<tr>
	                                            <td><?php echo $no++ ?></td>
	                                            <td><?php echo ucwords($data->nama) ?></td>
	                                            <td><?php echo $data->email ?></td>
	                                            <td><?php echo ucwords($data->subject) ?></td>
	                                            <td><?php echo ucfirst($data->pesan) ?></td>
	                                            <td><a href="#" onclick="edit_account(#)" class="btn btn-success"><i class="fa fa-pencil"></i></a> <a href="#" onclick="delete_account(#)" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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

		 <script>
            $(document).ready( function () {
                $('#tabel').DataTable();
            } );
        </script>