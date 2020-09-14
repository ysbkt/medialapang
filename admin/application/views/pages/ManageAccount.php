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
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Status</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
											<?php foreach ($account as $item) { ?>
											<tr>
	                                            <td><?php echo $item->id_user ?></td>
	                                            <td><?php echo $item->nama_user ?></td>
	                                            <td><?php echo $item->username ?></td>
	                                            <td><?php echo $item->status_user ?></td>
	                                            <td><?php echo $item->level_user ?></td>
	                                            <td>
	                                            	<a href="#" onclick="edit_account(<?php echo $item->id_user;?>)" class="btn btn-success"><i class="fa fa-pencil"></i></a>
	                                            	<a href="#" onclick="delete_account(<?php echo $item->id_user;?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
	                                            </td>
                                        	</tr>
                                        	<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<a href="#" onclick="add_account()" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Account</a>
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