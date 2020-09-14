<!--==========================
  Hero Section
  ============================-->
  <section id="login">
    <div class="login-container">
      <div class="container">
        
        <div class="container wow fadeInUp"></div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="login-logo">
                <img class="" src="<?php echo base_url() ?>assets/img/trio-lapang.png" style="max-width: 100%;" title="Media Lapang" alt="Media Lapang">
              </div>
            </div>
            <div class="col-md-6">
              <?php echo $this->session->flashdata('status'); ?>
              <br>
              <h2>MASUK SEBAGAI PENYEWA</h2>
              <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>Account/PenyewaLogin">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="email_login_sewa" placeholder="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="password" class="form-control" name="pass_login_sewa" placeholder="password">
                  </div>
                </div>
                <div class="pull-right">
                  <!-- <a href="">Lupa Password ?</a> -->
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <button type="submit" value="login" class="btn btn-outline btn-primary btn-block">Login</button>
                  </div>
                </div>
              </form>

              <div class="form-group">
                <span>Anda seorang penyedia lapangan? <a href="" style="color: #3BB0BF;">Silahkan masuk disini</a></span>
              </div>
              <div class="form-group">
                <p>Tidak punya akun? <a href="<?php echo base_url('Account/PenyewaRegister'); ?>" class="pull-right btn btn-sm btn-outline btn-info">Daftar disini</a></p>
              </div>
              <div class="form-group">
                <span align="center">
                  <p>atau masuk menggunakan</p>
                </span>
              </div>
              <div class="form-group">
                <button class="btn btn-outline btn-primary btn-danger btn-block">Google+</button>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>