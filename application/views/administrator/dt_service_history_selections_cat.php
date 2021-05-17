<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Riwayat Servis Dump Truck 
    </div>
    <?php 
        echo anchor(
        'administrator/dtservicehistory/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
        ) 
    ?>
    <div style="overflow-x: auto;">
        <table 
            id="data-tabel" 
            class="table table-bordered table-striped" 
            style="width:100%"
        >
            <thead>
                <tr>
                    <th style="text-align: center;">dt_id</th>
                    <th style="text-align: center;">service_id</th> 
                    <th style="text-align: center;">Kategori Servis</th>
                    <th style="text-align: center;">Unit Servis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($service as $s) { ?>
                    <tr>
                        <td><?php echo $s->dt_id?></td>
                        <td><?php echo $s->service_id?></td>
                        <td><?php echo $s->service_name ?></td>
                        <td><button class="btn btn-primary btn-sm">Detail</button></td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
</div>
<script>

    let table;

    $(document).ready(function () {
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
            columns: [
                    {"data":"dt_id","visible":false},
                    {"data":"service_id","visible":false},
                    {"data":"service_name"},
                    {"data":"","orderable":false,"searchable":false}
            ]
        });
        $("#data-tabel tbody").on('click','button',function(){
            const data = table.row($(this).parents('tr')).data();
            location.assign("<?php echo base_url('administrator/dtservicehistory/serviceunit') ?>"+"?dt_id="+data["dt_id"]+"&service_id="+data["service_id"]);
        });
    });
</script>