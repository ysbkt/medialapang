	<div class="clearfix"></div>
			<footer>
				<div class="container-fluid">
					<p class="copyright">&copy; <script>document.write(new Date().getFullYear())</script> Permata Indonesia</p>
				</div>
			</footer>
		</div>
		<!-- END WRAPPER -->

		<!-- Javascript -->
		<script src="<?php echo base_url(); ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/chartist/js/chartist.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/toastr/toastr.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/scripts/klorofil-common.js"></script>
    	<script src="<?php echo base_url(); ?>assets/bower_components/toast-master/js/jquery.toast.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
    	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
	<script>
    
        var table;
        $(document).ready( function () {
        table = $('#myTable').DataTable({
            "oLanguage": {
            "sInfo": "Menampilkan _START_ to _END_ of _TOTAL_ data",
            "sSearch": "Cari",
            "sLengthMenu": "_MENU_ Data"
            }
        });
        } );


     function delete_account(id){       
          swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
  if (willDelete) {
            $.ajax({
                        url : "<?php echo base_url('Account/Delete')?>/" + id,
                        type : "POST",
                        dataType : "JSON",
                        success: function(data)
                        {
                           swal("Success!", "Success Applied", "success")
                            .then((value) => {
                            location.reload();
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
                        }
                 });
                }
        });
     }


    function add_account(){
    save_method = 'add';
    $('#formAccount')[0].reset(); // clear error string
    $('#modal_account').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Account'); // Set Title to Bootstrap modal title
    }

    function add_upload(){
    save_method = 'add';
    $('#formUpload')[0].reset(); // clear error string
    $('#modal_upload').modal('show'); // show bootstrap modal
    $('.modal-title').text('Upload'); // Set Title to Bootstrap modal title
    }

    function edit_account(id)
    {
      save_method = 'update';
      $('#formAccount')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('Account/Edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // console.log(data.jenis_kelamin);
            $('[name="id_user"]').val(data.id_user);
            $('[name="nama_user"]').val(data.nama_user);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="status_user"]').val(data.status_user);
            $('[name="level_user"]').val(data.level_user);

 
            $('#modal_account').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Account'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function Acc_Account(id)
    {
      save_method = 'update';
      $('#formAccount')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('Account/Acc')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // console.log(data.jenis_kelamin);
            $('[name="id_penyedia"]').val(data.id_penyedia);
            $('[name="nama_pemilik"]').val(data.nama_pemilik);
            $('[name="status"]').val(data.status);

 
            $('#modal_acc').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Acc Account'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function saveAccount(){
    $('#btnAccount').text('saving...'); //change button text
    $('#btnAccount').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo base_url('Account/Insert')?>";
    } else {
        url = "<?php echo base_url('Account/Update')?>";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formAccount').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_account').modal('hide');
                // location.reload();
                swal("Success!", "Success Applied", "success")
                .then((value) => {
                location.reload();
                });
                // swal("Good job!", "You clicked the button!", "success");
            }
            else
            {
                // for (var i = 0; i < data.inputerror.length; i++) 
                // {
                //     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                //     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                // }
                console.log(url);
            }
            $('#btnSaveJabatan').text('save'); //change button text
            $('#btnSaveJabatan').attr('disabled',false); //set button enable 
 
 
        },
        error: function (xhr, textStatus, errorThrown)
        {
            // alert('Error adding / update data');
            alert(xhr.responseText);

            $('#btnSaveJabatan').text('save'); //change button text
            $('#btnSaveJabatan').attr('disabled',false); //set button enable 
 
        }
    });
    }

    $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});   
   
    </script>
</body>

<!-- //MODAL -->
<div class="modal fade bd-example-modal-md" id="modal_account" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle"></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" id="formAccount" method="POST" enctype="multipart/form-data">
                            <label for="nama_user">Nama User</label>
                            <input type="text" name="nama_user" id="nama_user" class="form-control" placeholder="Nama User">
                            <input type="hidden" name="id_user" id="id_user">
                            <br>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            <br>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <br>
                            <label for="password">Status</label>
                            <select class="form-control" name="status_user">
                                <option>aktif</option>
                                <option>tidak aktif</option>
                            </select>
                            <br>
                            <label for="password">Level</label>
                            <select class="form-control" name="level_user">
                                <option>admin</option>
                                <option>manager</option>
                                <option>user</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnAccount" onclick="saveAccount()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle"></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" id="formUpload" method="POST" enctype="multipart/form-data">
                            <input type="file" name="uploaded_file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnAccount" onclick="saveAccount()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
                        </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="modal_acc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle"></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" id="formAcc" method="POST" enctype="multipart/form-data">
                            <label for="nama_user">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" placeholder="Nama Pemilik">
                            <input type="text" name="id_penyedia" id="id_penyedia">
                            <br>
                            <label for="password">Status</label>
                            <select class="form-control" name="status">
                                <option>aktif</option>
                                <option>tidak aktif</option>
                            </select>
                            <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnAccount" onclick="saveAccount()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

</html>