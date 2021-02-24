<div class="container-fluid">
    <h5 style="text-align: center;">FORM ALAT BERAT</h5>
    <br>
    <?php echo $this->session->flashdata('pesan') ?>
    <?php echo 
        form_open(
            base_URL('administrator/alatberat/edit_aksi')); 
    ?>
        <div class="form-group" style="display: none;">
            <input type="number" name="id" value="<?php echo $record->id; ?>" readonly/>
        </div>

		<div class="form-group" id="lk__vin_group">
			<label>Tanda Pengenal Kendaraan :</label>
            <input type="radio" id="lk__vin_pn" name="lk__jenis_vin" value="plate_number" <?php echo ($isPlateNumber)?'checked':''; ?>/>
            <label for="plate_number">Nomor Polisi</label>
            <input type="radio" id="lk__vin_sn" name="lk__jenis_vin" value="serial_number" <?php echo ($isPlateNumber)?'':'checked'; ?>/>
            <label for="dump_truck">Nomor Seri</label>
			<?php echo form_error('lk__jenis_vin', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

		<div class="form-group" name="lk__pn_group" style="display: none;">
			<label>Nomor Polisi :</label>
            <input 
                type="text" 
                name="plate_number" 
                class="form-control" 
                placeholder="Masukkan nomor polisi" 
                value="<?php echo ($isPlateNumber)?$record->plate_number:''; ?>"
            />
            <?php echo form_error('plate_number', '<div class="text-danger small" ml-3>','</div>'); ?>
		</div>

		<div class="form-group" name="lk__sn_group" style="display: none;">
			<label>Nomor Seri :</label>
            <input 
                type="text" 
                name="serial_number" 
                class="form-control" 
                placeholder="Masukkan nomor seri" 
                value="<?php echo ($isPlateNumber)?'':$record->serial_number; ?>"
            />
			<?php echo form_error('serial_number', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

        <!-- Category -->
		<div class="form-group">
			<label>Kategori Alat Berat:</label>
            <select name="catId">
                <?php foreach ($category as $c): ?>
                <option 
                    value=<?php echo $c->id ?>
                    <?php echo ($c->id == $record->catId)?'selected':''; ?>
                >
                    <?php echo $c->category ?></option>
                <?php endforeach; ?>
            </select>
			<?php echo form_error('catId', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

        <!-- Sub Kategori -->
		<div class="form-group">
			<label>Sub Kategori Alat Berat:</label>
                <input 
                    type="text" 
                    name="sub_category"
                    placeholder="Masukkan sub kategori alat berat"
                    value="<?php echo $record->sub_category; ?>"
                />
			<?php echo form_error('sub_category', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

        <!-- Tipe -->
		<div class="form-group">
			<label>Tipe Alat Berat:</label>
                <input 
                    type="text" 
                    name="type"
                    placeholder="Masukkan tipe alat berat"
                    value="<?php echo $record->type; ?>"
                />
			<?php echo form_error('type', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

        <!-- Merek -->
		<div class="form-group">
            <label> Pilih Merek :</label>
            <select name="brandId">
            <?php foreach ($brand as $b) :?>
                <option 
                    value="<?php echo $b->id; ?>"
                    <?php echo ($b->id == $record->brandId)?'selected':''; ?>
                >
                    <?php echo $b->brand; ?>
                </option>
            <?php endforeach; ?>
            </select>
			<?php echo form_error('brandId', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

        <!-- Aktif -->
		<div class="form-group">
            <p>Status Aktif Alat Berat :</p>
            <input 
                type="radio" 
                id="aktif" 
                name="active" 
                value="1"
                <?php echo ($record->active==1)?'checked':''; ?>
            >
            <label for="aktif">Aktif</label>
            <input 
                type="radio" 
                id="nonaktif" 
                name="active" 
                value="0"
                <?php echo ($record->active==0)?'checked':''; ?>
            >
            <label for="nonaktif">Non-Aktif</label>
			<?php echo form_error('active', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

        <!-- Input -->
        <button type="submit" 
            name="submit" 
            value="upload" 
            class="btn btn-primary mb-5 mt-3"
        >Ubah</button>
	 <?php echo "</form>"; ?>

</div>
