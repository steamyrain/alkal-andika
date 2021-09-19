<div class="container-fluid">
    <?php echo $this->session->flashdata('pesan') ?>
    <form id="form-laporan-kegiatan">
        <!-- Uraian Kegiatan -->
        <div class="form-group">
            <label for="uraian" class="col-form-label" aria-required="true" aria-invalid="false">Uraian Kegiatan</label>
            <input id="uraian" name="uraian" class="form-control" required>
        </div>
        <!-- Lokasi Kegiatan -->
        <div class="form-group">
            <label for="lokasi" class="col-form-label" aria-required="true" aria-invalid="false">Lokasi Kegiatan</label>
            <input id="lokasi" name="lokasi" class="form-control" required>
        </div>
        <!-- waktu kegiatan -->
        <div class="form-group">
          <div>
            <label class="col-form-label" aria-required="true" aria-invalid="false">Tanggal Waktu Awal / Akhir</label>
            <div
              style="
                display: grid;
                grid-template-columns: auto 0.01fr auto;
                grid-gap: 0.75vw;
              "
            >
              <div
                style="
                  display: grid;
                  grid-template-columns: 0.8fr 0.2fr;
                  grid-gap: 0.75vw;
                "
              >
                <input 
                  type="date" 
                  name="tanggal-awal" 
                  id="tanggal-awal" 
                  class="form-control"
                  required
                />
                <input
                  type="time"
                  name="waktu-awal" 
                  id="waktu-awal" 
                  class="form-control"
                  required
                />
              </div>
              <div style="display: grid; place-items: center;">
                s.d.
              </div>
              <div
                style="
                  display: grid;
                  grid-template-columns: 0.8fr 0.2fr;
                  grid-gap: 0.75vw;
                "
              >
                <input 
                  type="date" 
                  name="tanggal-akhir" 
                  id="tanggal-akhir" 
                  class="form-control"
                  required
                />
                <input
                  type="time"
                  name="waktu-akhir" 
                  id="waktu-akhir" 
                  class="form-control"
                  required
                />
              </div>
            </div>
          </div>
        </div>
        <!-- Keterangan -->
        <div class="form-group">
            <label for="keterangan" class="col-form-label" aria-required="true" aria-invalid="false">Keterangan Kegiatan</label>
            <input id="keterangan" name="keterangan" class="form-control" >
        </div>
        <!-- tenaga kerja -->
        <div 
          id="container-tk"
          style="
              border: 2px solid rgba(211,211,211,.5); 
              -webkit-background-clip: padding-box;
              bakground-clip: padding-box;
              border-radius: 0.5rem; 
              padding: 0.5vw;
              margin-top: 1rem;
          "
        >
          <div class="form-group">
            <div 
              id="jenis-tk-wrapper"
              style="
                display: grid;
                grid-template-rows: 1fr 1fr 0.2fr;
                grid-gap: 0.75vw;
              "
            >
              <div
              >
                <label>Jenis TK / Jumlah TK</label>
                <button id="add-tk-btn" class="btn btn-primary" disabled onClick="event.preventDefault()">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
              <div 
                id="div-tk-0"
                style="
                  display: grid;
                  grid-template-columns: auto min(150px,20%) min(40px);
                  grid-gap: 0.75vw;
                "
              >
                <select 
                  id="jenis-tk-0" 
                  name="jenis-tk-0" 
                  class="form-control" 
                  required 
                  disabled
                >
                </select>
                <input 
                    type="number" 
                    name="jumlah-tk-0" 
                    id="jumlah-tk-0" 
                    class="form-control"
                    step=1
                    required
                />
                <button class="btn btn-danger form-control" id="delete-tk-btn-0" onClick="event.preventDefault();">
                  <i class="fa fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- jenis alat -->
        <div 
          id="container-ab"
          style="
              border: 2px solid rgba(211,211,211,.5); 
              -webkit-background-clip: padding-box;
              bakground-clip: padding-box;
              border-radius: 0.5rem; 
              padding: 0.5vw;
              margin-top: 1rem;
          "
        >
          <div class="form-group">
            <div 
              id="jenis-ab-wrapper"
              style="
                display: grid;
                grid-template-rows: 1fr 1fr 0.2fr;
                grid-gap: 0.75vw;
              "
            >
              <div>
                <label>Jenis Alat / Jumlah Alat</label>
                <button id="add-ab-btn" class="btn btn-primary" disabled onClick="event.preventDefault()">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
              <div 
                id="div-ab-0"
                style="
                  display: grid;
                  grid-template-columns: auto min(150px,20%) min(40px);
                  grid-gap: 0.75vw;
                "
              >
                <select 
                  id="jenis-ab-0" 
                  name="jenis-ab-0" 
                  class="form-control" 
                  required 
                  disabled
                >
                </select>
                <input 
                    type="number" 
                    name="jumlah-ab-0" 
                    id="jumlah-ab-0" 
                    class="form-control"
                    step=1
                    required
                />
                <button class="btn btn-danger form-control" id="delete-ab-btn-0" onClick="event.preventDefault();">
                  <i class="fa fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Submit -->
        <button 
          type="submit" 
          name="submit" 
          value="upload" 
          class="btn btn-primary mb-5 mt-3"
        >
          Simpan
        </button>
    </form>
