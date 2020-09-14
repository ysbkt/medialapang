<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo base_url('Home'); ?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

						<li><a href="<?php echo base_url('Home/Gallery'); ?>" class=""><i class="lnr lnr-plus-circle"></i> <span>Gallery</span></a></li>
						<li class="has-sub">
                            <a href="<?php echo base_url('Home/ListPenyedia'); ?>">
                                <i class="fa fa-user-circle"></i> List Penyedia</a>
                        </li>
                        <li class="has-sub">
                            <a href="<?php echo base_url('Home/ListPenyewa'); ?>">
                                <i class="fa fa-user-circle-o"></i> List Penyewa</a>
                        </li>
                        <li class="has-sub">
                            <a href="<?php echo base_url('Home/Pembayaran'); ?>"><i class="fa fa-money"></i> Pembayaran</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Home/Jadwal'); ?>">
                                <i class="fa fa-calendar-check-o"></i> Jadwal</a>
                        </li>


						<li><a href="#" class=""><i class="lnr lnr-user"></i> <span>Manager Menu</span></a></li>

						<li><a href="#" class=""><i class="lnr lnr-user"></i> <span>User Menu</span></a></li>

						<li><a href="<?php echo base_url('Account'); ?>" class=""><i class="lnr lnr-dice"></i> <span>Manage Account</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR