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
        <div class="sidebar-brand-icon">
          <img src="<?php echo base_url() ?>assets/img/ab.png" alt="ab" width="60">
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
          <span style="color:black;">Kinerja</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
            <a class="collapse-item" href="<?php echo base_url('administrator/kinerja') ?>">Operator</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/operator') ?>">Pengemudi</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/mekanik') ?>">Mekanik</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/pmj') ?>">PMJ</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/perbekalan') ?>">Admin Perbekalan</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/peralatan') ?>">Admin Peralatan</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/tu') ?>">Admin TU</a>
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
          <i style="color:black;" class="fas fa-fw fa-wrench"></i>
          <span style="color:black;">Peralatan</span>
        </a>
        <div 
            id="collapsePeralatan" 
            class="collapse" 
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
            <a class="collapse-item" href="<?php echo base_url('administrator/laporan') ?>">Laporan Kerja Alat Berat</a>
            <a class="collapse-item" href="<?php echo base_url('administrator/laporandt') ?>">Laporan Kerja Dump Truck</a>
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
            <span>Alat Berat</span>
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
                <a class="collapse-item" style="color:black;" href="<?php echo base_URL('administrator/dumptruck'); ?>">Dump Truck</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Surat Kerja Collapse Menu -->
    <li class="nav-item">
        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapseSurat" 
            aria-expanded="true" 
            aria-controls="collapseSurat"
        >
            <i class="fas fa-file" style="color:black;"></i>
            <span style="color:black;">Surat Tugas</span>
        </a>
        <div    
            id="collapseSurat" 
            class="collapse" 
            aria-labelledby="headingSurat" 
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header" style="color:black;">Pilihan :</h6>
                <a class="collapse-item" href="<?php echo base_URL('administrator/surattugas'); ?>">Surat Tugas</a>
            </div>
        </div>
    </li>

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
            <span style="color:black;">Material</span>
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
        <a class="nav-link" href="<?php echo base_url('administrator/auth/logout') ?>">
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">welcome</span>
                <img class="img-profile rounded-circle" src="<?php echo base_url() ?>assets/img/BM.png" alt="bm" width="60">

                </a>
            </li>

          </ul>

        </nav>
