<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

  <div class="row">
    <div class="col-lg-12">
     <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> E-Ceklist (Kendaraan & Peralatan)
    </div>

    

  </div>
</div>


<form method="POST" action="<?php echo base_url('mekanik/ceklist/tambah_data_aksi') ?>">
  <div class="card mb-3">
    <div class="card-header" style="background: yellow; color: black;">
     <i class="fas fa-user-edit"></i> Isi Form
   </div>
   <div class="card-body">


    <div class="form-row">
      <div class="form-group col-md-6 ">
       <div class="form-group">
        <label >Nama Mekanik</label> 
        <input type="text" readonly class="form-control mb-2" id="nama_mekanik"  value="<?php echo $this->session->userdata('username') ?>">
      </div>

      <div class="form-group">
        <label >Tanggal</label>
        <input type="text" readonly class="form-control mb-2" id="tanggal" value="<?php echo date("Y-m-d");  ?>">
        <input type="hidden" readonly class="form-control mb-2" id="waktu" <?php date_default_timezone_set('Asia/Jakarta'); ?> value="<?php echo date("H:s");  ?>">
        
      </div>

    </div>
    <div class="form-group col-md-6">


     <div class="form-group">
      <label for="exampleFormControlSelect1">Kendaraan & Peralatan</label>
      <select class="form-control select2" id="kendaraan" name="kendaraan">
        <option value="">Pilih</option>
        <?php foreach ($kendaraan as $k) : ?>
          <option value="<?php echo $k->category ?> <?php echo $k->type ?>"><?php echo $k->category ?>
          <?php echo $k->type ?></option>

        <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Nomer Identitas</label>
    <select class="form-control select2" id="serial" name="serial">
     <option value="">Pilih No</option>
     <?php foreach ($serial as $s) : ?>

      <?php 
      if($s->serial_number == ''){
          echo '<option value="'.$s->plate_number.'">'.$s->plate_number.'</option>';
      }else if($s->plate_number == ''){
          echo '<option value="'.$s->serial_number.'">'.$s->serial_number.'</option>';
    }else {
                    
    }
      
     ?>

    <?php endforeach; ?>
  </select>
</div>

</form>

</div>
</div>
</div>
</div>


<div class="row">
  <div class="col-lg-12">
   <div class="alert alert-success" role="alert" style="background: yellow; color: black;">
     <i class="fas fa-check-double" style="color:black;"></i> Table Ceklist
   </div>

   <label>Alat / Kendaraan : <span id="alatnya"></span></label><br>
   <label>No Identitas : <span id="noidnya"></span></label>



   <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th class="text-center" rowspan="2">No</th>
        <th class="text-center" rowspan="2">Item Ceklist</th>
        <th class="text-center" colspan="2">Kondisi</th>
        <th class="text-center" rowspan="2">Keterangan</th>
      </tr>

      <tr>
        <th class="text-center">Baik</th>
        <th class="text-center">Tidak</th>
      </tr>
    </thead>
    <tbody id="ibu">

    </tbody>
  </table>

  <button type="button" class="btn btn-success" style="background: green; color: #fff" id="simpan"><i class="fas fa-save"></i> Simpan</button>


  

</div>
</div>
</div>
</div>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- 
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
 -->
<script>


  $(document).ready(function() {

      // $('.select2').select2();
    // $('input').attr('required', true);   
    // $('input').prop('required', true); 


    $("#serial").change(function() {


      
      let ser = $('#serial').val();
      let ken = $('#kendaraan').val();
      $('#alatnya').text(ken);
      $('#noidnya').text(ser);
      serial = $("#serial").val();

      
      let out = {};

        // console.log($("#serial").val())
        $.ajax({
          url: "<?php echo base_url("mekanik/ceklist/getlistceklis");?>",
          type: "POST",
          data: {
            type: 1,
            kode: serial
          },
          cache: false,
          success: function(dataResult){
            // console.log(dataResult);
            $( "#ibu" ).empty();
            for (var i = 0; i < dataResult.length; i++) {
                 //get key
                 out[dataResult[i].nama_category] = [];
               }


            //store to variable
            for (var i = 0; i < dataResult.length; i++) {
                 //post to key if same
                 for (obj in out) {
                  if(obj == dataResult[i].nama_category){
                    out[obj].push(dataResult[i].nama_item)
                      // console.log(dataResult[i].nama_item)
                    }
                  }

                }


            //to display
            for (objt in out) {

              $( "#ibu" ).append(`
                <tr style="background: green; color: #fff">
                <td></td>
                <td><b><span id='nama_category'>${objt}</span></b></td>
                <td></td>
                <td></td>
                
                <td></td>
                </tr>`);

              let nos = 1;
              for(var i = 0; i < out[objt].length; i++){
                $( "#ibu" ).append(`
                  <tr accessKey="${objt}" id='item${i+objt.replace(' ','')}'>
                  <td>${nos}</td>
                  <td><span   id='Nameunit${i}'>${out[objt][i]}</span></td>
                  <td><input type="radio" name="Statusunit${i+objt.replace(' ','')}" value='baik'  id='Statusunit${i+objt.replace(' ','')}'></td>
                  <td><input type="radio" name="Statusunit${i+objt.replace(' ','')}" value='tidak'  id='Statusunit${i+objt.replace(' ','')}'></td>
                  <td> <input type="text" name="Keteranganunit${i+objt.replace(' ','')}" value="" class="form-control"  id="Keteranganunit${i+objt.replace(' ','')}"></td>
                  </tr>`);
                nos++; 
              }
            }
          }
        })

      });

    $("#simpan").click(function(){

      let datalocal   = $("[id^='item']");
      let datatopost  = [];
      let radiofill   = [];

      for(var i = 0; i < datalocal.length; i++){
  
        let radio = 
          ($("#"+datalocal[i].id+"")[0].children[2].children[0].checked == true ? $("#"+datalocal[i].id+"")[0].children[2].children[0].value : '' )+
          ($("#"+datalocal[i].id+"")[0].children[3].children[0].checked == true ? $("#"+datalocal[i].id+"")[0].children[3].children[0].value : '' );

          $("#"+$("#"+datalocal[i].id+"")[0].children[2].children[0].id+"").attr('style','');

        datatopost[i] = new Array(
          $('#nama_mekanik').val(),
          $('#tanggal').val(),
          $('#waktu').val(),
          $('#kendaraan').val(),
          $('#serial').val(),
          $("#"+datalocal[i].id+"")[0].accessKey,
          $("#"+datalocal[i].id+"")[0].children[1].children[0].innerText,
          
          (radio == '' ? radiofill.push($("#"+datalocal[i].id+"")[0].children[2].children[0].id) : radio ) ,

          $("#"+datalocal[i].id+"")[0].children[4].children[0].value
          )
      }

      if(radiofill.length == 0){

      $.ajax({
        url: "<?php echo base_url('mekanik/ceklist/add_detail'); ?>",
        type: "POST",
        data: {
          data:datatopost
        },
        dataType: 'json',
        success: function (obj) {
          }
        });
      alert("simpan data berhasil");
      location.reload(true);        
    }else{
      
      // console.log(radiofill);
      alert('Mohon Isi Semua Data!')
      for(var i = 0; i < radiofill.length; i++){
        $("#"+radiofill[i]+"").attr('style','outline: 2px solid red;');
      }
    }
 

    });



  });




</script>