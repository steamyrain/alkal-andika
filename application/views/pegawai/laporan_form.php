<div class="container-fluid">

	    <?php echo form_open('pegawai/laporan/input_aksi'); ?> 
        <h5 style="text-align: center;">LAPORAN KERJA ALAT BERAT</h5>
        <br>
        <input type="hidden" name="userId" value=<?php $this->session->userdata['user_id']; ?> >
		<div class="form-group">
            <label> Nama :</label>
            <label> <b><?php echo $this->session->userdata['username'] ?></b></label>
		</div>

		<div class="form-group" id="lk__vin_group"> 
			<label>Tanda Pengenal Kendaraan :</label>
            <input type="radio" id="lk__vin_pn" name="lk__jenis_vin" value="plate_number" />
            <label for="plate_number">Nomor Polisi</label>
            <input type="radio" id="lk__vin_sn" name="lk__jenis_vin" value="serial_number" checked/>
            <label for="dump_truck">Nomor Seri</label>
			<?php echo form_error('lk__jenis_vin', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

		<div class="form-group" name="lk__pn_group" style="display: none;">
			<label>Nomor Polisi :</label>
			<select name="plate_number" class="form-control">
                <option selected="selected">NULL</option>
                <?php $i=0; foreach ($plate_number as $pn):?>
                <option value="<?php echo $pn; ?>">
                        <?php 
                            echo $pn.' / '.$type_p[$i]; 
                            $i++;
                        ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('plate_number', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

		<div class="form-group" name="lk__sn_group" style="display: none;">
			<label>Nomor Seri :</label>
			<select name="serial_number" class="form-control">
                <option selected="selected">NULL</option>
                <?php $i=0; foreach ($serial_number as $sn):?>
                    <option value="<?php echo $sn; ?>">
                        <?php 
                            echo $sn.' / '.$type_s[$i]; 
                            $i++;
                        ?>
                    </option>
                <?php endforeach; ?>
            </select>
			<?php echo form_error('serial_number', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

		<div class="form-group">
			<label>Lokasi Kerja :</label>
			<input type="text" name="project_location"
			placeholder="Masukkan Lokasi Kerja" class="form-control">
			<?php echo form_error('project_location', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>

		<div class="form-group">
			<label>km/hm awal :</label>
            <input 
                type="text" 
                name="lk__km_onStart"
                placeholder="Masukkan KM/HM Awal"
                class="form-control"
            >
			<?php echo form_error('lk__km_onStart', '<div class="text-danger small" ml-3>','</div>') ?>
        </div>
        <div class="form-group">
            <label>km/hm akhir :</label>
            <input 
                type="text" 
                name="lk__km_onFinish"
                placeholder="Masukkan KM/HM Akhir" 
                class="form-control"
            >
			<?php echo form_error('lk__km_onFinish', '<div class="text-danger small" ml-3>','</div>') ?>
		</div>
		<div class="form-group">
			<label>Jarak :</label>
			<input id="lk__jarak" type="text" name="km_total"
            placeholder="KM/HM Awal - KM/HM Akhir" class="form-control" readonly>
		</div>
		<div class="form-group" style="display: none;">
			<label>BBM :</label>
			<input type="text" name="gasoline"
			placeholder="Masukkan BBM" class="form-control">
			<?php echo form_error('gasoline', '<div class="text-danger small" ml-3>','</div>') ?>
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
