<div class="container-fluid">
	    <?php echo form_open('administrator/laporandt/edit_aksi'); ?> 
        <div class="form-group" style="display: none;">
            <input name="id" value="<?php $record->id; ?>" readonly/>
        </div>
		<div class="form-group">
            <label> Nama :</label>
			<select name="uId" class="form-control">
            <?php $no=0; foreach ($username as $uname):?>
                <option value="<?php echo $oId[$no]; ?>" <?php echo ($record->userId == $oId[$no])?'selected':''; ?>><?php echo $uname; ?></option>
                <?php $no++; ?>
            <?php endforeach; ?>
            </select>
			<?php echo form_error('uId', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Nomor Polisi :</label>
			<select name="plate_number" class="form-control">
                <option selected="selected">NULL</option>
                <?php foreach ($plate_number as $pn):?>
                    <option <?php echo ($record->plate_number == $pn)?'selected':''; ?>><?php echo $pn; ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('plate_number', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Lokasi Kerja :</label>
			<input type="text" name="project_location"
            value="<?php echo $record->project_location; ?>"
			placeholder="Masukkan Lokasi Kerja" class="form-control">
			<?php echo form_error('project_location', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Tanggal :</label>
			<input type="datetime-local" name="created_at"
            value="<?php echo $record->created_at; ?>"
			placeholder="Masukkan Tanggal dan Waktu Kerja" class="form-control">
			<?php echo form_error('created_at', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>km/hm awal :</label>
            <input 
                type="text" 
                name="lk__km_onStart"
                placeholder="Masukkan KM Awal"
                class="form-control"
                value="<?php echo $record->km_onStart; ?>"
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
                value="<?php echo $record->km_onFinish; ?>"
            >
			<?php echo form_error('lk__km_onFinish', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Jarak :</label>
			<input id="lk__jarak" type="text" name="km_total"
            value="<?php echo $record->km_total; ?>"
            placeholder="KM Awal - KM Akhir" class="form-control" readonly>
		</div>

		<div class="form-group" style="display: none;">
			<label>BBM :</label>
			<input type="text" name="gasoline"
            value="<?php echo $record->gasoline; ?>"
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
