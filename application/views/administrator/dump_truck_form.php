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

        <!-- Nomer Pintu -->
		<div class="form-group">
			<label> Nomor Pintu :</label>
			<input type="text" name="door_number" class="form-control" placeholder= "Masukkan Nomor Pintu Kendaraan Dump Truck Jika Ada">
			<?php echo form_error('plate_number', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Category -->
		<div class="form-group">
			<label>Kategori/Kapasitas DT :</label>
            <select name="catId">
                <?php foreach ($jenis as $j): ?>
                <option value=<?php echo $j->id ?>><?php echo $j->category ?></option>
                <?php endforeach; ?>
            </select>
			<?php echo form_error('catId', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Tipe -->
		<div class="form-group">
			<label>Tipe DT :</label>
                <input 
                    type="text" 
                    name="type"
                    placeholder="Masukkan tipe DT"
                />
			<?php echo form_error('type', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Merek -->
		<div class="form-group">
            <label> Pilih Merek :</label>
            <select name="brandId">
            <?php foreach ($brand as $b) :?>
                <option 
                    value="<?php echo $b->id; ?>"
                >
                    <?php echo $b->brand; ?>
                </option>
            <?php endforeach; ?>
            </select>
			<?php echo form_error('brandId', '<div class="text-danger small" ml-3>') ?>
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

        <!-- Keterangan Tambahan -->
		<div class="form-group">
			<label>Keterangan tambahan :</label>
            <input 
                type="text" 
                name="condition_info"
                placeholder="Masukkan Keterangan Kondisi DT"
                class="form-control"
            />
			<?php echo form_error('condition_info', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Lokasi -->
		<div class="form-group">
			<label>Lokasi :</label>
            <input 
                type="text" 
                name="location"
                placeholder="Masukkan Lokasi DT"
                class="form-control"
            />
			<?php echo form_error('location', '<div class="text-danger small" ml-3>') ?>
		</div>

        <!-- Input -->
        <button type="submit" 
            name="submit" 
            value="upload" 
            class="btn btn-primary mb-5 mt-3"
        >Simpan</button>
	 <?php echo "</form>"; ?>
</div>
