<section id="overview">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <?php foreach ($lapangan as $data) { ?>
          <div class="gambar">
            <img src="<?php echo base_url().'assets/gambar_lapangan/'.$data->gambar; ?>" style="width: 100%; max-height: 400px;" class="image-responsive">
          </div>

          <!-- <div class="detail">
            <div class="col-md-12">
              <div class="pull-left">
                <h3><strong>Halim Futsal</strong></h3>
              </div>
              <div class="pull-right">
                <h4><strong>4/5</strong></h4>
              </div>
            </div>
          </div> -->

          <div class="container">
            <div class="page-header">
                <h1><?php echo $data->nama_tempat ?></h1>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel with-nav-tabs">
                  <div class="panel-heading">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab1primary" data-toggle="tab">Overview</a></li>
                      <li><a href="#tab2primary" data-toggle="tab">Jadwal</a></li>
                      <li><a href="#tab3primary" data-toggle="tab">Review</a></li>
                      <li><a href="#tab4primary" data-toggle="tab">Photo</a></li>
                    </ul>
                  </div>
                  <div class="panel-body">
                    <div class="tab-content">
                      <div class="tab-pane fade in active" id="tab1primary">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4">
                              <h4>Nomor Telepon</h4>
                              <p><?php echo $data->telepon ?></p>
                              <small>untuk info lebih lanjut</small>
                            </div>
                            <div class="col-md-8">
                              <h4>Harga</h4>
                              <div class="row">
                                <div class="col-md-6">
                                  <p><b>Senin - Jumat</b></p>
                                  <p><b>Sabtu</b></p>
                                  <p><b>Minggu</b></p>
                                </div>
                                <div class="col-md-6">
                                  <p>Rp. <?php echo number_format($data->skema_1).' - Rp. '.number_format($data->skema_3) ?></p>
                                  <p>Rp. <?php echo number_format($data->skema_4).' - Rp. '.number_format($data->skema_6) ?></p>
                                  <p>Rp. <?php echo number_format($data->skema_4).' - Rp. '.number_format($data->skema_6) ?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <br>
                        </div>

                        <div class="col-md-12">
                          <div class="row">

                            <div class="col-md-4">
                              <h4>Jam Buka</h4>
                              <p>Setiap Hari</p>
                              <p><?php echo $data->jam_buka.' - '. $data->jam_tutup ?></p>
                            </div>

                            <div class="col-md-8">
                              <h4>Alamat</h4>
                              <div class="row">
                                <div class="col-md-12">
                                  <p style="text-align: justify;">
                                    <?php echo $data->alamat.', Kelurahan '.$data->kelurahan.', Kecamatan '.$data->kecamatan.', Kota '.$data->kotamadya.', '.$data->kodepos ?>
                                  </p>
                                </div>
                                <div class="col-md-12"><br>
                                  <div class="content">
                                    <div class="google-maps">
                                      <?php $alamat = 'Jalan Raya Kebayoran Lama No.19A, RT.10/RW.1, Grogol Selatan, Kebayoran Lama, RT.10/RW.1, Grogol Sel., Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12220' ?>
                                      <iframe frameborder="0" style="border:0; width: 100%;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCYPxI5I0NPveZTjw_kzSBHyvP3IRdYZHQ&q=<?php echo str_replace(" ","+",$alamat); ?>" allowfullscreen></iframe>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>

                      </div>

                      <div class="tab-pane fade" id="tab2primary">
                        <div class="col-md-12" >
                            <div class="row" style="background-color: #3BB0BF; padding: 5px 0; margin: 0 1px;">
                          <div class="container">
                              <table>
                                <form class="form-control" method="get" enctype="multipart/form-data" action="<?php echo base_url('Pembayaran/Detail_pemesanan') ?>">
                                  <div class="form-group">
                                    <div class="col-md-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">Hari :</span>
                                        <input type="date" class="form-control" name="tanggal_book" required>
                                        <input type="hidden" class="form-control" name="id_data_lapangan" value="<?php echo $id_data_lapangan ?>">
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">Mulai :</span>
                                        <select class="form-control" name="jam_mulai" required>
                                          <option value="">Jam</option>
                                          <?php foreach ($jam as $item) {?>
                                          <option value="<?php echo $item->jam ?>"><?php echo $item->jam ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">Finish :</span>
                                        <select class="form-control" name="jam_finish" required>
                                          <option value="">Jam</option>
                                          <?php foreach ($jam as $item) {?>
                                          <option value="<?php echo $item->jam ?>"><?php echo $item->jam ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="input-group">
                                        <div class="booking">
                                          <button type="submit" class="btn btn-outline" style=" background-color: #ffffff; color: #3BB0BF;">Booking</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12"><br>
                          <div id="calendar"></div>
                        </div>

                      </div>

                      <div class="tab-pane fade" id="tab3primary">
                        <div class="col-md-12">
                          <span class="heading">User Rating</span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>
                          <p>4.1 average based on 254 reviews.</p>
                          <hr style="border:3px solid #f1f1f1">

                          <div class="row">
                            <div class="side">
                              <div>5 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-5"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>150</div>
                            </div>
                            <div class="side">
                              <div>4 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-1"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>63</div>
                            </div>
                            <div class="side">
                              <div>3 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-3"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>15</div>
                            </div>
                            <div class="side">
                              <div>2 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-2"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>6</div>
                            </div>
                            <div class="side">
                              <div>1 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-1"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>20</div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="tab4primary">
                        <div class="container">
                          <div class="row">
                            <div class="list-group gallery">
                              <?php foreach ($gallery as $item) { ?>
                              <div class="col-sm-4 col-xs-6 col-md-3 col-lg-3">
                                <a target="_blank" class="thumbnail fancybox" rel="lightbox" href="<?php echo base_url().'assets/gambar_lapangan/'.$item->gambar; ?>" style="width: 100%; height: 150px;" >
                                  <img src="<?php echo base_url().'assets/gambar_lapangan/'.$item->gambar; ?>" style="width: 100%; height: 140px;">
                                </a>
                              </div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">
    var mybr = document.createElement('br');
    $(document).ready(function(){
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('#calendar').fullCalendar('render');
    });
    $('#tab2primary a:first').tab('show');
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $('#calendar').fullCalendar({
      defaultView: 'agendaWeek',
      events: [
         
                  
          <?php
            foreach ($getJadwal as $jadwal)
            { 
              $start_day = date('d', strtotime($jadwal->hari_main));
              $smonth = date('n', strtotime($jadwal->hari_main));
              $start_month = $smonth - 1;
              $start_year = date('Y', strtotime($jadwal->hari_main));
              $end_year = date('Y', strtotime($jadwal->hari_main));
              $end_day = date('d', strtotime($jadwal->hari_main));
              $emonth = date('n', strtotime($jadwal->hari_main));
              $end_month = $emonth - 1;
              ?>
              {
                title: "Penyewa :",
                start: "<?php echo $jadwal->hari_main; ?> <?php echo $jadwal->jam_main ?>",
                end: "<?php echo $jadwal->hari_main; ?> <?php echo $jadwal->jam_selesai ?>",
                color: 'rgba(0, 0, 0, 0.7)',
                // url: '<?= base_url()?>view-jadwal?date=<?= $jadwal->hari_main ?>',
              },
              
          <?php }
          ?>
          
            
        ],
        eventColor: '#FFF'
    })
});
</script>