<div class="container-fluid">
    <h5 style="text-align: center;">FORM EDIT SURAT TUGAS</h5>
    <br>
    <?php echo 
        form_open(
            base_URL('administrator/surattugas/edit_surat')); 
    ?>
        <!-- Nomer ID Surat -->
		<div style="display: none;">
			<label> ID DT :</label>
            <input type="text" name="id" size="5" value="<?php echo $st_id; ?>" readonly/> 
		</div>

        <div class="form-group">
            <label>Tanggal :</label>
            <input 
                type="date" 
                name="date"
                id="form-surat-tugas__date"
                class="form-control"
                value="<?php echo $st_surat_og->date; ?>"
            />
			<?php echo form_error('date', '<div class="text-danger small">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Lokasi :</label>
            <input 
                type="text" 
                name="location"
                id="form-surat-tugas__location"
                class="form-control"
                placeholder="Masukkan Nama Lokasi"
                value="<?php echo $st_surat_og->location; ?>"
            />
			<?php echo form_error('location', '<div class="text-danger small">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Deskripsi Pekerjaan :</label>
            <textarea 
                name="job_desc"
                id="form-surat-tugas__job"
                class="form-control"
            ><?php echo $st_surat_og->job_desc; ?></textarea>   
			<?php echo form_error('job', '<div class="text-danger small">','</div>') ?>
        </div>

        <!-- Submit -->
        <button 
            type="submit" 
            name="submit" 
            id="submit"
            class="btn btn-primary mb-5 mt-3"
        >
            Simpan
        </button>
    <?php echo "</form>"; ?>
</div>
