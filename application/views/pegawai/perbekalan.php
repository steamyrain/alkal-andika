<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
  <i class="fas fa-clipboard"></i> Kinerja Petugas Pemeliharaan Jalan dan Jembatan
  </div>

  <?php 
    echo anchor(
        'pegawai/perbekalan/input',
        '<button class="btn btn-sm btn-warning mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>

  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
      <tr>
      <th>Tanggal</th>
      <th>No</th>
      <th>Waktu</th>
      <th>Nama</th>
      <th>Bidang</th>
      <th>Kegiatan</th>
      <th>Lokasi</th>
      <th>Dokumentasi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($pmj as $k) : ?>
      <tr>
        <td><?php echo $k->tanggal ?></td>
        <td width="20px"><?php echo $no++ ?></td>
        <td><?php echo $k->waktu ?></td>
        <td><?php echo $k->nama ?></td>
        <td><?php echo $k->bidang ?></td>
        <td><?php echo $k->kegiatan ?></td>
        <td><?php echo $k->lokasi ?></td>
            <td>
            <a href="<?php echo base_url('assets/upload/').$k->dokumentasi ?>">dokumentasi</a>
            </td>
      </tr>
    <?php endforeach; ?>
  </table>
  </tbody>
</div>