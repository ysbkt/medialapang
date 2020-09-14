<?php if($this->session->userdata('as_penyedia')){ ?>
<div id="profile">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3">
					<div class="side-profile">
						<div class="row">
							<div class="col-md-12">
								<?php foreach ($penyedia as $data) { ?>
								<div class="info-profile">
									<h4><?php echo ucwords($data->nama_tempat) ?></h4>
									<p><?php echo $data->email ?></p>
								</div>
								<?php } ?>
							</div>							
						</div>
					</div>
					<br>
					<div class="side-profile">
						<ul class="nav nav-pills nav-stacked admin-menu" >
		                    <li class="active"><a href="" data-target-id="profil"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
		                    <li><a href="" data-target-id="lapangan"><i class="glyphicon glyphicon-list"></i> List Lapangan</a></li>
		                    <li><a href="" data-target-id="settings"><i class="glyphicon glyphicon-calendar"></i> Jadwal</a></li>
		                    <li><a href="" data-target-id="daftar"><i class="glyphicon glyphicon-plus"></i> Daftar Lapangan</a></li>
		                    <li><a href="" data-target-id="gallery"><i class="glyphicon glyphicon-calendar"></i> Gallery</a></li>
		                    <li><a href="" data-target-id="fasilitas"><i class="glyphicon glyphicon-list"></i> Fasilitas</a></li>
		                </ul>
					</div>
				</div>
				<div class="col-md-9">
                <?php echo $this->session->flashdata('status'); ?>
					<div class="admin-content" id="profil">
						<?php foreach ($penyedia as $data) { ?>
						<div class="isi-profile">
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Name Pengelola</h3>
			                    </div>
			                    <div class="panel-body">
			                        <?php echo ucwords($data->nama_pemilik) ?>
			                    </div>
			                </div>
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Email</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<?php echo $data->email ?>
			                    </div>
			                </div>
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Nama Tempat</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<?php echo ucwords($data->nama_tempat) ?>
			                    </div>
			                </div>
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Jam Operasional</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<?php echo $data->jam_buka. ' - '. $data->jam_tutup ?> WIB
			                    </div>
			                </div>
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Alamat</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<?php echo ucwords($data->alamat.', '. $data->kelurahan.', '. $data->kecamatan.', '. $data->kotamadya.', '.$data->kodepos) ?>
			                    </div>
							</div>

							<div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Google Maps</h3>
			                    </div>
			                    <div class="row">
                                    <div class="col-md-12 col-sm-12"><br>
                                        <input id="geocomplete" type="text" class="form-control" placeholder="Type in an address" name="location">
                                        <br>
                                        <input id="find" type="button" class="btn btn-default" value="Find Address" />    
                                        <div class="map_canvas"></div>
                                    </div>
                                </div>
							</div>

		                </div><br>
		                <?php } ?>
		            </div>

					<div class="admin-content" id="lapangan">
						<?php foreach ($lapangan as $data) { ?>
						<div class="isi-profile">	
			                <!-- <div class="panel panel-info" style="margin: 1em;"> -->
			                	<div class="row">
			                		<!-- <div class="col-md-12"> -->
			                			<div class="col-md-6">
			                				<div class="panel panel-info" style="margin: 1em;">
						                    <div class="panel-heading">
						                        <h3 class="panel-title">Nama Lapangan</h3>
						                    </div>
						                    <div class="panel-body">
						                        <?php echo ucwords($data->nama_lapangan) ?>
				                			</div>
				                		</div>
					                    </div>
					                    <div class="col-md-6">
					                    	<div class="panel panel-info" style="margin: 1em;">
						                    <div class="panel-heading">
						                        <h3 class="panel-title">Jenis Lapangan</h3>
						                    </div>
						                    <div class="panel-body">
						                        <?php echo ucwords($data->jenis_lapangan) ?>
				                			</div>
				                		</div>
					                    </div>
			                		<!-- </div> -->
			                	</div>
			                <!-- </div> -->
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Gambar</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<img src="<?php echo base_url().'assets/gambar_lapangan/'.$data->gambar ?>" style="width: 100%; height: auto;" class="image-responsive">
			                    </div>
			                </div>
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Deskripsi</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<?php echo $data->deskripsi ?>
			                    </div>
			                </div>
						</div><br>
		            <?php } ?>
		            </div>

					<div class="isi-profile  admin-content" id="settings">
		                <div class="panel panel-info" style="margin: 1em;">
		                    <div class="panel-heading">
		                        <h3 class="panel-title">Daftar Pemesanan</h3>
		                    </div>
		                    <div class="panel-body">
	                        	<table class="table table-bordered">
	                        		<thead>
	                        			<tr>
	                        				<th>No</th>
	                        				<th>Nama Penyewa</th>
	                        				<th>Jam Main</th>
	                        				<th>Jam Selesai</th>
	                        				<th>Lapangan</th>
	                        			</tr>
	                        		</thead>
	                        		<tbody>
	                        		<?php
	                        		$no = 1;
	                        		 foreach ($jadwal as $data) { ?>
	                        			<th><?php echo $no++ ?></th>
	                        			<td><?php echo $data->nama ?></td>
	                        			<td><?php echo $data->jam_main ?></td>
	                        			<td><?php echo $data->jam_selesai ?></td>
	                        			<td><?php echo $data->nama_lapangan ?></td>
	                        		</tbody>
	                        		<?php } ?>
	                        	</table>
		                    </div>
		                </div>
		                <a href="#" onclick="Add_Jadwal()" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Jadwal</a>
		            </div>

		            <div class="col-md-9  admin-content" id="daftar">
		                <div class="panel panel-info" style="margin: 1em;">
		                    <div class="panel-heading">
		                        <h3 class="panel-title">Tambah Lapangan Baru</h3>
		                    </div>
		                    <div class="panel-body">		                    		
		                    	<form action="<?php echo base_url('Lapangan/TambahLapangan'); ?>" enctype="multipart/form-data" method="post" class="contactForm">
		                    		<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nama_lapangan">Nama Lapangan</label>
                                            <input type="text" class="form-control" name="nama_lapangan" id="nama_lapangan" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jenis_lapangan">Jenis Lapangan</label>
                                            <select name="jenis_lapangan" class="form-control">
                                            	<option value="" text-muted>-- Silahkan Pilih --</option>
                                            	<?php foreach ($listlapangan as $data) { ?>
                                            	<option value="<?php echo $data->id_lapangan ?>"><?php echo ucwords($data->jenis_lapangan) ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                    	<div class="form-group">
	                                    	<label>Upload Image</label>
	                                    		<div class="input-group">
	                                    			<span class="input-group-btn">
	                                    				<span class="btn btn-default btn-file">Browse…
	                                    					<input type="file" accept="image/png, image/jpeg, image/gif" id="imgInp">
										                </span>
										            </span>
										            <input id='urlname'type="text" class="form-control" readonly>
										        </div><br>
										        <img id='img-upload'/>
										        <!-- <button id="clear" class="btn btn-danger" class="hidden">Clear</button> -->
	                                    </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="deskripsi">Harga</label>
                                            <input type="text" class="form-control" name="skema_1" id="skema_1" placeholder="Senin - Jumat (08:00 - 17:00)" onkeypress="return hanyaAngka(event)" maxlength="13" required><br>
                                            <input type="text" class="form-control" name="skema_2" id="skema_2" placeholder="Senin - Jumat (17:00 - 21:00)" onkeypress="return hanyaAngka(event)" maxlength="13" required><br>
                                            <input type="text" class="form-control" name="skema_3" id="skema_3" placeholder="Senin - Jumat (21:00 - 24:00)" onkeypress="return hanyaAngka(event)" maxlength="13" required><br>
                                            <input type="text" class="form-control" name="skema_4" id="skema_4" placeholder="Sabtu - Minggu (08:00 - 17:00)" onkeypress="return hanyaAngka(event)" maxlength="13" required><br>
                                            <input type="text" class="form-control" name="skema_5" id="skema_5" placeholder="Sabtu - Minggu (17:00 - 21:00)" onkeypress="return hanyaAngka(event)" maxlength="13" required><br>
                                            <input type="text" class="form-control" name="skema_6" id="skema_6" placeholder="Sabtu - Minggu (21:00 - 24:00)" onkeypress="return hanyaAngka(event)" maxlength="13" required><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        	<button type="submit" value="save" class="btn btn-block btn-outline btn-primary">Save</button>
                                        </div>
                                    </div>
		                    	</form>
		                    </div>
		                </div>
		            </div>

		            <div class="col-md-9  admin-content" id="gallery">
		                <div class="panel panel-info" style="margin: 1em;">
		                    <div class="panel-heading">
		                        <h3 class="panel-title">Upload Gambar Lapangan</h3>
		                    </div>
		                    <div class="panel-body">		                    		
		                    	<form action="<?php echo base_url('Lapangan/UploadGambar'); ?>" enctype="multipart/form-data" method="post" class="contactForm">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nama_lapangan">Nama Lapangan</label>
                                            <select name="nama_lapangan" class="form-control">
                                            	<option value="" text-muted>-- Silahkan Pilih --</option>
                                            	<?php foreach ($jenislapangan as $data) { ?>
                                            	<option value="<?php echo $data->id_data_lapangan ?>"><?php echo ucwords($data->nama_lapangan) ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>

								    <div class="col-md-6">
									    <div class="form-group">
									        <label>Upload Image</label>
									        <div class="input-group">
									            <span class="input-group-btn">
									                <span class="btn btn-default btn-file">
									                    Browse… <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/gif" id="imgInp">
									                </span>
									            </span>
									            <input id='urlname'type="text" class="form-control" nama="image" readonly>
									        </div><br>
									       <a type="button" class="btn btn-outline btn-danger" id="clear" class="btn btn-default">Clear</a>
									        <img id='img-upload'/>
									    </div>
									</div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        	<button type="submit" value="save" class="btn btn-block btn-outline btn-primary">Save</button>
                                        </div>
                                    </div>
		                    	</form>
		                    </div>
		                </div>
		            </div>

		            <div class="col-md-9  admin-content" id="fasilitas">
		                <div class="panel panel-info" style="margin: 1em;">
		                    <div class="panel-heading">
		                        <h3 class="panel-title">Tambah Fasilitas</h3>
		                    </div>
		                    <div class="panel-body">		                    		
		                    	<form action="<?php echo base_url('Lapangan/TambahLapangan'); ?>" enctype="multipart/form-data" method="post" class="contactForm">
		                    		<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nama_lapangan">Jenis Fasilitas</label>
                                            <input type="text" class="form-control" name="nama_lapangan" id="nama_lapangan" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                    	<br>
                                        <div class="form-group">
                                        	<button type="submit" value="save" class="btn btn-block btn-outline btn-primary">Save</button>
                                        </div>
                                    </div>
		                    	</form>
		                    </div>
		                </div>
		            </div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php }else{ ?>

<div id="profile">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3">
					<div class="side-profile">
						<div class="row">
							<div class="col-md-12">								
								<?php foreach ($penyewa as $data) { ?>
								<div class="info-profile">
									<h4><?php echo ucwords($data->nama) ?></h4>
									<p><?php echo $data->email ?></p>
								</div>
								<?php } ?>									
							</div>							
						</div>
					</div>
					<br>
					<div class="side-profile">
						<ul class="nav nav-pills nav-stacked admin-menu" >
		                    <li class="active"><a href="" data-target-id="penyewa-profil"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
		                    <li><a href="" data-target-id="jadwal-main"><i class="glyphicon glyphicon-calendar"></i> Jadwal</a></li>
		                </ul>
					</div>
				</div>
				<div class="col-md-9">
                <?php echo $this->session->flashdata('status'); ?>
					<div class="admin-content" id="penyewa-profil">
						<?php foreach ($penyewa as $data) { ?>
						<div class="isi-profile">
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Nama</h3>
			                    </div>
			                    <div class="panel-body">
			                        <?php echo ucwords($data->nama) ?>
			                    </div>
			                </div>
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Email</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<?php echo $data->email ?>
			                    </div>
			                </div>
			                <div class="panel panel-info" style="margin: 1em;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Telepon</h3>
			                    </div>
			                    <div class="panel-body">
			                    	<?php echo ucwords($data->telepon) ?>
			                    </div>
			                </div>
		                </div><br>
		                <?php } ?>
		            </div>

					<div class="isi-profile  admin-content" id="jadwal-main">
		                <div class="panel panel-info" style="margin: 1em;">
		                    <div class="panel-heading">
		                        <h3 class="panel-title">Jadwal Main</h3>
		                    </div>
		                    <div class="panel-body">
	                        	<table class="table table-bordered">
	                        		<thead>
	                        			<tr>
	                        				<th>No</th>
	                        				<th>Nama Tempat</th>
	                        				<th>Jam Main</th>
	                        				<th>Jam Selesai</th>
	                        				<th>Lapangan</th>
	                        				<th>Status</th>
	                        			</tr>
	                        		</thead>
	                        		<?php $this->session->userdata('id') ?>
	                        		<tbody>
	                        		<?php
	                        		$no = 1;
	                        		 foreach ($jadwalPenyewa as $data) { ?>
	                        			<th><?php echo $no++ ?></th>
	                        			<td><?php echo $data->nama_tempat ?></td>
	                        			<td><?php echo $data->jam_main ?></td>
	                        			<td><?php echo $data->jam_selesai ?></td>
	                        			<td><?php echo $data->nama_lapangan ?></td>
	                        			<td><a href="#" onclick="upload_tf(<?php echo $data->id_jadwal ?>)" style="color: #000000; hover: #3BB0BF;"><?php echo $data->status_tf ?></a></td>
	                        		</tbody>
	                        		<?php } ?>
	                        	</table>
		                    </div>
		                </div>
		            </div>

				</div>
			</div>
		</div>
	</div>
</div>
<?php }?>
<script type="text/javascript">
	$(document).ready(function()
      {
        var navItems = $('.admin-menu li > a');
        var navListItems = $('.admin-menu li');
        var allWells = $('.admin-content');
        var allWellsExceptFirst = $('.admin-content:not(:first)');
        allWellsExceptFirst.hide();
        navItems.click(function(e)
        {
            e.preventDefault();
            navListItems.removeClass('active');
            $(this).closest('li').addClass('active');
            allWells.hide();
            var target = $(this).attr('data-target-id');
            $('#' + target).show();
        });
        });


		$(document).ready( function() {
    
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
	
		
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});
		
		$("#clear").click(function(){
		    $('#img-upload').attr('src','');
		    $('#urlname').val('');
		});
	});
	

		function hanyaAngka(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }
</script>