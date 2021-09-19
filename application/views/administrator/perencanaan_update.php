
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pelaksanaan BBM</h1>
           
        </div>


           <div class="card" style="width: 60%;">
        	<div class="card-body">
                <?php foreach ($perencanaan as $p) : ?>
        		<form method="POST" action="<?php echo base_url('administrator/perencanaan/update_data_aksi') ?>" enctype="multipart/form-data">
        		
                <div class="form-group">
                    <label>Lokasi Baru</label>
                        <input type="hidden" name="id_pr" class="form-control" value="<?php echo $p->id_pr ?>">
                        <input type="hidden" name="tanggal" class="form-control" value="<?php echo $p->tanggal ?>">
                        <input type="hidden" name="lokasi" class="form-control" value="<?php echo $p->lokasi ?>">
                        <input type="hidden" name="kendaraan" class="form-control" value="<?php echo $p->kendaraan ?>">
                        <input type="hidden" name="serial" class="form-control" value="<?php echo $p->serial ?>">
                        <input type="hidden" name="operator" class="form-control" value="<?php echo $p->operator ?>">
                        <input type="hidden" name="pr_bbm" class="form-control" value="<?php echo $p->pr_bbm ?>">
                        <input type="text" name="lokasi_baru" class="form-control" value="">
                         <input type="text" name="status" class="form-control" value="">
                </div>

                 <div class="form-group">
                    <label>Pengguna Baru</label>
                        <select type="text" name="operator_baru">
                        <option value=""></option>
                        <?php foreach ($operator as $o) : ?>
                        <option value="<?php echo $o->username ?>"><?php echo $o->username ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pelaksanaan BBM</label>
                        <input type="text" name="pk_bbm" class="form-control" value="<?php echo $p->pk_bbm ?>">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" value="<?php echo $p->keterangan ?>">
                </div>




        	

        		<button type="submit" class="btn btn-success">Simpan</button>

				</form>
            <?php endforeach; ?>
        	</div>

        
      
       
    </div>


 
       