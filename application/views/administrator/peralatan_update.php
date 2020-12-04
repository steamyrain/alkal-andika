<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Update Kinerja
  	</div>

  	<?php foreach($pmj as $k) : ?>

  		<form method="post" action="<?php echo base_url('administrator/pmj/update_aksi') ?>">
  			

  			<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" class="form-control" value="<?php echo $k->nama?>">
			</div>

			<div class="form-group">
			<label>Bidang</label>
			<input type="text" name="bidang" class="form-control" value="<?php echo $k->bidang?>">
			</div>

			<div class="form-group">
			<label>Kegiatan</label>
			<input type="text" name="kegiatan" class="form-control" value="<?php echo $k->kegiatan?>">
			</div>

			<button type="submit" class="btn btn-primary">Simpan</button>
  		</form>

  	<?php endforeach; ?>
</div>