<section id="arena">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <!-- <?php print_r($datalapangan) ?> -->
          <!-- <div class="side-search"> -->
            <div class="col-md-4" id="side-menu">
              <div class="col-md-12">
                <div class="form-group">
                  <select name="jenislapangan" id="jenislapangan" class="form-control">
                    <option value="" style="text-align: center;" text-muted>-- Pilih Jenis Lapangan --</option>
                    <?php foreach ($lapangan as $data) { ?>
                    <option value="<?php echo $data->jenis_lapangan ?>"><?php echo ucwords($data->jenis_lapangan) ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <select name="area" id="area" class="form-control">
                    <option value="" style="text-align: center;">-- Kecamatan --</option>
                    <?php foreach ($kecamatan as $data) { ?>
                    <option value="<?php echo $data->nama_kecamatan ?>"><?php echo ucwords($data->nama_kecamatan) ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          <!-- </div> -->

          <div class="col-md-8">
            <div class="row">
              <div class="col-md-12">
                <?php foreach ($datalapangan as $data) { ?>
                <div class="box">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="<?php echo base_url().'assets/gambar_lapangan/'.$data->gambar ?>" style="min-width: 100%; height: auto;" class="image-responsive">
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="panel-heading">
                          <div class="pull-left">
                            <h3><strong><?php echo ucwords($data->nama_tempat) ?></strong></h3>
                            <small><?php echo $data->nama_lapangan ?></small>
                          </div>
                          <div class="pull-right">
                            <h4><strong>4/5</strong></h4>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="text">                      
                          <span><strong>Alamat</strong></span>
                          <br>
                          <p><?php echo $data->alamat ?></p>
                          <br>
                          <span><strong>Harga</strong></span>
                          <br>
                          <p>Rp. <?php echo number_format($data->skema_1).' - '. number_format($data->skema_6) ?></p>
                          <br>
                          <span><strong>Jam Buka</strong></span>
                          <p><?php echo $data->jam_buka. ' - '. $data->jam_tutup ?> WIB</p>
                        </div>
                        <div class="col-md-12">
                          <div class="booking">
                            <a href="<?php echo base_url('Lapangan/Overview/'.$data->dp_id_data_lapangan); ?>" type="button" class="btn btn-outline" style="background-color: #3BB0BF; color: #ffffff;">Booking</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><br>
                <hr>
                <?php } ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>