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
        echo(
        '<button class="btn btn-sm btn-primary mb-3" id="addABSublistBtn">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Part
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
                    <th style="text-align: center;">ab_id</th>
                    <th style="text-align: center;">plate_number</th>
                    <th style="text-align: center;">serial_number</th>
                    <th style="text-align: center;">Identitas Kendaraan</th>
                    <th style="text-align: center;">Kategori Kendaraan</th>
                    <th style="text-align: center;">Subkategori Kendaraan</th>
                    <th style="text-align: center;">Kategori Servis</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div 
    class="modal fade" 
    id="abSublistModal" 
    tabindex="-1" 
    role="dialog"
    aria-labelledby="abSublistModalLabel"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 
                    class="modal-title" 
                    id="abSublistModalLabel"
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
                <form id="addABSublist">
                    <div class="form-group">
                        <label for="service_id" class="col-form-label">Kategori Servis</label>
                        <select id="service_id" name="service_id" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subservice_name" class="col-form-label" aria-required="true" aria-invalid=false>Nama Part</label>
                        <input type="text" name="subservice_name" id="subservice_name" class="form-control" required>
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
                <input 
                    type="submit" 
                    class="btn btn-primary"
                    id="submitButton"
                    value="Tambah Part"
                >
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

    function getABServiceHistories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/alatberat/api') ?>',
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
            url: '<?php echo base_url('administrator/abservicehistory/servicelistapi') ?>',
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
                url: '<?php echo base_url('administrator/abservicehistory/sublistapi') ?>',
                cache: false,
                data: $("form#addABSublist").serialize(),
                success: function(r){
                    $("#abSublistModal").modal('hide');
                    location.reload();
                },
                error: function(r){
                    $("#abSublistModal").modal('hide');
                }
        });
    }

    $(document).ready(function () {
        // add dt sublist modal
        let addABSublistBtn = $("#addABSublistBtn")
        addABSublistBtn.on('click',()=>{
          getServiceCategories()
          $("#abSublistModal").modal("show")
        })

        // submitButton handler
        let submitButton = $("#submitButton")
        submitButton.on('click',()=>{
          $("form#addABSublist").submit()
        })
        // form addDTSublist submit event handler
        $("#addABSublist").on('submit',function(e){
            e.preventDefault();
            submitForm();
        });

        getABServiceHistories();
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
            columns: [
                    {"data":"id","visible":false,"searchable":false},
                    {"data":"plate_number","visible":false,"searchable":false},
                    {"data":"serial_number","visible":false,"searchable":false},
                    {
                        "data":"",
                        "render": function(data,type,row){
                            if(row.plate_number)return row.plate_number;
                            return row.serial_number
                        }
                    },
                    {"data":"category"},
                    {"data":"sub_category"},
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
            location.assign("<?php echo base_url('administrator/abservicehistory/selectcategory') ?>"+"?ab_id="+data["id"]);
        });
    });
</script>
