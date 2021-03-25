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
                <form id="printKinerja">
                    <div class="form-group">
                        <label for="job_roleid" class="col-form-label">Bidang</label>
                        <select id="job_roleid" name="job_roleid" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="uid" class="col-form-label">PJLP</label>
                        <select id="uid" name="uid" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="job_date_start" class="col-form-label" aria-required="true" aria-invalid=false>Tanggal Awal Kinerja</label>
                        <input type="date" name="job_date_start" id="job_date_start" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="job_date_end" class="col-form-label" aria-required="true" aria-invalid=false>Tanggal Akhir Kinerja</label>
                        <input type="date" name="job_date_end" id="job_date_end" class="form-control"/>
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
                    type="submit" 
                    class="btn btn-primary"
                    id="printButton"
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
    let form;

    function base64ToArrayBuffer(base64){
        let binaryString = window.atob(base64);
        let binaryLen = binaryString.length;
        let bytes = new Uint8Array(binaryLen);
        for (var i = 0; i < binaryLen; i++) {
            var ascii = binaryString.charCodeAt(i);
            bytes[i] = ascii;
        }
        return bytes;
    }

    function submitForm(){
        return $.ajax({
                type: 'POST',
                url: '<?php echo base_url('administrator/kinerja/printapi') ?>',
                cache: false,
                data: $("form#printKinerja").serialize(),
                success: function(r){
                    let b = base64ToArrayBuffer(r);
                    let blob = new Blob([b],{type: "application/pdf"})
                    let link=document.createElement('a');
                    link.href=window.URL.createObjectURL(blob);
                    link.download="kinerja.pdf";
                    link.click();
                    $("#kinerjaModal").modal('hide');
                    /*
                    $("#kinerjaModal").modal('hide');
                     */
                },
                error: function(r){
                    $("#kinerjaModal").modal('hide');
                }
        });
    }

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
                $("#printButton").prop('disabled',false);
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

        // disable before print button getRoleId called
        $("#printButton").prop('disabled',true);

        // print button click event handler
        $("#printButton").on('click',function(){
            $("form#printKinerja").submit();
        });

        // form printKinerja submit event handler
        $("#printKinerja").on('submit',function(e){
            e.preventDefault();
            submitForm();
        });

        // initialize data table & its necessary config
        table = $("#data-tabel").DataTable({
            dom: "Blfrtip",
            buttons: [
            {
                text: 'Print',
                action: function (e,dt,node,config) {
                    getRoleId();
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
