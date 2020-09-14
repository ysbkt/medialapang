<!--==========================
  Footer
============================-->
 <div id="footer" data-animate="fadeInUp">
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-md-12">
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <hr>
          <h4>Get in Touch</h4>
            <div class="row">  
              <div class="col-xs-4" style="text-align: justify;">
                <span><p>Address  :</p></span><br>
                <span><p>Handphone  :</p></span>
                <span><p>Office :</p></span>
                <span><p>Email  :</p></span>
              </div>
              <div class="col-xs-6" style="text-align: justify;">
                <p>Jalan Pinang Ranti 2 Jakarta Timur</p>
                  <p>0878 8504 5227</p>
                  <p>(021) 228 034 16</p>
                  <p>medialapang@gmail.com</p>
              </div>
            </div>
          <hr class="hidden-md hidden-lg">
        </div>

        <div class="col-md-4">
          <hr>
          <h4>Social Media</h4>
          <h5>Cari tahu berbagai berita update seputar lapangan terbaru.</h5>
          <p class="social">
            <a href="https://www.facebook.com/medialapang/" target="_blank" title="Media Lapang" class="facebook external"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/MediaLapang" target="_blank" class="twitter external" title="Media Lapang"><i class="fa fa-twitter"></i></a>
            <a href="https://www.instagram.com/medialapang/" target="_blank" class="instagram external" title="Media Lapang"><i class="fa fa-instagram"></i></a>
            <!-- <a href="" class="gplus external" title="Media Lapang"><i class="fa fa-google-plus"></i></a> -->
            <a href="mailto:medialapang@gmail.com" class="email external" title="Media Lapang"><i class="fa fa-envelope"></i></a>
          </p>
          <hr class="hidden-md hidden-lg">
          <br>
          <p class="social">
            &copy; <script>document.write(new Date().getFullYear());</script> Media Lapang
          </p>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
</div>
<!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Required JavaScript Libraries -->
  <script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/superfish/hoverIntent.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/superfish/superfish.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/morphext/morphext.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/stickyjs/sticky.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/easing/easing.js"></script>

  <!-- <script type="text/javascript" src="<?=base_url()?>js-baru/js/components.js"></script> -->
  <!-- <script type="text/javascript" src="<?=base_url()?>js-baru/js/custom.js"></script> -->
  <script type="text/javascript" src="<?=base_url()?>js-baru/vendors/moment/js/moment.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>js-baru/vendors/fullcalendar/js/fullcalendar.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>js-baru/js/pluginjs/calendarcustom.js" ></script>

  <!-- Template Specisifc Custom Javascript File -->
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/pluginjs/map-upload.js"></script>

  <script type="text/javascript">
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

  function upload_tf(id){
    save_method = 'add';
    $('#formUpload')[0].reset(); // clear error string
    $('[name="id_jadwal"]').val(id);
    $('#UploadTf').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Account'); // Set Title to Bootstrap modal title
    }
    
</script>

<div class="modal fade bd-example-modal-md" id="AddJadwal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

<div class="modal fade bd-example-modal-md" id="UploadTf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle"></h3>
      </div>
      <div class="modal-body">  
        <div class="row">
          <div class="col-md-12">
            <form action="<?php echo base_url('Profile/UploadTf'); ?>" id="formUpload" method="POST" enctype="multipart/form-data">
              <label for="image_tf">Nama User</label>
              <input type="file" name="image_Tf" id="image_Tf" class="form-control" placeholder="Nama User">
              <input type="hidden" name="id_jadwal" id="id_jadwal">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>


</body>

</html>