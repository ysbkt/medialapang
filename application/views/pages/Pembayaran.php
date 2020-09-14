<div id="payment">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="get" action="<?php echo base_url('Pembayaran/Booking') ?>">
                    <ul class="nav nav-pills nav-justified">
                        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Detail Pemesanan</a>
                        </li>
                        <li class="active"><a href="#"><i class="fa fa-check-square" style="color: #ffffff;"></i><br><p>Konfirmasi Transaksi</p></a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Pembayaran</a>
                        </li>
                    </ul>

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="text">
                            <p style="color: #000000;"><i>Kode : <?php echo $unik.$kode ?></i></p>
                            <p style="color: #000000;"><i>Down Payment : 50.<?php echo substr($kode, -3) ?> </i></p>
                            <input type="text" name="kode" value="<?php echo $unik.$kode ?>">
                            <input type="text" name="id_data_lapangan" value="<?php echo $id_data_lapangan ?>">
                            <input type="text" name="id_penyewa" value="<?php echo $this->session->userdata('id'); ?>">
                            <input type="text" name="hari_main" value="<?php echo $tanggal_book ?>">
                            <input type="text" name="jam_main" value="<?php echo $jam_mulai ?>">
                            <input type="text" name="jam_selesai" value="<?php echo $jam_finish ?>">
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

                </form>
            </div>
        </div>
    </div>
</div>