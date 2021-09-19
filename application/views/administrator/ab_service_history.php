<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Riwayat Servis Alat Berat 
    </div>
    <?php echo $this->session->flashdata('pesan'); ?>
    <?php 
        echo anchor(
        'administrator/abservicehistory/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
        ) 
    ?>
    <?php 
        echo anchor(
        'administrator/abservicehistory/rekap',
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
                    <th style="text-align: center;">ab_service_history_id</th>
                    <th style="text-align: center;">ab_id</th>
                    <th style="text-align: center;">service_id</th>
                    <th style="text-align: center;">subservice_id</th>
                    <th style="text-align: center;">plate_number</th>
                    <th style="text-align: center;">serial_number</th>
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
                        Edit Data Servis Alat Berat 
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
                        <input type="number" id="sh_id" style="display: none;" disabled required/>
                        <input type="number" id="ab_id" style="display: none;" disabled required/>
                        <label for="service_date">Tanggal Servis</label>
                        <input type="date" id="service_date" class="form-control" required>
                        <label for="service_id">Kategori Servis</label>
                        <select id="service_id" class="form-control" required>
                        </select>
                        <label for="subservice_id">Unit Servis</label>
                        <select id="subservice_id" class="form-control" required>
                        </select>
                        <label>Harga Per-Unit</label>
                        <div style="
                                display: flex;
                                justify-content: center;
                                align-items:center;"
                        > 
                            <label>Rp</label>
                            <input type="number" id="unit_price" class="form-control" step=0.001 required>
                        </div>
                        <label>Jumlah Unit</label>
                        <div style="
                                display: flex;
                                justify-content: center;
                                align-items:center;"
                        > 
                            <label id="unit_unit"></label>
                            <input type="number" id="unit_total" class="form-control" step=0.001 required>
                        </div>
                        <label>Keterangan Servis</label>
                        <textarea class="form-control" id="service_desc"></textarea> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button 
                        type="submit" 
                        class="btn btn-primary"
                        id="changeButton"
                    >
                        Ubah
                    </button>
                    <button 
                        type="button" 
                        class="btn btn-secondary" 
                        data-dismiss="modal"
                    >
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    let table;
    let serviceList = [];

    function getABServiceHistories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/abservicehistory/api')."?ab_id=$ab_id"."&service_id=$service_id" ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    function populateServiceList(ab_id,service_id,subservice_id){
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/abservicehistory/servicelistapi') ?>'+'?ab_id='+ab_id,
            dataType: 'json',
            success: function (r){
                serviceList = r;
                clearServiceList();
                clearSubServiceList();
                initModalService(service_id,subservice_id)
            }
        });
    }

    // clear service list visually
    function clearServiceList(){
        $('#service_id').empty();
    }

    // clear subservice list visually
    function clearSubServiceList(){
        $('#subservice_id').empty();
    }
    
    // clear subservice unit unit visually
    function clearUnitUnit(){
        $('#unit_unit').empty();
    }

    function initModalService(service_id,subservice_id){
        let buffer = serviceList[0]['service_id'];
        let first = true
        serviceList.forEach(function (service){
            if(service.service_id !== buffer || first) {
                if(service.service_id === service_id){
                    $('#editModal #service_id')
                    .append(
                        "<option value="+service.service_id+" selected>"+
                            service.service_name+
                        "</option>"
                    );
                } else {
                    $('#editModal #service_id')
                    .append(
                        "<option value="+service.service_id+">"+
                            service.service_name+
                        "</option>"
                    );
                }
                first = false
                buffer = service.service_id
            } 
        })
        populateSubServiceList(service_id,subservice_id)
    }

    function populateSubServiceList(service_id,subservice_id){
        let first = true;
        serviceList.forEach(function(service) {
            if(service_id === service.service_id){
                if(first){
                    if(subservice_id === service.subservice_id){
                        $('#editModal #subservice_id')
                        .append(
                            "<option value="+service.subservice_id+" selected>"+
                                service.subservice_name+
                            "</option>"
                        );
                        $('#editModal #subservice_id').val(service.subservice_id).change();
                    } else {
                        if(subservice_id === -1){
                            $('#editModal #subservice_id')
                            .append(
                                "<option value="+service.subservice_id+" selected>"+
                                    service.subservice_name+
                                "</option>"
                            );
                            $('#editModal #subservice_id').val(service.subservice_id).change();
                        } else {
                            $('#editModal #subservice_id')
                            .append(
                                "<option value="+service.subservice_id+">"+
                                    service.subservice_name+
                                "</option>"
                            );
                        }
                    }
                    first = false;
                } else {
                    if(subservice_id === service.subservice_id){
                        $('#editModal #subservice_id')
                        .append(
                            "<option value="+service.subservice_id+" selected>"+
                                service.subservice_name+
                            "</option>"
                        );
                        $('#editModal #subservice_id').val(service.subservice_id).change();
                    } else {
                        $('#editModal #subservice_id')
                        .append(
                            "<option value="+service.subservice_id+">"+
                                service.subservice_name+
                            "</option>"
                        );
                    }
                }
            }
        })
    }

    $(document).ready(function () {
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
            columns: [
                    {"data":"ab_service_history_id","visible":false,"searchable":false},
                    {"data":"ab_id","visible":false,"searchable":false},
                    {"data":"service_id","visible":false,"searchable":false},
                    {"data":"subservice_id","visible":false,"searchable":false},
                    {"data":"plate_number","visible":false,"searchable":false},
                    {"data":"serial_number","visible":false,"searchable":false},
                    {
                        "data":"",
                        "render":function(data,type,row,meta){
                            if(row.plate_number){
                                return row.plate_number;
                            } else {
                                return row.serial_number;
                            }
                        }
                    },
                    {"data":"service_date"},
                    {"data":"service_name"},
                    {"data":"subservice_name"},
                    {"data":"unit_price"},
                    {"data":"unit_total"},
                    {"data":"service_desc"},
                    {
                        "data":"",
                        "render":function(data,type,row,meta){    
                            return '<div style="display: grid;grid-template-columns: 1fr 1fr;grid-gap: 5px"><button class="btn btn-sm btn-danger btn-delete" id="del-'+meta.row+'"><i class="fa fa-trash"></i></button><button class="btn btn-sm btn-warning btn-edit" id="edt-'+meta.row+'"><i class="fa fa-edit"></i></button></div>'
                        }
                    }
            ]
        });

        getABServiceHistories();

        $("#data-tabel>tbody").on('click','.btn-delete',function(){
            let id = $(this).attr("id").match(/\d+/)[0];
            let sh_id = table.row(id).data()['ab_service_history_id'];
            let base_url = "<?php echo base_url('administrator/abservicehistory/api'); ?>"
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
            let sh_id = table.row(id).data()['ab_service_history_id'];
            let service_id = table.row(id).data()['service_id'];
            let subservice_id = table.row(id).data()['subservice_id'];
            let service_date = table.row(id).data()['service_date'];
            let service_desc = table.row(id).data()['service_desc'];
            let unit_unit = table.row(id).data()['unit_unit'];
            let unit_price = table.row(id).data()['unit_price'];
            let unit_total = table.row(id).data()['unit_total'];
            let ab_id = table.row(id).data()['ab_id'];
            let base_url = "<?php echo base_url('administrator/abservicehistory/api'); ?>"
            populateServiceList(ab_id,service_id,subservice_id);

            /* set init value */
            $("#sh_id").val(sh_id);
            $("#ab_id").val(ab_id);
            $("#service_date").val(service_date);
            $("#service_desc").val(service_desc);
            $('#unit_total').val(unit_total);
            $('#unit_price').val(unit_price);

            $('#editModal').modal('show');
        })

        $("#service_id").on('change',function(){
            let service_id = $(this).val();
            clearSubServiceList();
            populateSubServiceList(service_id,-1);
        })

        $("#subservice_id").on("change",function(){
            let subservice_id = $(this).val();
            const unit_unit = serviceList.filter(service => {
                if(service.subservice_id === subservice_id){
                    return service;
                }
            });
            clearUnitUnit();
            $("#unit_unit").append(unit_unit[0].unit_unit+' ');
        })

        $("#changeButton").on("click",function(){
            $("#edit-form").submit();
        })

        $("#edit-form").on('submit',function(e){
            e.preventDefault();
            const ab_id = $("#ab_id").val();
            const sh_id = $("#sh_id").val();
            const service_date = $("#service_date").val();
            const service_desc = $("#service_desc").val();
            const service_id = $("#service_id").val();
            const subservice_id = $("#subservice_id").val();
            const unit_total = $("#unit_total").val();
            const unit_price = $("#unit_price").val();
            const data = {
                "ab_id":ab_id,
                "id":sh_id,
                "service_id":service_id,
                "service_date":service_date,
                "service_desc":service_desc,
                "subservice_id":subservice_id,
                "unit_total":unit_total,
                "unit_price":unit_price
            };
            const base_url = "<?php echo base_url('administrator/abservicehistory/api') ?>";
            $.ajax({
                type:'PUT',
                url: base_url,
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function (){
                    location.reload()
                }
            })
        })
    });
</script>
