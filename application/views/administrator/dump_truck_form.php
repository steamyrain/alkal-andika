<div class="container-fluid">
    <?php echo $this->session->flashdata('pesan') ?>
    <?php echo 
        form_open(
            base_URL('administrator/dumptruck/input_aksi')); 
    ?>

        <!-- Nomer Polisi -->
		<div class="form-group">
			<label> Nomor Polisi :</label>
			<input type="text" name="plate_number" class="form-control" placeholder= "Masukkan Nomor Polisi Kendaraan Dump Truck">
			<?php echo form_error('plate_number', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Tipe -->
		<div class="form-group">
			<label>Tipe/Jenis DT :</label>
			<input type="text" name="type"
			placeholder="Masukkan Jenis/Tipe DT" class="form-control">
			<?php echo form_error('type', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Kapasitas -->
		<div class="form-group">
			<label>Kapasitas DT :</label>
            <span>
                <input 
                    type="text" 
                    name="capacity"
                    placeholder="Kapasitas"
                    maxlength="3"
                    size="10"
                />
                <label>Meter Kubik</label>
            </span>
			<?php echo form_error('capacity', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Merek -->
		<div class="form-group">
            <p>Pilih Merek :</p>
            <?php foreach ($brand as $b) :?>
                <input 
                    type="radio" 
                    id="<?php $b->brand; ?>" 
                    name="brand" 
                    value="<?php echo $b->id; ?>"
                >
                <label for="<?php $b->brand; ?>"><?php echo $b->brand; ?></label>
                <br>
            <?php endforeach; ?>
			<?php echo form_error('brand', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Tahun -->
		<div class="form-group">
            <span>
                <label>Tahun DT :</label>
                <input 
                    type="text" 
                    name="year"
                    placeholder="Tahun"
                    maxlength="4"
                    size="10"
                />
            </span>
			<?php echo form_error('year', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Nomer Rangka -->
		<div class="form-group">
			<label>Nomer Rangka DT :</label>
			<input type="text" name="chassis_number"
			placeholder="Masukkan Nomer Rangka DT" class="form-control">
			<?php echo form_error('chassis_number', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Nomer Mesin -->
		<div class="form-group">
			<label>Nomer Mesin DT :</label>
			<input type="text" name="engine_number"
			placeholder="Masukkan Nomer Mesin DT" class="form-control">
			<?php echo form_error('engine_number', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Aktif -->
		<div class="form-group">
            <p>Status Aktif DT :</p>
            <input 
                type="radio" 
                id="aktif" 
                name="active" 
                value="1"
                checked
            >
            <label for="aktif">Aktif</label>
            <input 
                type="radio" 
                id="nonaktif" 
                name="active" 
                value="0"
            >
            <label for="nonaktif">Non-Aktif</label>
			<?php echo form_error('active', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Input -->
        <button type="submit" 
            name="submit" 
            value="upload" 
            class="btn btn-primary mb-5 mt-3"
        >Simpan</button>
	 <?php echo "</form>"; ?>
</div>
