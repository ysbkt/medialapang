        <div id="page-wrapper">
            <!-- /.row -->
            <div class="col-md-12">
                <div class="row">
                    
                
            <div class="col-md-6">                    
                <div class="row main">
                    <div class="main-login main-center">
                    <!-- <h5>Sign up once and watch any of our free demos.</h5> -->
                    <?php echo $this->session->flashdata('user'); ?>
                        <form class="" method="post" action="<?php echo base_url('Account/ProsesPenyediaRegister') ?>">
                            
                            <div class="form-group">
                                <label for="nama_pemilik" class="cols-sm-2 control-label">Your Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik"  placeholder="Enter your Name"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_tempat" class="cols-sm-2 control-label">Your Place</label>                                    
                                <div class="cols-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="nama_tempat" id="nama_tempat"  placeholder="Enter your Name"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telepon" class="cols-sm-2 control-label">Your Phone</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="telepon" id="telepon"  placeholder="Enter your Email" onkeypress="return hanyaAngka(event)" maxlength="13"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="operasional" class="cols-sm-2 control-label">Operasional</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Open</span>
                                        <!-- <input type="text" class="form-control" name="nama" id="nama"  placeholder="Enter your Name"/> -->
                                        <select name="jam_buka" class="form-control">
                                            <option>-- Jam Buka --</option>
                                            <?php foreach ($jam as $data) { ?>
                                            <option value="<?php echo $data->jam ?>"><?php echo $data->jam ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Close</span>
                                        <!-- <input type="text" class="form-control" name="nama" id="nama"  placeholder="Enter your Name"/> -->
                                         <select name="jam_tutup" class="form-control">
                                            <option>-- Jam Tutup --</option>
                                            <?php foreach ($jam as $data) { ?>
                                            <option value="<?php echo $data->jam ?>"><?php echo $data->jam ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="cols-sm-2 control-label">Address</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="alamat" id="alamat"  placeholder="Enter your Email"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kelurahan" class="cols-sm-2 control-label">Kelurahan</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="kelurahan" id="kelurahan"  placeholder="Enter your Email"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kecamatan" class="cols-sm-2 control-label">Kecamatan</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map fa" aria-hidden="true"></i></span>
                                        <select name="kecamatan" id="kecamatan" class="form-control">
                                            <option value="" style="text-align: center;">-- Kecamatan --</option>
                                            <?php foreach ($kecamatan as $data) { ?>
                                            <option value="<?php echo $data->nama_kecamatan ?>"><?php echo ucwords($data->nama_kecamatan) ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="kecamatan" id="kecamatan"  placeholder="Enter your Email"/> -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kotamadya" class="cols-sm-2 control-label">Kotamadya</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="kotamadya" id="kotamadya"  placeholder="Enter your Email"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kodepos" class="cols-sm-2 control-label">Kodepos</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="kodepos" id="kodepos"  placeholder="Enter your Email" onkeypress="return hanyaAngka(event)" maxlength="6"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control message" name="password" id="password"  placeholder="Enter your Password"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control message" name="confirm" id="confirm" onchange="Check()"  placeholder="Confirm your Password"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="submit" id="ok" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">                    
                <div class="row main">
                    <div class="main-logo logo-center">
                        <img src="<?php echo base_url(); ?>assets/img/football.gif" style="width: 100%;" title="Please Aktifkan Saya">                    
                    </div>
                </div>
            </div>

                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <style>
            #playground-container {
                height: 500px;
                overflow: hidden !important;
                -webkit-overflow-scrolling: touch;
            }

            .container{
                width: 100%;
            }

            .main{
                margin:10px 15px;
            }

            h1.title { 
                font-size: 50px;
                font-family: 'Passion One', cursive; 
                font-weight: 400; 
            }

            hr{
                width: 10%;
                color: #fff;
            }

            .form-group{
                margin-bottom: 15px;
            }

            label{
                margin-bottom: 15px;
            }

            input,
            input::-webkit-input-placeholder {
                font-size: 11px;
                padding-top: 3px;
            }

            .main-login{
                background-color: #fff;
                /* shadows and rounded borders */
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            }
            .main-logo{
                background-color: #fff;
                /* shadows and rounded borders */
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            }

            .logo-center{
                margin-top: 30px;
                margin: 0 auto;
                /*max-width: 400px;*/
                padding: 10px 40px;
                background:#fff;
                    color: #FFF;
                text-shadow: none;
                /*-webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);*/
                /*-moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);*/
                /*box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);*/
                border-color: none;

            }

            .form-control {
                height: auto!important;
                padding: 8px 12px !important;
            }
            .input-group {
                -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.21)!important;
                -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.21)!important;
                box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.21)!important;
            }
            #buttonregist {
                border: 1px solid #ccc;
                margin-top: 28px;
                padding: 6px 12px;
                color: #666;
                text-shadow: 0 1px #fff;
                cursor: pointer;
                -moz-border-radius: 3px 3px;
                -webkit-border-radius: 3px 3px;
                border-radius: 3px 3px;
                -moz-box-shadow: 0 1px #fff inset, 0 1px #ddd;
                -webkit-box-shadow: 0 1px #fff inset, 0 1px #ddd;
                box-shadow: 0 1px #fff inset, 0 1px #ddd;
                background: #f5f5f5;
                background: -moz-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f5f5f5), color-stop(100%, #eeeeee));
                background: -webkit-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
                background: -o-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
                background: -ms-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
                background: linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5f5f5', endColorstr='#eeeeee', GradientType=0);
            }
            .main-center{
                margin-top: 30px;
                margin: 0 auto;
                max-width: 400px;
                padding: 10px 40px;
                background:#009edf;
                    color: #FFF;
                text-shadow: none;
                -webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
                -moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
                box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);

            }
            span.input-group-addon i {
                color: #009edf;
                font-size: 17px;
            }

            .login-button{
                margin-top: 5px;
            }

            .login-register{
                font-size: 11px;
                text-align: center;
            }
        </style>

        <script type="text/javascript">
            function Check(){
                var password        = $("#password").val();
                var confirmPassword = $("#confirm").val();

                if (password != confirmPassword){
                    $('.message').css("border","2px solid #FF1100");
                    $('#ok').attr('disabled','disabled');
                }else{
                    $('.message').css("border","2px solid #60FF02");
                    $('#ok').removeAttr('disabled');
                }
            }

            function hanyaAngka(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                return true;
            }
        </script>