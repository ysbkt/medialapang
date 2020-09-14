<!--==========================
  Header Section
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/img/Logo-Media-lapang.png" alt="" title="" /></img></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="" class="info-user">
            <?php if (!empty($this->session->userdata('nama'))) { ?> 
            Welcome, <?php echo $this->session->userdata('nama'); ?>
              <?php } elseif (!empty($this->session->userdata('nama_pemilik'))) { ?> 
            Welcome, <?php echo $this->session->userdata('nama_pemilik'); ?>
              <?php }else{ } ?>
          </a></li>
          <?php if (empty($this->session->userdata('as_penyedia'))) { ?>
          <li><a href="<?php echo base_url('Booking') ?>">Booking</a></li>
          <?php }else  ?>

          <li><a href="<?php echo base_url('Howto') ?>">How to</a></li>

          <?php if (empty($this->session->userdata('login'))) { ?>
          <li class="menu-has-children"><a href="">Login</a>
            <ul>
              <li><a href="#"  data-toggle="modal" data-target="#penyewa">Penyewa</a></li>
              <li><a href="#" data-toggle="modal" data-target="#penyedia">Penyedia</a></li>
            </ul>
          </li>
          <?php } else ?>

          <li><a href="<?php echo base_url('Contact') ?>">Contact Us</a></li>

          <?php if (!empty($this->session->userdata('login'))) { ?>
          <li><a href="<?php echo base_url('Profile') ?>">Profile</a></li>
          <li><a href="<?php echo base_url('Account/Logout'); ?>">Logout</a></li>
          <?php } else  ?>

          <!-- <li><a href="<?php echo base_url('Account/Penyewa') ?>">Penyewa</a></li> -->
          <!-- <li><a href="<?php echo base_url('Account/Penyedia') ?>">Penyedia</a></li> -->
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->

  <!-- Modal -->
  <div class="modal fade" id="penyewa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <b><h2 class="modal-title" id="exampleModalLabel" align="center">Login</h2></b>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('Account/PenyewaLogin'); ?>" method="post">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email" name="email_login_sewa" class="form-control" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" name="pass_login_sewa" class="form-control" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <div class="pull-right">
                <a href="" style="color: #3BB0BF;">Lupa Password?</a>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline btn-primary btn-block">Login</button>
            </div>
          </form>
          <div class="form-group">
            <span>Anda seorang penyedia lapangan? <a href="<?php echo base_url('Account/Penyedia'); ?>" style="color: #3BB0BF;">Silahkan masuk disini</a></span>
          </div>
          <div class="form-group">
            <span>Tidak punya akun? <a href="<?php echo base_url('Account/PenyewaRegister'); ?>" class="pull-right btn btn-sm btn-outline btn-info">Daftar disini</a></span>
          </div>
          <div class="form-group">
            <span align="center">
              <p>atau masuk menggunakan</p>
            </span>
          </div>
          <div class="form-group">
            <a href="<?php echo base_url('Account/LoginGooglePenyewa'); ?>" class="btn btn-outline btn-primary btn-danger btn-block">masuk dengan Google+</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="penyedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <b><h2 class="modal-title" id="exampleModalLabel" align="center">Login</h2></b>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('Account/PenyediaLogin'); ?>" method="post">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email" name="email_login_penyedia" class="form-control" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" name="pass_login_penyedia" class="form-control" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <div class="pull-right">
                <a href="" style="color: #3BB0BF;">Lupa Password?</a>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline btn-primary btn-block">Login</button>
            </div>
          </form>
          <div class="form-group">
            <span>Anda seorang penyewa lapangan? <a href="<?php echo base_url('Account/Penyewa'); ?>" style="color: #3BB0BF;">Silahkan masuk disini</a></span>
          </div>
          <div class="form-group">
            <span>Tidak punya akun? <a href="<?php echo base_url('Account/PenyediaRegister'); ?>" class="pull-right btn btn-outline btn-info">Daftar disini</a></span>
          </div>
          <div class="form-group">
            <span align="center">
              <p>atau</p>
            </span>
          </div>
          <div class="form-group">
            <a href="<?php echo base_url('Account/LoginGooglePenyedia'); ?>" class="btn btn-outline btn-primary btn-danger btn-block">masuk dengan Google+</a>
          </div>
        </div>
      </div>
    </div>
  </div>