
<?php foreach ($dataharga as $key) {
    $skema = $key->skema_1;
} ?>
<div id="payment">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="get" action="<?php echo base_url('Pembayaran/Konfirmasi_pemesanan'); ?>">

                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a href="#"><i class="fa fa-eye" style="color: #ffffff;"></i><br><p>Detail Pemesanan</p></a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-check-square"></i><br>Konfirmasi Transaksi</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Pembayaran</a>
                        </li>
                    </ul>

                    <div class="box">
                        <div class="row">
                            <div class="col-md-6">
                              <a href="<?php echo base_url('Lapangan/Overview') ?>">
                                <img src="<?php echo base_url() ?>assets/img/badminton.jpg" >
                              </a>
                            </div>
                            <div class="col-md-6">
                                <div class="row">                      
                                    <div class="panel-heading">
                                      <div class="pull-right">
                                        <?php foreach ($datalapangan as $item) { ?>
                                        <h2 style="color: #3BB0BF; text-align: right;"><strong><?php echo ucwords($item->nama_tempat) ?></strong></h2>
                                        <h5 style="color: #3BB0BF; text-align: right;"><?php echo ucwords($item->nama_lapangan)  ?></h5>
                                        <input type="hidden" name="nama_tempat" value="<?php echo $item->nama_tempat ?>">
                                        <input type="hidden" name="nama_lapangan" value="<?php echo $item->nama_lapangan ?>">
                                        <input type="hidden" name="id_data_lapangan" value="<?php echo $item->id_data_lapangan ?>">
                                        <input type="hidden" name="skema" value="<?php echo $item->skema_1 ?>">
                                    <?php } ?>
                                      </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="text">
                                      <p><?php echo date('d F Y',strtotime($tanggal_book)) ?></p>
                                        <input type="hidden" name="tanggal_book" value="<?php echo $tanggal_book ?>">
                                      <br>
                                      <p>Pukul <?php echo $jam_mulai ?> - <?php echo $jam_finish ?></p>
                                        <input type="hidden" name="jam_finish" value="<?php echo $jam_finish ?>">
                                        <input type="hidden" name="jam_mulai" value="<?php echo $jam_mulai ?>">
                                    </div>

                                    <div class="panel-heading">                            
                                        <div class="pull-right">
                                            <h3 style="color: #3BB0BF; text-align: right;"><strong>Rp <?php echo number_format($skema) ?></strong></h3>
                                            <input type="hidden" name="skema" value="<?php echo $skema ?>">

                                            <h3 style="color: #3BB0BF; text-align: right;"><strong>Lama main : <?php echo $duration ?> Jam</strong></h3>
                                            <input type="hidden" name="duration" value="<?php echo $duration ?>">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">                            
                        <div class="pull-right">
                            <h4 style="color: #3BB0BF; text-align: right;"><strong>Total : Rp <?php echo number_format($skema * $duration) ?></strong></h4>
                            <input type="hidden" name="total" value="<?php echo $skema * $duration ?>">
                            <h4 style="color: #3BB0BF; text-align: right;"><strong>Down Payment : Rp 50,000</strong></h4>
                            <input type="hidden" name="dp" value="<?php echo '50000' ?>">
                            <i style="color: #3BB0BF;">Down Payment dibayar melalui website medialapang.com, sisa biaya dibayarkan tunai di tempat lapangan.</i>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="box-footer">
                        <div class="pull-left">
                            <div class="booking">
                                <a href="<?php echo base_url('Lapangan/Overview'); ?>" type="button" class="btn btn-outline" style="background-color: #ffffff; color: #3BB0BF; border-color: #3BB0BF;">Cancel</a>
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