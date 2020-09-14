<!--==========================
  Hero Section
  ============================-->
  <section id="booking">
    <div class="booking-container">
      <div class="container wow fadeInUp">
        <div class="booking-logo">
          <img class="" src="<?php echo base_url() ?>assets/img/trio-lapang.png" style="max-width: 40%;" title="Media Lapang" alt="Media Lapang">
          <h1>Media Lapang</h1>
          <h4>Medianya para pencari lapangan se-Jakarta Timur</h4>
        </div>
      </div>

      <form action="<?php echo base_url('Lapangan/Search'); ?>" class="navbar-form" role="search" method="get">
          <div class="input-group col-md-3">
            <select name="jenislapangan" id="jenislapangan" class="form-control">
              <option value="" style="text-align: center;" text-muted>-- Pilih Jenis Lapangan --</option>
              <?php foreach ($lapangan as $data) { ?>
              <option value="<?php echo $data->id_lapangan ?>"><?php echo ucwords($data->jenis_lapangan) ?></option>
              <?php } ?>
            </select>
          </div>
        <div class="input-group col-md-3">
          <!-- <input type="text" class="form-control" placeholder="Provinsi, Kota, Kecamatan"> -->
          <select name="area" id="area" class="form-control">
            <option value="" style="text-align: center;">-- Kecamatan --</option>
            <?php foreach ($kecamatan as $data) { ?>
            <option value="<?php echo $data->nama_kecamatan ?>"><?php echo ucwords($data->nama_kecamatan) ?></option>
            <?php } ?>
          </select>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Cari</button>
          </span>
        </div>
      </form>
      <br>
      <p style="color: #000;"><strong>Temukan Tempat, Jadwal, serta booking secara instant.</strong></p>

    </div>
  </section>

  <!--==========================
  Porfolio Section
  ============================-->
  <section id="portfolio">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Jenis Lapangan</h3>
          <div class="section-title-divider"></div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-4">
          <a class="portfolio-item" style="background-image: url('<?php echo base_url() ?>assets/img/basket.jpg');" href="<?php echo base_url('Lapangan/Jenis/2') ?>">
            <div class="details">
              <h4>Lapangan</h4>
              <span>Basket</span>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a class="portfolio-item" style="background-image: url('<?php echo base_url() ?>assets/img/futsal.jpg');" href="<?php echo base_url('Lapangan/Jenis/1') ?>">
            <div class="details">
              <h4>Lapangan</h4>
              <span>Futsal</span>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a class="portfolio-item" style="background-image: url('<?php echo base_url() ?>assets/img/badminton.jpg');" href="<?php echo base_url('Lapangan/Jenis/3') ?>">
            <div class="details">
              <h4>Lapangan</h4>
              <span>Badminton</span>
            </div>
          </a>
        </div>

      </div>
    </div>
  </section>