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
        echo(
        '<button class="btn btn-sm btn-primary mb-3" id="addDTSublistBtn">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Part
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
                    <th style="text-align: center;">dt_id</th>
                    <th style="text-align: center;">Identitas Kendaraan</th>
                    <th style="text-align: center;">Kategori Kendaraan</th>
                    <th style="text-align: center;">Kategori Servis</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div 
    class="modal fade" 
    id="dtSublistModal" 
    tabindex="-1" 
    role="dialog"
    aria-labelledby="dtSublistModalLabel"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 
                    class="modal-title" 
                    id="dtSublistModalLabel"
                >
                    Tambah Part
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
                <form id="addDTSublist">
                    <div class="form-group">
                        <label for="service_id" class="col-form-label">Kategori Servis</label>
                        <select id="service_id" name="service_id" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subservice_name" class="col-form-label" aria-required="true" aria-invalid=false>Nama Part</label>
                        <input type="text" name="subservice_name" id="subservice_name" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="col-form-label" aria-required="true" aria-invalid=false>Unit Part</label>
                        <select id="unit" name="unit" class="form-control">
                          <option>botol</option>
                          <option>liter</option>
                          <option>kilogram</option>
                          <option>pcs</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button 
                    type="submit" 
                    class="btn btn-primary"
                    id="submitButton"
                >
                    Tambah Part
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
<script>

    let table;

    function getDTServiceHistories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dumptruck/api') ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    function getServiceCategories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/servicelistapi') ?>',
            dataType: 'json',
            success: function (r){
              const select = $("#service_id")
              select.empty()
              let first = true
              r.forEach((service)=>{
                  if(first){
                      select.append("<option value="+service.id+" selected>"+service.service_name+"</option>")
                      first = false;
                  } else {
                      select.append("<option value="+service.id+">"+service.service_name+"</option>")
                  }
              })
            }
        });
    }

    function submitForm(){
        return $.ajax({
                type: 'POST',
                url: '<?php echo base_url('administrator/dtservicehistory/sublistapi') ?>',
                cache: false,
                data: $("form#addDTSublist").serialize(),
                success: function(r){
                    $("#dtSublistModal").modal('hide');
                },
                error: function(r){
                    $("#dtSublistModal").modal('hide');
                }
        });
    }

    $(document).ready(function () {
        // add dt sublist modal
        let addDTSublistBtn = $("#addDTSublistBtn")
        addDTSublistBtn.on('click',()=>{
          getServiceCategories()
          $("#dtSublistModal").modal("show")
        })

        // submitButton handler
        let submitButton = $("#submitButton")
        submitButton.on('click',()=>{
        $("form#addDTSublist").submit()
})
        // form addDTSublist submit event handler
        $("#addDTSublist").on('submit',function(e){
            e.preventDefault();
            submitForm();
        });


        getDTServiceHistories();
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
            columns: [
                    {"data":"id","visible":false},
                    {"data":"plate_number"},
                    {"data":"category"},
                    {
                        "data":"",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data,type,row){
                            return "<button class='btn btn-primary btn-sm'>Kategori</button>"
                        }
                    }
            ]
        });
        $("#data-tabel tbody").on('click','button',function(){
            const data = table.row($(this).parents('tr')).data();
            location.assign("<?php echo base_url('administrator/dtservicehistory/selectcategory') ?>"+"?dt_id="+data["id"]);
        });
    });
</script>
