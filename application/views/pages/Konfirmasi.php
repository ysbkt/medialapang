<div id="payment">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="get" action="<?php echo base_url('Pembayaran/Booking') ?>">
                    <ul class="nav nav-pills nav-justified">
                        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Detail Pemesanan</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-check-square" ></i><br>Konfirmasi Transaksi</a>
                        </li>
                        <li class="active"><a href="#"><i class="fa fa-money" style="color: #ffffff;"></i><br><p>Pembayaran</p></a>
                        </li>
                    </ul>

                    <div class="col-md-12">
                      <div class="row">
                        <div class="box">
                          <div class="text">
                            <h3 style="color: #3BB0BF;">Terimakasih telah memesan lapangan melalui Medialapang.com</h3>
                            <p style="color: #3BB0BF; text-align: left;"><i>Kode : <?php echo  $unik.$kode ?></i></p>
                            <p style="color: #3BB0BF; text-align: left;"><i>Down Payment : 50.<?php echo substr($kode, -3) ?> </i></p>
                            <?php $depe = '50'.substr($kode, -3) ?>
                            <input type="hidden" name="kode" value="<?php echo $unik.$kode ?>">
                            <input type="hidden" name="id_data_lapangan" value="<?php echo $id_data_lapangan ?>">
                            <input type="hidden" name="id_penyewa" value="<?php echo $this->session->userdata('id'); ?>">
                            <input type="hidden" name="hari_main" value="<?php echo $tanggal_book ?>">
                            <input type="hidden" name="jam_main" value="<?php echo $jam_mulai ?>">
                            <input type="hidden" name="jam_selesai" value="<?php echo $jam_finish ?>">
                            <input type="hidden" name="total" value="<?php echo $total ?>">
                            <input type="hidden" name="depe" value="<?php echo $depe ?>">
                            <br>
                            <div class="row">                                
                                <div class="col-xs-6">
                                    <span><p style="color: #3BB0BF; text-align: left;"><strong>Total Pemesanan</strong></p></span>
                                    <span><p style="color: #3BB0BF; text-align: left;"><strong>Down Payment</p></span>
                                </div>
                                <div class="col-xs-6">
                                    <p style="color: #3BB0BF; text-align: left;"><strong> : Rp <?php echo number_format($total) ?></strong></p>
                                    <input type="hidden" name="skema" value="<?php echo $skema ?>">
                                    <p style="color: #3BB0BF; text-align: left;"><strong> : Rp <?php echo number_format((intval($depe))) ?></strong></p>
                                    <input type="hidden" name="dp" value="<?php echo '50000' ?>">
                                </div>
                            </div>
                            <br>
                            <div class="clearfix"></div>
                            <p style="color: #3BB0BF; text-align: left;">Transaksi Anda belum selesai. Pesanan akan disimpan dan dicatat jika pembayaran down payment dibayar.</p>
                            <p style="color: #3BB0BF; text-align: left;">Segera lakukan pembayaran sebelum batas waktu. Rekap transaksi telah kami kirimkan ke email Anda.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <h3 style="color: #3BB0BF;">Cara Pembayaran</h3>
                    <p style="color: #3BB0BF;">1. Transfer Melalui ATM, Internet Banking, atau Mobile Banking Anda</p>
                    <p style="color: #3BB0BF;">2. Pilih tujuan transfer dari salah satu bank dan nomor rekening yang tertera di bawah</p>
                    <p style="color: #3BB0BF;">3. Masukkan jumlah transfer disertai kode unik anda yaitu 50.<?php echo substr($kode, -3) ?> (Kode Unik : <?php echo substr($kode, -3) ?>)</p>
                    <br>
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