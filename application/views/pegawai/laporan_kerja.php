<div class="container-fluid">
    <div class="alert alert-success" role="alert">
    <i class="fas fa-clipboard"></i> Laporan Kerja Alat Berat <b><?php echo $username ?></b>
    </div>
    <?php 
        echo anchor(
            base_url('pegawai/laporan/input'),
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
  		<th class="text-center">Tanggal</th>
  		<th class="text-center">Lokasi Kerja</th>
  		<th class="text-center">Nomer Polisi</th>
  		<th class="text-center">Nomer Seri</th>
  		<th class="text-center">KM/HM Awal</th>
  		<th class="text-center">KM/HM Akhir</th>
  		<th class="text-center">KM/HM Total</th>
    </tr>
    <?php $i=1;foreach($laporan as $l):?>
    </thead>
    <tbody>
    <tr> 
        <th class="text-center"><?php echo $l->created_at; ?></th>
        <th class="text-center"><?php echo $l->project_location; ?></th>
        <th class="text-center"><?php echo $l->plate_number; ?></th>
        <th class="text-center"><?php echo $l->serial_number; ?></th>
        <th class="text-center"><?php echo $l->km_onStart; ?></th>
        <th class="text-center"><?php echo $l->km_onFinish; ?></th>
        <th class="text-center"><?php echo $l->km_total; ?></th>
    </tr>
    <?php endforeach;?>
        </tbody>
  </table>
</div>
</div>
