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