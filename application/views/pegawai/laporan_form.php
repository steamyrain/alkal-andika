<div class="container-fluid">

	    <?php echo form_open('pegawai/laporan/input_aksi'); ?> 
        <form>
        <input type="hidden" name="userId" value=<?php $this->session->userdata['user_id']; ?> >
		<div class="form-group">
            <label> Nama :</label>
            <label> <?php echo $this->session->userdata['username'] ?></label>
		</div>
		<div class="form-group">
			<label>Lokasi Kerja :</label>
			<input type="text" name="project_location"
			placeholder="Masukkan Lokasi Kerja" class="form-control">
			<?php echo form_error('project_location', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Nomer Polisi :</label>
			<input type="text" name="plate_number"
			placeholder="Masukkan Nomer Polisi Kendaraan" class="form-control">
			<?php echo form_error('plate_number', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Nomer Seri :</label>
			<input type="text" name="serial_number"
			placeholder="Masukkan Nomer Seri Kendaraan" class="form-control">
			<?php echo form_error('serial_number', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>km awal :</label>
            <input 
                type="text" 
                name="km_onStart"
                placeholder="Masukkan KM Awal"
                class="form-control"
            >
			<?php echo form_error('km_onStart', '<div class="text-danger small" ml-3>') ?>
        </div>
        <div class="form-group">
            <label>km akhir :</label>
            <input 
                type="text" 
                name="km_onFinish"
                placeholder="Masukkan KM Akhir" 
                class="form-control"
            >
			<?php echo form_error('km_onFinish', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Jarak :</label>
			<input type="text" name="km_total"
			placeholder="Masukkan Jarak" class="form-control">
			<?php echo form_error('km_total', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>BBM :</label>
			<input type="text" name="gasoline"
			placeholder="Masukkan BBM" class="form-control">
			<?php echo form_error('gasoline', '<div class="text-danger small" ml-3>') ?>
		</div>
        <button 
            type="submit" 
            name="submit"
            class="btn btn-primary mb-5 mt-3"
        >
            Simpan
        </button>
	 <?php echo "</form>"; ?>
</div>
