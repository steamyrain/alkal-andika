<div class="container-fluid">
    <?php echo $this->session->flashdata('pesan') ?>
    <?php echo 
        form_open(
            base_URL('administrator/dtservicehistory/input_aksi')); 
    ?>
        <div class="form-group">
            <label for="dt_id" class="col-form-label" aria-required="true" aria-invalid="false">Nomer Polisi</label>
            <select id="dt_id" name="dt_id" class="form-control">
            <?php foreach($dt as $d):?>
                <option value=<?php echo $d->id?>><?php echo $d->plate_number ?></option>
            <?php endforeach; ?>
            </select>
			<?php echo form_error('dt_id', '<div class="text-danger small" ml-3>','</div>') ?>
        </div>
        <div class="form-group">
            <label for="service_id" class="col-form-label" aria-required="true" aria-invalid=false>Jenis Servis</label>
            <select id="service_id" name="service_id" class="form-control" disabled>
            </select>
			<?php echo form_error('service_id', '<div class="text-danger small" ml-3>','</div>') ?>
        </div>
        <div class="form-group">
            <label for="service_date" class="col-form-label" aria-required="true" aria-invalid=false>Tanggal Servis</label>
            <input type="date" name="service_date" id="service_date" class="form-control"/>
			<?php echo form_error('service_date', '<div class="text-danger small" ml-3>','</div>') ?>
        </div>
        <div class="form-group">
            <label for="serviced_by" class="col-form-label">Servis Oleh</label>
            <input name="serviced_by" id="serviced_by" class="form-control"/>
        </div>
        <!-- Input -->
        <button type="submit" 
            name="submit" 
            value="upload" 
            class="btn btn-primary mb-5 mt-3"
        >Simpan</button>
    <?php
        echo "</form>"
    ?>
</div>
<script>
    let dt_id;

    function getDTId() {
        return $('#dt_id').change( function () {
            dt_id = $(this).val();    
            getServiceList(dt_id)
        });
    }

    function initDTId() {
        dt_id = $('#dt_id').val();
        getServiceList(dt_id)
    }

    function getServiceList(id){
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/servicelistapi') ?>'+'?dt_id='+id,
            dataType: 'json',
            success: function (r){
                $("#service_id").prop('disabled',false);
                $("#service_id").empty();
                const service = r;
                for(let i=0;i<service.length;i++){
                    $("#service_id").append("<option value="+service[i].id+">"+service[i].service_name+"</option>");
                }
            }
        });
    }

    $(document).ready(function () {
        initDTId();
        getDTId();
    });

</script>
