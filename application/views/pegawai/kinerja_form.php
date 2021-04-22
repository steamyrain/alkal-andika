<div class="container-fluid">
	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>
    <?php 
        echo $this->session->flashdata('pesan');
    ?>
	<?php echo form_open_multipart('pegawai/kinerja/input_aksi'); ?>
		<div class="form-group">
			<label class="form-control"> Nama Lengkap: <span style="font-weight: bold"><?php echo $emp_name ?></span></label>
            <input type="text" name="emp_name" style="display: none" value="<?php echo $emp_name ?>"/> 
            <input type="number" name="uid" style="display: none" value="<?php echo $uid; ?>" />
		</div>
		<div class="form-group">
			<label class="form-control"> Bidang Kerja : <span style="font-weight: bold"><?php echo $role_name;?></span></label>
            <input type="text" name="job_rolename" style="display: none" value="<?php echo $role_name ?>"/> 
            <input type="number" name="job_roleid" style="display: none" value="<?php echo $role_id; ?>" />
		</div> 
        <div class="form-group">
			<label> Tanggal Kegiatan : </label>
            <input type='date' name="job_date" class="form-control"/>
			<?php echo form_error('job_date', '<div class="text-danger small" ml-3>') ?>
        </div>
        <div class="form-group">
			<label> Waktu Awal Kegiatan : </label>
            <input type='time' name="job_start" class="form-control"/>
			<?php echo form_error('job_start', '<div class="text-danger small" ml-3>') ?>
        </div>
        <div class="form-group">
            <label> Waktu Akhir Kegiatan : </label>
            <input type='time' name="job_end" class="form-control"/>
			<?php echo form_error('job_end', '<div class="text-danger small" ml-3>') ?>
        </div>
		<div class="form-group">
			<label> Kegiatan : </label>
            <select name="job" class="form-control">
                <?php foreach((array) $job_list as $jl): ?>
                <option value="<?php echo $jl->id.'|'.$jl->job; ?>"><?php echo $jl->job; ?></option>
                <?php endforeach; ?>
            </select>
			<?php echo form_error('job', '<div class="text-danger small" ml-3>') ?>
		</div>
        <div class="form-group">
            <label> Deskripsi Kegiatan : </label>
            <textarea maxlength="255" name="job_desc" class="form-control" placeholder="Deskripsi membantu penilaian kinerja. Contoh: volume: 10 surat / volume: 5 dumptruck ..."></textarea>
        </div>
        <div class="form-group">
            <label> Dokumentasi Kegiatan (opsional): </label>
            <input type='file' name="documentation" class="form-control"/>
        </div>
        <div class="form-group">
        <button 
            type="submit" 
            value="upload" 
            name="submit"
            class="btn btn-primary mb-5 mt-3"
            <?php echo ($anyErrors)?'disabled':''?>
        >
            Simpan
        </button> 
	<?php echo form_close(); ?>
</div>
