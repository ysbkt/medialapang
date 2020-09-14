MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Gallery</h3>
								</div>
							</div>
							<?php echo $this->session->flashdata('status'); ?>								
							<div class="panel">
								<div class="panel-body">
									<form method="post" action="<?php echo base_url('Home/InputGallery'); ?>" enctype="multipart/form-data"  class="contactForm">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
												<label>Title</label>
													<input type="text" name="title" class="form-control" placeholder="Nama Foto">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Image</label>
										            <!-- image-preview-filename input [CUT FROM HERE]-->
										            <div class="input-group image-preview">
										                <input type="text" name="image" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
										                <span class="input-group-btn">
										                    <!-- image-preview-clear button -->
										                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
										                        <span class="glyphicon glyphicon-remove"></span> Clear
										                    </button>
										                    <!-- image-preview-input -->
										                    <div class="btn btn-default image-preview-input">
										                        <span class="glyphicon glyphicon-folder-open"></span>
										                        <span class="image-preview-input-title">Browse</span>
										                        <input type="file" accept="image/png, image/jpeg, image/gif" id="image" name="image"/> <!-- rename it -->
										                    </div>
										                </span>
										            </div><!-- /input-group image-preview [TO HERE]--> 
												</div>
									        </div>
									        <div class="col-md-4">
									        	<div class="form-group">
									        		<label>Confirm</label>
									        		<button class="btn btn-success btn-outline btn-block" type="submit">Save</button>
									        	</div>
									        </div>
										</div>
									</form>
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
		<!-- END MAIN