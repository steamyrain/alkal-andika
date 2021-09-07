<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul 
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" 
        style="background:#fff200;color:black;" 
        id="accordionSidebar"
    >

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_URL('administrator/dashboard')?>">
        <div class="sidebar-brand-icon animated slideInUp">
          <img src="<?php echo base_url() ?>assets/img/ac.png" alt="ac" width="60">
        </div>
        <div class="sidebar-brand-text mx-1" style="color:black;">SILOLABIMA</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_URL('administrator/dashboard')?>">
            <img src="<?php echo base_url() ?>assets/img/BM.png" alt="ab" width="42">
            <span style="color:black;">
                UNIT PERALATAN DAN PERBEKALAN BINA MARGA
            </span>
        </a>
    </li>


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-users" style="color:black;"></i>
          <span style="color:black;">E-Kinerja</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header" style="color:black;">Pilihan Kinerja:</h6>
            <a class="collapse-item" href="<?php echo base_url('administrator/kinerja') ?>">Kinerja</a>
            <!-- 
            <hr style="width: inherit; height: inherit;">
            <h6 class="collapse-header" style="color:black;">Validasi Kinerja:</h6>
            <a class="collapse-item" href="">Validasi Kinerja</a>
            <hr style="width: inherit; height: inherit;">
            <h6 class="collapse-header" style="color:black;">Esign Kinerja:</h6>
            <a class="collapse-item" href="">Request Esign Operator</a>
            -->
          </div>
        </div>
      </li>

      <!-- Nav Item - Peralatan Collapse Menu -->
      <li class="nav-item">
        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapsePeralatan" 
            data-parent="#accordionSidebar"
            aria-expanded="true" 
            aria-controls="collapsePeralatan"
        >
          <i style="color:black;" class="fas fa-file"></i>
          <span style="color:black;">Daily Task</span>
        </a>
        <div 
            id="collapsePeralatan" 
            class="collapse" 
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
            <a class="collapse-item" href="<?php echo base_url('administrator/laporan') ?>">Laporan Kerja Alat Berat</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/laporandt') ?>">Laporan Kerja Dump Truck</a>
            <a class="collapse-item" href="<?php echo base_URL('administrator/surattugas'); ?>">Surat Tugas</a>
            <a class="collapse-item" href="<?php echo base_URL('administrator/perencanaan'); ?>">Perencanaan & <br> Pelaksanaan</a>
            <h6 class="collapse-header" style="color:black;">Esign Daily Task:</h6>
            <a class="collapse-item" href="<?php echo base_URL('administrator/surattugas/esign'); ?>">Request Esign Surat Tugas</a>
          </div>
        </div>
      </li>

    <!-- Nav Item - Alat Berat Collapse Menu -->
    <li class="nav-item"> 
        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapseAlatBerat" 
            aria-expanded="true" 
            aria-controls="collapseAlatBerat"
            style="color:black;"
        >
            <i class="fas fa-truck" style="color:black;"></i>
            <span>Peralatan</span>
        </a>
        <div 
            id="collapseAlatBerat"
            class="collapse"
            aria-labelledby="headingAlatBerat"
            data-parent="#accordionSidebar" 
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilihan :</h6> 
                <a class="collapse-item" style="color:black;" href="<?php echo base_URL('administrator/alatberat'); ?>">Alat Berat</a>
                <a class="collapse-item" style="color:black;" href="<?php echo base_URL('administrator/abservicehistory'); ?>">Servis Alat Berat</a>
                <hr style="width: inherit; height: inherit;">
                <a class="collapse-item" style="color:black;" href="<?php echo base_URL('administrator/dumptruck'); ?>">Dump Truck</a>
                <a class="collapse-item" style="color:black;" href="<?php echo base_URL('administrator/dtservicehistory'); ?>">Servis Dump Truck</a>
                <hr style="width: inherit; height: inherit;">
                <a class="collapse-item" style="color:black;" href="<?php echo base_URL('administrator/kdo'); ?>">KDO</a>
            </div>
        </div>
    </li>

    <!-- esign Collapse Menu -->
    <?php if(isset($this->session->userdata['nip']) and !empty($this->session->userdata['nip'])) {?>
        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#"
                data-toggle="collapse" 
                data-target="#collapseESign" 
                aria-expanded="true" 
                aria-controls="collapseESign"
            >
                <i class="fas fa-signature" style="color:black;"></i>
                <span style="color:black;">E-Sign</span>
            </a>
            <div 
                id="collapseESign"
                class="collapse" 
                aria-labelledby="headingPages" 
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
                    <a class="collapse-item" href="<?php echo base_URL('administrator/esign')?>">Surat Tugas</a>
                    <a class="collapse-item" href="<?php echo base_URL('administrator/esign/esign_ekinerja')?>">E-Kinerja</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <!-- validasi Collapse Menu -->
    <?php if(isset($this->session->userdata['nip']) and !empty($this->session->userdata['nip'])) {?>
        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#"
                data-toggle="collapse" 
                data-target="#collapseValidasi" 
                aria-expanded="true" 
                aria-controls="collapseValidasi"
            >
                <i class="fas fa-check" style="color:black;"></i>
                <span style="color:black;">Validasi E-Kinerja</span>
            </a>
            <div 
                id="collapseValidasi"
                class="collapse" 
                aria-labelledby="headingPages" 
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
                    <a class="collapse-item" href="<?php echo base_URL('administrator/validasi')?>">e-kinerja pjlp</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <!-- Material Collapse Menu -->
    <li class="nav-item">
        <a 
            class="nav-link collapsed" 
            href="#"
            data-toggle="collapse" 
            data-target="#collapsePages" 
            aria-expanded="true" 
            aria-controls="collapsePages"
        >
            <i class="fas fa-oil-can" style="color:black;"></i>
            <span style="color:black;">Perbekalan</span>
        </a>
        <div 
            id="collapsePages"
            class="collapse" 
            aria-labelledby="headingPages" 
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
                <a class="collapse-item" href="#">BBM</a>
            </div>
        </div>
    </li>
    
     <li class="nav-item">
        <a 
            class="nav-link collapsed" 
            href="#"
            data-toggle="collapse" 
            data-target="#collapsePagess" 
            aria-expanded="true" 
            aria-controls="collapsePages"
        >
            <i class="fas fa-check-double" style="color:black;"></i>
            <span style="color:black;">E-Ceklis</span>
        </a>
        <div 
            id="collapsePagess"
            class="collapse" 
            aria-labelledby="headingPages" 
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
               <!--  <a class="collapse-item"  href="<?php echo base_URL('administrator/ceklist')?>">Laporan Berskala</a> -->
                <a class="collapse-item"  href="<?php echo base_URL('administrator/ceklist_harian')?>">Kendaraan & Peralatan</a>
                <!-- <a class="collapse-item"  href="<?php echo base_URL('administrator/ceklist_db')?>">Data Base</a> -->
            </div>
        </div>
    </li>
    
     <li class="nav-item">
        <a 
            class="nav-link collapsed" 
            href="#"
            data-toggle="collapse" 
            data-target="#collapseSmart" 
            aria-expanded="true" 
            aria-controls="collapseSmart"
        >
              <i class="fas fa-folder" style="color:black;"></i>
            <span style="color:black;">Smart Filing</span>
        </a>
        <div 
            id="collapseSmart"
            class="collapse" 
            aria-labelledby="headingSmart" 
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
                <a class="collapse-item"  href="<?php echo base_URL('administrator/smart_filing_in')?>">Surat Masuk</a> 
                <a class="collapse-item"  href="<?php echo base_URL('administrator/smart_filing_out')?>">Surat Keluar</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <form id="form-logout" method="post" action="<?php echo base_URL('auth/logout')?>" style="display: none;">
        </form>
        <a class="nav-link" href="#" target="_blank" onclick="event.preventDefault();document.getElementById('form-logout').submit()">
            <i class="fas fa-sign-out-alt" style="color:black;"></i>
            <span style="color:black;">Logout</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <h5 class="font-weight-bold" style="color:black; font-size: clamp(0.75rem,1.25vw,2rem)">SISTEM PENGELOLAAN PERALATAN KEBINAMARGAAN</h5>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome, <?php echo $this->session->userdata('username') ?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url() ?>assets/img/BM.png" alt="bm" width="60">

                </a>
            </li>

          </ul>

        </nav>
