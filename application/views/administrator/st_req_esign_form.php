<div class="container-fluid">
    <h5 style="text-align: center;">FORM REQUEST ESIGN</h5>
    <br>
    <?php echo 
        form_open(
            base_URL('administrator/surattugas/request_esign')); 
    ?>
        <!-- Nomer ID Surat -->
		<div style="display: none;">
            <input type="text" name="id" size="5" value="<?php echo $stId; ?>" readonly/> 
		</div>

        <div class="form-group">
            <label>Tanggal :</label>
            <input 
                type="date" 
                name="date"
                id="form-surat-tugas__date"
                class="form-control"
                value="<?php echo $st->date; ?>"
                disabled
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
                value="<?php echo $st->location; ?>"
                disabled
            />
			<?php echo form_error('location', '<div class="text-danger small">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Deskripsi Pekerjaan :</label>
            <textarea 
                name="job_desc"
                id="form-surat-tugas__job"
                class="form-control"
                disabled
            ><?php echo $st->job_desc; ?></textarea>   
			<?php echo form_error('job', '<div class="text-danger small">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Pemohon :</label>
            <input
                type="text"
                name="requestBy"
                id="form-surat-tugas__requestBy"
                class="form-control"
                value = "<?php echo $this->session->userdata['username'] ?>"
                disabled
            />
			<?php echo form_error('requestBy', '<div class="text-danger small">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Penandatangan :</label>
            <select
                name="reqTo"
                id="form-surat-tugas__signer"
                class="form-control"
                placeholder="Pilih nama penandatangan"
            >
                <?php foreach ($stSigner as $signer) :?>
                <option 
                    value=<?php echo $signer->nip ?>
                >
                    <?php echo $signer->legalName ?>
                </option>
                <?php endforeach ?>
            </select>
			<?php echo form_error('reqTo', '<div class="text-danger small">','</div>') ?>
        </div>

        <!-- Submit -->
        <button 
            type="submit" 
            name="submit" 
            id="submit"
            class="btn btn-primary mb-5 mt-3"
        >
            Kirim Request
        </button>
    <?php echo "</form>"; ?>
</div>
