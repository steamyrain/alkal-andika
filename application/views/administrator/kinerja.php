<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Kinerja PJLP 
    </div>
    <?php echo $this->session->flashdata('pesan'); ?>
    <div style="overflow-x: auto;">
        <table 
            id="data-tabel" 
            class="table table-bordered table-striped" 
            style="width:100%"
        >
            <thead>
                <tr>
                    <th style="text-align: center;">uid</th>
                    <th style="text-align: center;">jobid</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Tanggal Input</th>
                    <th style="text-align: center;">Tanggal Kinerja</th>
                    <th style="text-align: center">Bidang</th>
                    <th style="text-align: center;">Waktu Awal</th>
                    <th style="text-align: center;">Waktu Akhir</th>
                    <th style="text-align: center;">Kegiatan</th>
                    <th style="text-align: center;">Deskripsi Kegiatan</th>
                    <th style="text-align: center;">Status Validasi</th>
                    <th style="text-align: center;">Status Validasi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div 
    class="modal fade" 
    id="kinerjaModal" 
    tabindex="-1" 
    role="dialog"
    aria-labelledby="kinerjaModalLabel"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 
                    class="modal-title" 
                    id="kinerjaModalLabel"
                >
                    Print Kinerja 
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
                <form>
                    <div class="form-group">
                        <label for="job_roleid" class="col-form-label">Bidang</label>
                        <select id="job_roleid" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="uid" class="col-form-label">PJLP</label>
                        <select id="uid" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="job_date" class="col-form-label">Tanggal Kinerja</label>
                        <input type="date" id="job_date" class="form-control"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button 
                    type="button" 
                    class="btn btn-secondary" 
                    data-dismiss="modal"
                >
                    Close
                </button>
                <button 
                    type="button" 
                    class="btn btn-primary"
                >
                    Print Kinerja
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/JavaScript">
    let table;
    let user;

    function getData() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/kinerja/api') ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    function getRoleId(){
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/jobrole/api') ?>',
            dataType: 'json',
            success: function (r){
                const select = $("#job_roleid");
                const uid = $("#uid");
                select.empty();
                uid.empty();
                for(let i=0;i<Object.keys(r).length;i++){
                    if(i==0){
                        select.append("<option value="+r[i].id+" selected>"+r[i].role_name+"</option>")
                        getUser();
                    } else {
                        select.append("<option value="+r[i].id+">"+r[i].role_name+"</option>")
                    }
                }
            }
        });
    }

    function getUser(){
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/user/api') ?>',
            dataType: 'json',
            success: function (r){
                const select = $("#job_roleid");
                const uid = $("#uid");
                user = r;
                for(let i=0;i<user.length;i++){
                    if(user[i].job_roleid === select.val()){
                        uid.append("<option value="+user[i].id+">"+user[i].username+"</option>")
                    }
                }
                select.change(function() {
                    uid.empty();
                    for(let i=0;i<user.length;i++){
                        if(user[i].job_roleid === select.val()){
                            uid.append("<option value="+user[i].id+">"+user[i].username+"</option>")
                        }
                    }
                });
            }
        });
    }

    $(document).ready(function() 
    {
        getData();

        // initialize data table & its necessary config
        table = $("#data-tabel").DataTable({
            dom: "Blfrtip",
            buttons: [
            {
                text: 'Print',
                action: function (e,dt,node,config) {
                    getRoleId();
                    //getUser();
                    $('#kinerjaModal').modal('show');
                }
            }
            ],
            columns: [
                    {"data":"uid","visible":false},
                    {"data":"jobid","visible":false},
                    {"data":"emp_name"},
                    {"data":"created_at"},
                    {"data":"job_date"},
                    {"data":"job_rolename"},
                    {"data":"job_start"},
                    {"data":"job_end"},
                    {"data":"job"},
                    {"data":"job_desc"},
                    {"data":"valid_status","visible":false},
                    {
                        "data":"",
                        "orderable":false,
                        "searchable":false,
                        "className":"text-center",
                        "render":function(data,type,row){
                            if(row.valid_status === 'valid'){
                                return '<div class="btn btn-success btn-sm"><i class="fas fa-check"></i></div>';
                            } else if(row.valid_status === 'pending'){
                                return '<div class="btn btn-warning btn-sm"><i class="fas fa-exclamation"></i></div>';
                            } else if(row.valid_status === 'rejected'){
                                return '<div class="btn btn-danger btn-sm"><i class="fas fa-times"></i></div>';
                            }
                        }
                    }
            ]
        });
    });
</script>
