<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
  <i class="fas fa-clipboard"></i> Kinerja Pengemudi Alat Berat
  </div>

  <?php 
    echo anchor(
        'administrator/kinerja/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>
    <?php
    echo anchor(
        'administrator/kinerja/print',
        '<button class="btn btn-sm btn-info mb-3">
            <i class="fa fa-print"></i> 
            Print
        </button>'
    ) 
    ?>
    <?php
    echo anchor(
        'administrator/kinerja/excel',
        '<button class="btn btn-sm btn-success mb-3">
            <i class="far fa-file-excel"></i>
            Jadikan Excel
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
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  	<?php $no=1; foreach($kinerja as $k) : ?>
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
        <td onclick="javascript: return confirm('Yakin Hapus?')"><?php echo anchor('administrator/kinerja/hapus/'.$k->no, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?></td>
  		</tr>
  	<?php endforeach; ?>
  </table>
  </tbody>
</div>
