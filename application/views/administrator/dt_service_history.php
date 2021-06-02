<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Riwayat Servis Dump Truck 
    </div>
    <?php echo $this->session->flashdata('pesan'); ?>
    <?php 
        echo anchor(
        'administrator/dtservicehistory/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
        ) 
    ?>
    <?php 
        echo anchor(
        'administrator/dtservicehistory/rekap',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-book fa-sm"></i> 
            Rekap Data
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
                    <th style="text-align: center;">dt_service_history_id</th>
                    <th style="text-align: center;">dt_id</th>
                    <th style="text-align: center;">service_id</th>
                    <th style="text-align: center;">subservice_id</th>
                    <th style="text-align: center;">Identitas Kendaraan</th>
                    <th style="text-align: center;">Tanggal Servis</th>
                    <th style="text-align: center;">Kategori Servis</th>
                    <th style="text-align: center;">Unit Servis</th>
                    <th style="text-align: center;">Harga unit</th>
                    <th style="text-align: center;">Jumlah Unit</th>
                    <th style="text-align: center;">Keterangan Servis</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    <div 
        class="modal fade" 
        id="editModal" 
        tabindex="-1" 
        role="dialog"
        aria-labelledby="editModalLabel"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <div class="modal-header">
                    <h5 
                        class="modal-title" 
                        id="editModalLabel"
                    >
                        Edit Data Servis DT 
                    </h5>
                    <button 
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-form">
                        <input type="text" id="dt_id" style="display: none;" disabled required/>
                        <label for="service_id">Kategori Servis</label>
                        <select id="service_id" class="form-control">
                        </select>
                        <label for="subservice_id">Unit Servis</label>
                        <select id="subservice_id" class="form-control">
                        </select>
                        <label>Harga Unit</label>
                        <input type="number" id="unit_price" class="form-control">
                        <label>Jumlah Unit</label>
                        <input type="number" id="unit_price" class="form-control">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    let table;
    let serviceList = [];

    function getDTServiceHistories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/api')."?dt_id=$dt_id"."&service_id=$service_id" ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    function populateServiceList(dt_id,service_id){
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/servicelistapi') ?>'+'?dt_id='+dt_id,
            dataType: 'json',
            success: function (r){
                serviceList = r;
                initModalService(service_id)
            }
        });
    }

    function initModalService(service_id){
        let buffer = serviceList[0]['id'];
        let first = true
        serviceList.forEach(function (service){
            if(service.id !== buffer || first) {
                if(service.id === service_id){
                    $('#editModal #service_id')
                    .append(
                        "<option value="+service.id+" selected>"+
                            service.service_name+
                        "</option>"
                    );
                } else {
                    $('#editModal #service_id')
                    .append(
                        "<option value="+service.id+">"+
                            service.service_name+
                        "</option>"
                    );
                }
                first = false
                buffer = service.id
            }
        })
    }

    $(document).ready(function () {
        getDTServiceHistories();
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
            columns: [
                    {"data":"dt_service_history_id","visible":false},
                    {"data":"dt_id","visible":false},
                    {"data":"service_id","visible":false},
                    {"data":"subservice_id","visible":false},
                    {"data":"plate_number"},
                    {"data":"service_date"},
                    {"data":"service_name"},
                    {"data":"subservice_name"},
                    {"data":"unit_price"},
                    {"data":"unit_total"},
                    {"data":"service_desc"},
                    {"data":""}
            ],
            columnDefs: [
                {
                    targets: -1,
                    render: function(data,type,row,meta){
                        return '<div style="display: grid;grid-template-columns: 1fr 1fr;grid-gap: 5px"><button class="btn btn-sm btn-danger btn-delete" id="del-'+meta.row+'"><i class="fa fa-trash"></i></button><button class="btn btn-sm btn-warning btn-edit" id="edt-'+meta.row+'"><i class="fa fa-edit"></i></button></div>'
                    }
                }
            ]
        });

        $("#data-tabel>tbody").on('click','.btn-delete',function(){
            let id = $(this).attr("id").match(/\d+/)[0];
            let sh_id = table.row(id).data()['dt_service_history_id'];
            let base_url = "<?php echo base_url('administrator/dtservicehistory/api'); ?>"
            if(confirm('Yakin Hapus?')){
                $.ajax({
                    type: 'DELETE',
                    url: base_url+'?sh_id='+sh_id,
                    success: function (){
                        location.reload()
                    }
                });
            }
        })

        $("#data-tabel>tbody").on('click','.btn-edit',function(){
            let id = $(this).attr("id").match(/\d+/)[0];
            let sh_id = table.row(id).data()['dt_service_history_id'];
            let service_id = table.row(id).data()['service_id'];
            let dt_id = table.row(id).data()['dt_id'];
            let base_url = "<?php echo base_url('administrator/dtservicehistory/api'); ?>"
            populateServiceList(dt_id,service_id);
            $('#editModal').modal('show');
        })
    });
</script>
