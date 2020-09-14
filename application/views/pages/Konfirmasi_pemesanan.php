<div id="payment">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <ul class="nav nav-pills nav-justified">
                        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Detail Pemesanan</a>
                        </li>
                        <li class="active"><a href="#"><i class="fa fa-check-square" style="color: #ffffff;"></i><br><p>Konfirmasi Transaksi</p></a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Pembayaran</a>
                        </li>
                    </ul>

                    <div class="col-md-12">
                      <div class="box">
                        <div class="row">

                          <div class="col-md-6">
                            <h2 style="color: #3BB0BF;">Contact Info</h2>
                            <form action="<?php echo base_url('Pembayaran/Konfirmasi'); ?>" method="get" role="form" class="contactform form-horizontal">
                              <br>
                              <div class="form-group ">
                                <label class="col-md-6 control-label" style="text-align: left; color: #3BB0BF;">Email</label>
                                <div class="col-md-6">
                                  <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $this->session->userdata('email'); ?>" readonly>
                                </div>
                              </div>
                              <div class="form-group ">
                                <label class="col-md-6 control-label" style="text-align: left; color: #3BB0BF;">Nomor Handphone</label>
                                <div class="col-md-6">
                                  <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $this->session->userdata('telepon'); ?>" readonly>
                                  <input type="hidden" name="id_data_lapangan" class="form-control" id="nama" value="<?php echo $id_data_lapangan; ?>">
                                  <input type="hidden" name="nama_tempat" class="form-control" id="nama" value="<?php echo $nama_tempat; ?>">
                                  <input type="hidden" name="nama_lapangan" class="form-control" id="nama" value="<?php echo $nama_lapangan; ?>">
                                  <input type="hidden" name="jam_mulai" class="form-control" id="nama" value="<?php echo $jam_mulai; ?>">
                                  <input type="hidden" name="jam_finish" class="form-control" id="nama" value="<?php echo $jam_finish; ?>">
                                  <input type="hidden" name="duration" class="form-control" id="nama" value="<?php echo $duration; ?>">
                                  <input type="hidden" name="tanggal_book" class="form-control" id="nama" value="<?php echo $tanggal_book; ?>">
                                  <input type="hidden" name="skema" class="form-control" id="nama" value="<?php echo $skema; ?>">
                                  <input type="hidden" name="total" value="<?php echo $total ?>">
                                </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="text">
                              <p style="color: #3BB0BF; text-align: left;"><i>Pastikan email dan nomor handphone Anda benar, karena bukti pembayaran Down Payment akan dikirimkan ke email tersebut.</i></p>
                              <p style="color: #3BB0BF; text-align: left;">Dengan menekan tombol <b style="color: #3BB0BF;">Booking</b>, Anda menyetujui <b style="color :#3BB0BF;">Syarat dan Ketentuan</b> yang kami terapkan.</p>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="box-footer">
                          <div class="pull-left">
                              <div class="booking">
                                  <a href="<?php echo base_url('Pembayaran/Detail_pemesanan'); ?>" type="button" class="btn btn-outline" style="background-color: #ffffff; color: #3BB0BF; border-color: #3BB0BF;">Back</a>
                                </div>
                          </div>
                          <div class="pull-right">
                              <div class="booking">
                                  <button type="submit" class="btn btn-outline" style="background-color: #3BB0BF; color: #ffffff;">Booking</button>
                                </div>
                          </div>
                      </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>