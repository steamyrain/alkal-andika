<div class="container-fluid">
  <div class="col-md-12">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Laporan Kerja 
    </div>

    <?php 
        echo anchor(
            'administrator/laporan/input',
            '<button class="btn btn-sm btn-primary mb-3">
                <i class="fas fa-plus fa-sm"></i> 
                Tambah Data
            </button>'
        ) 
    ?> 
  <table id="data-tabel" class="table table-bordered table-striped" width="100%">
  	<thead>
    <tr>
  		<th>No</th>
  		<th>Nama</th>
  		<th>Lokasi Kerja</th>
  		<th>Nomer Polisi</th>
  		<th>KM Awal</th>
  		<th>KM Akhir</th>
  		<th>Jarak</th>
  		<th>BBM</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1;foreach($laporan as $l):?>
    <tr>
        <th class="text-center"><?php echo $i++; ?></th>
        <th class="text-center"><?php echo $l->nama; ?></th>
        <th class="text-center"><?php echo $l->lokasiKerja; ?></th>
        <th class="text-center"><?php echo $l->npol; ?></th>
        <th class="text-center"><?php echo $l->kmawal; ?></th>
        <th class="text-center"><?php echo $l->kmakhir; ?></th>
        <th class="text-center"><?php echo $l->jarak; ?></th>
        <th class="text-center"><?php echo $l->bbm; ?></th>
    </tr>
    <?php endforeach;?>
  </table>
</tbody>
</div>
