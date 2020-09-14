<!--==========================
  Contact Section
  ============================-->
  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contact Us</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Silahkan kirim pesan ke tim kami jika ada pertanyaan</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-md-push-2">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Jalan Pinang Ranti 2<br>Jakarta Timur</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>medialapang@gmail.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>+62 21 2280 3416</p>
            </div>

          </div>
        </div>

        <div class="col-md-5 col-md-push-2">
          <div class="form">
            <div id="sendmessage">
              <?php echo $this->session->flashdata('status'); ?>
            </div>
            <div id="errormessage"></div>
            <form action="<?php echo base_url('Contact/Ask'); ?>" method="post" role="form" class="contactform">
              <div class="form-group">
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" data-rule="minlen:4" data-msg="Please enter at least 4 chars"  required/>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email"  required/>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject"  required/>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="pesan" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Pesan" style="resize: none;" required></textarea>
                <div class="validation"></div>
              </div>
                <div class="g-recaptcha" data-sitekey="6LefNGMUAAAAAMYUvxiww78AHF_XFCRCcQ6gbiCH"></div>
              <div class="text-center"><br>
                <button type="submit" class="btn btn-outline btn-info btn-block">Send Message</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>