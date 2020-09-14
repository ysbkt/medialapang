<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    <div class="card-header">
                                        <strong class="card-title">List Penyedia</strong>
                                    </div>
                                    <table width="100%" class="table table-borderless table-striped table-earning" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pemilik</th>
                                                <th>Tempat</th>
                                                <th>Jam Operasional</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Reason</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($penyedia as $data) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo ucwords($data->nama_pemilik) ?></td>
                                                <td><?php echo ucwords($data->nama_tempat) ?></td>
                                                <td><?php echo $data->jam_buka.' - '.$data->jam_tutup ?> WIB</td>
                                                <td ><?php echo $data->email ?></td>
                                                <td ><?php echo ucwords($data->alamat.', '.$data->kelurahan.', '.$data->kecamatan.', '.$data->kotamadya.', '.$data->kodepos) ?></td>
                                                <td ><?php echo $data->telepon ?></td>
                                                <td class="text-right">
                                                    <?php if (($data->status)== 1) {
                                                echo "Approve";}elseif (($data->status)== 0){
                                                    echo "Pending"; }else{
                                                        echo "Reject";
                                                    }?>
                                                    
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="card-body">
                                                                <button type="button" class="btn btn-sm btn-outline-success">approve</button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger">reject</button>
                                                        </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>