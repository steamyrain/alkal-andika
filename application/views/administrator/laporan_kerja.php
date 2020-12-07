<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Laporan Kerja Alat Berat
    </div>
    <?php 
        echo anchor(
            base_url('administrator/laporan/input'),
            '<button class="btn btn-sm btn-primary mb-3">
                <i class="fas fa-plus fa-sm"></i> 
                Tambah Data
            </button>'
        ) 
    ?>
    <div style="overflow-x:auto;">
    <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">ID</th>
  		<th class="text-center">Nama</th>
  		<th class="text-center">Lokasi Kerja</th>
  		<th class="text-center">Nomer Polisi</th>
  		<th class="text-center">Nomer Seri</th>
  		<th class="text-center">KM Awal</th>
  		<th class="text-center">KM Akhir</th>
  		<th class="text-center">KM Total</th>
  		<th class="text-center">BBM</th>
    </tr>
    <?php $i=1;foreach($laporan as $l):?>
    </thead>
    <tbody>
    <tr>
        <th class="text-center"><?php echo $l->id; ?></th>
        <th class="text-center"><?php echo $l->username; ?></th>
        <th class="text-center"><?php echo $l->project_location; ?></th>
        <th class="text-center"><?php echo $l->plate_number; ?></th>
        <th class="text-center"><?php echo $l->serial_number; ?></th>
        <th class="text-center"><?php echo $l->km_onStart; ?></th>
        <th class="text-center"><?php echo $l->km_onFinish; ?></th>
        <th class="text-center"><?php echo $l->km_total; ?></th>
        <th class="text-center"><?php echo $l->gasoline; ?></th>
    </tr>
    <?php endforeach;?>
        </tbody>
  </table>
</div>
</div>
