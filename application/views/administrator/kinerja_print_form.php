<div class="container-fluid">

	<div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> FORM PRINT KINERJA DINAS
  	</div>
        <form>

        <!-- select nama operator -->
		<div class="form-group">
			<label> Nama Yang Akan Diprint :</label>
			<select name="username" class="form-control">
                <?php foreach($operator as $o): ?>
                    <option value="<?php echo $o->username; ?>">
                        <?php echo $o->username; ?>
                    </option>
                <?php endforeach; ?>
  			</select>
		</div>

        <!-- range tanggal (start-end) -->
		<div class="form-group">
			<label>Tanggal Awal Kinerja :</label>
            <input 
                type="date" 
                name="starting_date" 
                class="form-control"
            />
			<?php echo form_error('starting_date', '<div class="text-danger small">') ?>
        </div>
		<div class="form-group">
			<label>Tanggal Akhir Kinerja :</label>
            <input 
                type="date" 
                name="end_date" 
                class="form-control"
            />
			<?php echo form_error('end_date', '<div class="text-danger small">') ?>
		</div>
	
        <!-- form submit -->
		<button type="submit" class="btn btn-primary mb-5 mt-3"><span><i class="fas fa-print"></i>  Print</span></button>
    </form>
</div>