</div>
<script>
  let job_role;
  let jenis_ab;
  let tk_counter = 0;
  let ab_counter = 0;
  let selected_tk = Array();
  let selected_ab = Array();
  function getJobRole(){
    return $.ajax({
        type: 'GET',
        url: '<?php echo base_url('administrator/laporankegiatanharian/jenistk')?>',
        dataType: 'json',
        success: function (r){
          job_role = r;
          initTK(0,job_role);
          onJenisTKChange(0)
          deleteTKButton(0);
          $("#add-tk-btn").prop('disabled',false);
          $("#add-tk-btn").on('click',()=>{
            addTKButton()
            initTK(tk_counter,job_role);
            deleteTKButton(tk_counter);
          });
        }
    });
  }
  function getJenisAB(){
    return $.ajax({
      type: 'GET',
      url: '<?php echo base_url('administrator/laporankegiatanharian/jenisab')?>',
      dataType: 'json',
      success: function(r){
        jenis_ab = r;
        initAB(0,jenis_ab)
        onJenisABChange(0)
        deleteABButton(0)
        $("#add-ab-btn").prop('disabled',false);
        $("#add-ab-btn").on('click',()=>{
          addABButton()
          initAB(ab_counter,jenis_ab);
          deleteABButton(ab_counter);
        });
      }
    })
  }
  function initTK(nid,data){
    $(`#jenis-tk-${nid}`).prop('disabled',false);
    if((data !== null)&&(data !== undefined)){
      data.forEach((value)=>{
        $(`#jenis-tk-${nid}`).append(`<option value=${value.id}>${value.role_name}</option>`);
      })
    }
    let selectedOption = $(`#jenis-tk-${nid} option`).filter(':selected');
    let jumlah = $(`#jumlah-tk-${nid}`);
    jumlah.val(0)
    selected_tk[nid]={JobId: selectedOption.val(),JobName: selectedOption.text(),Jumlah: jumlah.val()};
  }
  function initAB(nid,data){
    $(`#jenis-ab-${nid}`).prop('disabled',false);
    if((data !== null)&&(data !== undefined)){
      data.forEach((value)=>{
        $(`#jenis-ab-${nid}`).append(`<option value=${value.id}>${value.category} ${value.sub_category}</option>`);
      })
    }
    let selectedOption = $(`#jenis-ab-${nid} option`).filter(':selected');
    let jumlah = $(`#jumlah-ab-${nid}`)
    jumlah.val(0)
    selected_ab[nid]={ABId: selectedOption.val(),JenisAB: selectedOption.text(),Jumlah: jumlah.val()};
  }
  function addTKButton(){
    tk_counter++;
    $("#jenis-tk-wrapper").append(`
      <div 
        id="div-tk-${tk_counter}"
        style="
          display: grid;
          grid-template-columns: auto min(150px,20%) min(40px);
          grid-gap: 0.75vw;
        "
      >
        <select 
          id="jenis-tk-${tk_counter}" 
          name="jenis-tk-${tk_counter}" 
          class="form-control" 
          required 
          disabled
        >
        </select>
        <input 
            type="number" 
            name="jumlah-tk-${tk_counter}" 
            id="jumlah-tk-${tk_counter}" 
            class="form-control"
            step=1
            required
        />
        <button class="btn btn-danger form-control" id="delete-tk-btn-${tk_counter}" onClick="event.preventDefault();">
          <i class="fa fa-trash"></i>
        </button>
      </div>
    `)
  }
  function addABButton(){
    ab_counter++;
    $("#jenis-ab-wrapper").append(`
      <div 
        id="div-ab-${ab_counter}"
        style="
          display: grid;
          grid-template-columns: auto min(150px,20%) min(40px);
          grid-gap: 0.75vw;
        "
      >
        <select 
          id="jenis-ab-${ab_counter}" 
          name="jenis-ab-${ab_counter}" 
          class="form-control" 
          required 
          disabled
        >
        </select>
        <input 
            type="number" 
            name="jumlah-ab-${ab_counter}" 
            id="jumlah-ab-${ab_counter}" 
            class="form-control"
            step=1
            required
        />
        <button class="btn btn-danger form-control" id="delete-ab-btn-${ab_counter}" onClick="event.preventDefault();">
          <i class="fa fa-trash"></i>
        </button>
      </div>
    `)
  }
  function deleteTKButton(nid){
    $(`#delete-tk-btn-${nid}`).on('click',()=>{
      $(`#div-tk-${nid}`).remove();
      selected_tk[nid]={};
    })
  }
  function deleteABButton(nid){
    $(`#delete-ab-btn-${nid}`).on('click',()=>{
      $(`#div-ab-${nid}`).remove();
      selected_ab[nid]={};
    })
  }
  function onJenisTKChange(nid) {
    $(`#jenis-tk-${nid}`).on('change',{id: nid,sel: selected_tk},(event)=>{
      event.data.sel[event.data.id].JobId = $(`#jenis-tk-${event.data.id}`).val();
      event.data.sel[event.data.id].JobName = $(`#jenis-tk-${event.data.id} option`).filter(':selected').text();
      console.log(event.data.sel[event.data.id])
    })
  }
  function onJenisABChange(nid) {
    $(`#jenis-ab-${nid}`).on('change',{id: nid,sel: selected_ab},(event)=>{
      event.data.sel[event.data.id].ABId = $(`#jenis-ab-${event.data.id}`).val();
      event.data.sel[event.data.id].JenisAB = $(`#jenis-ab-${event.data.id} option`).filter(':selected').text();
      console.log(event.data.sel[event.data.id])
    })
  }
  $(document).ready(function(){
    getJobRole();
    getJenisAB();
    // on submit
    $("#form-laporan-kegiatan").on("submit",(event)=>{
      event.preventDefault();
      let data = {
        Uraian: $("#uraian").val(),
        Lokasi: $("#lokasi").val(),
        TanggalWaktuAwal: $("#tanggal-awal").val()+" "+$("#waktu-awal").val()+":00",
        TanggalWaktuAkhir: $("#tanggal-akhir").val()+" "+$("#waktu-akhir").val()+":00",
        TenagaKerjas: selected_tk,
        AlatBerats: selected_ab
      } 
      $.post(
          '<?php 
              echo base_url('administrator/laporankegiatanharian/api') 
          ?>',
          JSON.stringify(data),
          function(){
              window.location.href = "<?php echo base_url('administrator/laporankegiatanharian') ?>";
          }
      );
    })
  })
</script>
