<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    <div class="card-header">
                                        <strong class="card-title">List Penyewa</strong>
                                    </div>
                                    <table width="100%" class="table table-borderless table-striped table-earning" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($penyewa as $data) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo ucwords($data->nama) ?></td>
                                                <td ><?php echo $data->email ?></td>
                                                <td ><?php echo $data->telepon ?></td>
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