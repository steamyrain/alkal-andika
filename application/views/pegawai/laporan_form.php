<div class="container-fluid">

	    <?php echo form_open('pegawai/laporan/input_aksi'); ?> 
        <input type="hidden" name="userId" value=<?php $this->session->userdata['user_id']; ?> >
		<div class="form-group">
            <label> Nama :</label>
            <label> <?php echo $this->session->userdata['username'] ?></label>
		</div>

		<div class="form-group">
			<label>Jenis Kendaraan :</label>
            <input type="radio" id="lk__alat_berat" name="lk__jenis_alat" value="alat_berat" checked/>
            <label for="alat_berat">Alat Berat</label>
            <input type="radio" id="lk__dump_truck" name="lk__jenis_alat" value="dump_truck"/>
            <label for="dump_truck">Dump Truck</label>
			<?php echo form_error('lk__jenis_alat', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group" id="lk__vin_group" style="display: none;">
			<label>Tanda Pengenal Kendaraan :</label>
            <input type="radio" id="lk__vin_pn" name="lk__jenis_vin" value="plate_number" checked/>
            <label for="plate_number">Nomor Polisi</label>
            <input type="radio" id="lk__vin_sn" name="lk__jenis_vin" value="serial_number"/>
            <label for="dump_truck">Nomor Seri</label>
			<?php echo form_error('lk__jenis_vin', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group" name="lk__pn_group" style="display: none;">
			<label>Nomor Polisi :</label>
			<select name="plate_number" class="form-control">
                <option selected="selected">NULL</option>
            <?php foreach ($plate_number as $pn):?>
                <option><?php echo $pn; ?></option>
            <?php endforeach; ?>
            </select>
            <?php echo form_error('plate_number', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group" name="lk__sn_group" style="display: none;">
			<label>Nomor Seri :</label>
			<select name="serial_number" class="form-control">
                <option selected="selected">NULL</option>
            <?php foreach ($serial_number as $sn):?>
                <option><?php echo $sn; ?></option>
            <?php endforeach; ?>
            </select>
			<?php echo form_error('serial_number', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Lokasi Kerja :</label>
			<input type="text" name="project_location"
			placeholder="Masukkan Lokasi Kerja" class="form-control">
			<?php echo form_error('project_location', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>km/hm awal :</label>
            <input 
                type="text" 
                name="lk__km_onStart"
                placeholder="Masukkan KM Awal"
                class="form-control"
            >
			<?php echo form_error('lk__km_onStart', '<div class="text-danger small" ml-3>') ?>
        </div>
        <div class="form-group">
            <label>km/hm akhir :</label>
            <input 
                type="text" 
                name="lk__km_onFinish"
                placeholder="Masukkan KM Akhir" 
                class="form-control"
            >
			<?php echo form_error('lk__km_onFinish', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Jarak :</label>
			<input id="lk__jarak" type="text" name="km_total"
            placeholder="KM Awal - KM Akhir" class="form-control" readonly>
		</div>
		<div class="form-group" style="display: none;">
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
