<div class="container-fluid">
    <?php echo $this->session->flashdata('pesan') ?>
    <form id="form-laporan-kegiatan">
        <!-- Uraian Kegiatan -->
        <div class="form-group">
            <label for="uraian" class="col-form-label" aria-="true" aria-invalid="false">Uraian Kegiatan</label>
            <input id="uraian" name="uraian" class="form-control" required value="<?php echo $Uraian ?>">
        </div>
        <!-- Lokasi Kegiatan -->
        <div class="form-group">
            <label for="lokasi" class="col-form-label" aria-="true" aria-invalid="false">Lokasi Kegiatan</label>
            <input id="lokasi" name="lokasi" class="form-control" required value="<?php echo $Lokasi ?>">
        </div>
        <!-- waktu kegiatan -->
        <div class="form-group">
          <div>
            <label class="col-form-label" aria-="true" aria-invalid="false">Tanggal Waktu Awal / Akhir</label>
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
                  value=
                  "<?php 
                    $TanggalWaktuAwal = date("c",strtotime($TanggalWaktuAwal));
                    list($Date,$Time)=explode('T',$TanggalWaktuAwal);
                    list($Hour,$TimeZone)=explode('+',$Time);
                    echo $Date;
                  ?>"
                 required 
                />
                <input
                  type="time"
                  name="waktu-awal" 
                  id="waktu-awal" 
                  class="form-control"
                  value=
                  "<?php 
                    echo $Hour; 
                  ?>"
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
                  value=
                  "<?php 
                    $TanggalWaktuAkhir = date("c",strtotime($TanggalWaktuAkhir));
                    list($Date,$Time)=explode('T',$TanggalWaktuAkhir);
                    list($Hour,$TimeZone)=explode('+',$Time);
                    echo $Date; 
                  ?>"
                 required 
                />
                <input
                  type="time"
                  name="waktu-akhir" 
                  id="waktu-akhir" 
                  class="form-control"
                  value=
                  "<?php 
                    echo $Hour; 
                  ?>"
                 required 
                />
              </div>
            </div>
          </div>
        </div>
        <!-- Keterangan -->
        <div class="form-group">
            <label for="keterangan" class="col-form-label" aria-="true" aria-invalid="false">Keterangan Kegiatan</label>
            <input id="keterangan" name="keterangan" class="form-control" value="<?php echo $Keterangan ?>">
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
            </div>
          </div>
        </div>
        <!-- jenis dt -->
        <div 
          id="container-dt"
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
              id="jenis-dt-wrapper"
              style="
                display: grid;
                grid-template-rows: 1fr 1fr 0.2fr;
                grid-gap: 0.75vw;
              "
            >
              <div>
                <label>Jenis DT / Jumlah DT</label>
                <button id="add-dt-btn" class="btn btn-primary" disabled onClick="event.preventDefault()">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- foto -->
        <div 
          id="container-foto"
          style="
              border: 2px solid rgba(211,211,211,.5); 
              -webkit-background-clip: padding-box;
              bakground-clip: padding-box;
              border-radius: 0.5rem; 
              padding: 0.5vw;
              margin-top: 1rem;
          "
        >
          <!-- Peta Lokasi -->
          <div class="form-group">
            <label>Foto Peta Lokasi</label>
            <input type='file' id='peta-lokasi-file' name='peta-lokasi-file' class="form-control" accept="image/png, image/jpeg">
          </div>
          <!-- Awal Kegiatan -->
          <div class="form-group">
            <label>Foto Awal Kegiatan</label>
            <input type='file' id='awal-kegiatan-file' name='awal-kegiatan-file' class="form-control" accept="image/png, image/jpeg">
          </div>
          <!-- Proses Kegiatan -->
          <div class="form-group">
            <label>Foto Proses Kegiatan</label>
            <input type='file' id='proses-kegiatan-file' name='proses-kegiatan-file' class="form-control" accept="image/png, image/jpeg">
          </div>
          <!-- Akhir Kegiatan -->
          <div class="form-group">
            <label>Foto Akhir Kegiatan</label>
            <input type='file' id='akhir-kegiatan-file' name='akhir-kegiatan-file' class="form-control" accept="image/png, image/jpeg">
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
  let jenis_dt;
  let tk_counter = 0;
  let ab_counter = 0;
  let dt_counter = 0;
  let selected_tk = Array();
  let selected_ab = Array();
  let selected_dt = Array();
  let selected_og_tk = Array();
  let selected_og_ab = Array();
  let selected_og_dt = Array();
  let deleted_og_tk = Array();
  let deleted_og_ab = Array();
  let deleted_og_dt = Array();
  let ogTK;
  let ogAB;
  let ogDT;
  let ogDK;
  let KegiatanId = <?php echo $KegiatanId; ?>;

  function getOGTK(){
    return $.ajax({
      type: 'GET',
      url: '<?php echo base_url('administrator/laporankegiatanharian/jenistk')?>'+`?kegiatanid=${KegiatanId}`,
      dataType: 'json',
      success: function(r) {
        ogTK = r;
        getJobRole();
      }
    })
  }

  function getOGAB(){
    return $.ajax({
      type: 'GET',
      url: '<?php echo base_url('administrator/laporankegiatanharian/jenisab')?>'+`?kegiatanid=${KegiatanId}`,
      dataType: 'json',
      success: function(r) {
        ogAB = r;
        getJenisAB();
      }
    })
  }

  function getOGDT(){
    return $.ajax({
      type: 'GET',
      url: '<?php echo base_url('administrator/laporankegiatanharian/jenisdt')?>'+`?kegiatanid=${KegiatanId}`,
      dataType: 'json',
      success: function(r) {
        ogDT = r;
        getJenisDT();
      }
    })
  }

  function initOGTK(data){
    const tk_wrapper = $("div#jenis-tk-wrapper")
    let og_counter = 0;
    ogTK.forEach((val)=>{
      let div = document.createElement('div');
      let select = document.createElement('select');
      let input = document.createElement('input');
      let button = document.createElement('button');
      // div
      div.id = `div-og-tk-${og_counter}`;
      div.style = "display: grid;grid-template-columns: auto min(150px,20%) min(40px);grid-gap: 0.75vw;";
      // select
      select.id = `jenis-og-tk-${og_counter}`;
      select.className = "form-control";
      select.required = true;
      select.disabled = true;
      // input
      input.type = "number";
      input.id = `jumlah-og-tk-${og_counter}`;
      input.className = "form-control";
      input.step = 1;
      input.min = 1;
      input.required = true;
      input.disabled = true;
      // button
      button.className = "btn btn-danger form-control";
      button.id = `delete-og-tk-btn-${og_counter}`;
      button.onClick = "event.preventDefault()";
      button.innerHTML = '<i class="fa fa-trash"></i>';
      button.disabled = true;
      // append
      div.appendChild(select);
      div.appendChild(input);
      div.appendChild(button);
      tk_wrapper.append(div);
      if((data !== null)&&(data !== undefined)){
        let option;
        select.disabled = false;
        input.disabled = false;
        button.disabled = false;
        data.forEach((value)=>{
          option = document.createElement('option');
          if(value.id === val.JobId){
            option.value = value.id;
            option.innerHTML = value.role_name;
            option.selected = true;
            select.appendChild(option);
          } else {
            option.value = value.id;
            option.innerHTML = value.role_name;
            select.appendChild(option);
          }
        })
        input.value = val.Jumlah;
      }
      let selectedOption = $(`#jenis-og-tk-${og_counter} option`).filter(':selected');
      let jumlah = $(`#jumlah-og-tk-${og_counter}`);
      selected_og_tk[og_counter]={KegiatanId: KegiatanId, JobId: selectedOption.val(),JobName: selectedOption.text(),Jumlah: jumlah.val()};
      onJenisOGTKChange(og_counter);
      onJumlahOGTKChange(og_counter);
      deleteOGTKButton(og_counter);
      og_counter++;
    })
  }

  function initOGAB(data){
    const ab_wrapper = $("div#jenis-ab-wrapper")
    let og_counter = 0;
    ogAB.forEach((val)=>{
      let div = document.createElement('div');
      let select = document.createElement('select');
      let input = document.createElement('input');
      let button = document.createElement('button');
      // div
      div.id = `div-og-ab-${og_counter}`;
      div.style = "display: grid;grid-template-columns: auto min(150px,20%) min(40px);grid-gap: 0.75vw;";
      // select
      select.id = `jenis-og-ab-${og_counter}`;
      select.className = "form-control";
      select.required = true;
      select.disabled = true;
      // input
      input.type = "number";
      input.id = `jumlah-og-ab-${og_counter}`;
      input.className = "form-control";
      input.step = 1;
      input.min = 1;
      input.required = true;
      input.disabled = true;
      // button
      button.className = "btn btn-danger form-control";
      button.id = `delete-og-ab-btn-${og_counter}`;
      button.onClick = "event.preventDefault()";
      button.innerHTML = '<i class="fa fa-trash"></i>';
      button.disabled = true;
      // append
      div.appendChild(select);
      div.appendChild(input);
      div.appendChild(button);
      ab_wrapper.append(div);
      if((data !== null)&&(data !== undefined)){
        let option;
        select.disabled = false;
        input.disabled = false;
        button.disabled = false;
        data.forEach((value)=>{
          option = document.createElement('option');
          if(value.id === val.ABId){
            option.value = value.id;
            option.innerHTML = value.category+' '+value.sub_category;
            option.selected = true;
            select.appendChild(option);
          } else {
            option.value = value.id;
            option.innerHTML = value.category+' '+value.sub_category;
            select.appendChild(option);
          }
        })
        input.value = val.Jumlah;
      }
      let selectedOption = $(`#jenis-og-ab-${og_counter} option`).filter(':selected');
      let jumlah = $(`#jumlah-og-ab-${og_counter}`);
      selected_og_ab[og_counter]={KegiatanId: KegiatanId, ABId: selectedOption.val(), JenisAB: selectedOption.text(),Jumlah: jumlah.val()};
      onJenisOGABChange(og_counter);
      onJumlahOGABChange(og_counter);
      deleteOGABButton(og_counter);
      og_counter++;
    })
  }

  function initOGDT(data){
    const dt_wrapper = $("div#jenis-dt-wrapper")
    let og_counter = 0;
    ogDT.forEach((val)=>{
      let div = document.createElement('div');
      let select = document.createElement('select');
      let input = document.createElement('input');
      let button = document.createElement('button');
      // div
      div.id = `div-og-dt-${og_counter}`;
      div.style = "display: grid;grid-template-columns: auto min(150px,20%) min(40px);grid-gap: 0.75vw;";
      // select
      select.id = `jenis-og-dt-${og_counter}`;
      select.className = "form-control";
      select.required = true;
      select.disabled = true;
      // input
      input.type = "number";
      input.id = `jumlah-og-dt-${og_counter}`;
      input.className = "form-control";
      input.step = 1;
      input.min = 1;
      input.required = true;
      input.disabled = true;
      // button
      button.className = "btn btn-danger form-control";
      button.id = `delete-og-dt-btn-${og_counter}`;
      button.onClick = "event.preventDefault()";
      button.innerHTML = '<i class="fa fa-trash"></i>';
      button.disabled = true;
      // append
      div.appendChild(select);
      div.appendChild(input);
      div.appendChild(button);
      dt_wrapper.append(div);
      if((data !== null)&&(data !== undefined)){
        let option;
        select.disabled = false;
        input.disabled = false;
        button.disabled = false;
        data.forEach((value)=>{
          option = document.createElement('option');
          if(value.id === val.DTId){
            option.value = value.id;
            option.innerHTML = 'dt '+value.category;
            option.selected = true;
            select.appendChild(option);
          } else {
            option.value = value.id;
            option.innerHTML = 'dt '+value.category;
            select.appendChild(option);
          }
        })
        input.value = val.Jumlah;
      }
      let selectedOption = $(`#jenis-og-dt-${og_counter} option`).filter(':selected');
      let jumlah = $(`#jumlah-og-dt-${og_counter}`);
      selected_og_dt[og_counter]={KegiatanId: KegiatanId, DTId: selectedOption.val(), JenisDT: selectedOption.text(),Jumlah: jumlah.val()};
      onJenisOGDTChange(og_counter);
      onJumlahOGDTChange(og_counter);
      deleteOGDTButton(og_counter);
      og_counter++;
    })
  }

  function getJobRole(){
    return $.ajax({
        type: 'GET',
        url: '<?php echo base_url('administrator/laporankegiatanharian/jenistk')?>',
        dataType: 'json',
        success: function (r){
          job_role = r;
          initOGTK(job_role);
          $("#add-tk-btn").prop('disabled',false);
          $("#add-tk-btn").on('click',()=>{
            addTKButton()
            initTK(tk_counter,job_role);
            onJenisTKChange(tk_counter);
            onJumlahTKChange(tk_counter);
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
        initOGAB(jenis_ab);
        $("#add-ab-btn").prop('disabled',false);
        $("#add-ab-btn").on('click',()=>{
          addABButton()
          initAB(ab_counter,jenis_ab);
          onJenisABChange(ab_counter);
          onJumlahABChange(ab_counter);
          deleteABButton(ab_counter);
        });
      }
    })
  }

  function getJenisDT(){
    return $.ajax({
      type:'GET',
      url: '<?php echo base_url('administrator/laporankegiatanharian/jenisdt') ?>',
      dataType: 'json',
      success: function(r){
        jenis_dt = r;
        initOGDT(jenis_dt);
        $("#add-dt-btn").prop('disabled',false);
        $("#add-dt-btn").on('click',()=>{
          addDTButton()
          initDT(dt_counter,jenis_dt);
          onJenisDTChange(dt_counter);
          onJumlahDTChange(dt_counter);
          deleteDTButton(dt_counter);
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
    let counter = 1;
    if((data !== null)&&(data !== undefined)){
      data.forEach((value)=>{
        $(`#jenis-ab-${nid}`).append(`<option value=${value.id}>${value.category} ${value.sub_category}</option>`);
        counter++;
      })
    }
    let selectedOption = $(`#jenis-ab-${nid} option`).filter(':selected');
    let jumlah = $(`#jumlah-ab-${nid}`);
    jumlah.val(0)
    selected_ab[nid]={ABId: selectedOption.val(),JenisAB: selectedOption.text(),Jumlah: jumlah.val()};
  }

  function initDT(nid,data){
    $(`#jenis-dt-${nid}`).prop('disabled',false);
    let counter = 1;
    if((data !== null)&&(data !== undefined)){
      data.forEach((value)=>{
        $(`#jenis-dt-${nid}`).append(`<option value=${value.id}>dt ${value.category}</option>`);
        counter++;
      })
    }
    let selectedOption = $(`#jenis-dt-${nid} option`).filter(':selected');
    let jumlah = $(`#jumlah-dt-${nid}`);
    jumlah.val(0)
    selected_dt[nid]={DTId: selectedOption.val(),JenisDT: selectedOption.text(),Jumlah: jumlah.val()}
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
            min=1
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
            min=1
           required 
        />
        <button class="btn btn-danger form-control" id="delete-ab-btn-${ab_counter}" onClick="event.preventDefault();">
          <i class="fa fa-trash"></i>
        </button>
      </div>
    `)
  }

  function addDTButton(){
    dt_counter++;
    $("#jenis-dt-wrapper").append(`
      <div 
        id="div-dt-${dt_counter}"
        style="
          display: grid;
          grid-template-columns: auto min(150px,20%) min(40px);
          grid-gap: 0.75vw;
        "
      >
        <select 
          id="jenis-dt-${dt_counter}" 
          name="jenis-dt-${dt_counter}" 
          class="form-control" 
          required 
          disabled
        >
        </select>
        <input 
            type="number" 
            name="jumlah-dt-${dt_counter}" 
            id="jumlah-dt-${dt_counter}" 
            class="form-control"
            step=1
            min=1
           required 
        />
        <button class="btn btn-danger form-control" id="delete-dt-btn-${dt_counter}" onClick="event.preventDefault();">
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
  function deleteOGTKButton(nid){
    return $(`#delete-og-tk-btn-${nid}`).on('click',()=>{
      $(`#div-og-tk-${nid}`).remove();
      deleted_og_tk.push(selected_og_tk[nid]);
      selected_og_tk[nid]={};
      console.log(deleted_og_tk);
    })
  }
  function deleteOGABButton(nid){
    return $(`#delete-og-ab-btn-${nid}`).on('click',()=>{
      $(`#div-og-ab-${nid}`).remove();
      deleted_og_ab.push(selected_og_ab[nid]);
      selected_og_ab[nid]={};
      console.log(deleted_og_ab);
    })
  }
  function deleteOGDTButton(nid){
    return $(`#delete-og-dt-btn-${nid}`).on('click',()=>{
      $(`#div-og-dt-${nid}`).remove();
      deleted_og_dt.push(selected_og_dt[nid]);
      selected_og_dt[nid]={};
      console.log(deleted_og_dt);
    })
  }
  function deleteABButton(nid){
    $(`#delete-ab-btn-${nid}`).on('click',()=>{
      $(`#div-ab-${nid}`).remove();
      selected_ab[nid]={};
    })
  }
  function deleteDTButton(nid){
    $(`#delete-dt-btn-${nid}`).on('click',()=>{
      $(`#div-dt-${nid}`).remove();
      selected_dt[nid]={};
    })
  }
  
  // jenis tk
  function onJenisTKChange(nid) {
    $(`#jenis-tk-${nid}`).on('change',{id: nid,sel: selected_tk},(event)=>{
      event.data.sel[event.data.id].JobId = $(`#jenis-tk-${event.data.id}`).val();
      event.data.sel[event.data.id].JobName = $(`#jenis-tk-${event.data.id} option`).filter(':selected').text();
    })
  }
  function onJumlahTKChange(nid){
    $(`#jumlah-tk-${nid}`).on('change',{id: nid,sel: selected_tk},(event)=>{
      event.data.sel[event.data.id].Jumlah = $(`#jumlah-tk-${nid}`).val();
    })
  }

  // og jenis tk
  function onJenisOGTKChange(nid) {
    return $(`#jenis-og-tk-${nid}`).on('change',{id: nid,sel: selected_og_tk},(event)=>{
      event.data.sel[event.data.id].JobId = $(`#jenis-og-tk-${event.data.id}`).val();
      event.data.sel[event.data.id].JobName = $(`#jenis-og-tk-${event.data.id} option`).filter(':selected').text();
      console.log(selected_og_tk);
    });
  }
  function onJumlahOGTKChange(nid){
    return $(`#jumlah-og-tk-${nid}`).on('change',{id: nid,sel: selected_og_tk},(event)=>{
      event.data.sel[event.data.id].Jumlah = $(`#jumlah-og-tk-${nid}`).val();
      console.log(selected_og_tk);
    })
  }

  // jenis ab
  function onJenisABChange(nid) {
    $(`#jenis-ab-${nid}`).on('change',{id: nid,sel: selected_ab},(event)=>{
      event.data.sel[event.data.id].ABId = $(`#jenis-ab-${event.data.id}`).val();
      event.data.sel[event.data.id].JenisAB = $(`#jenis-ab-${event.data.id} option`).filter(':selected').text();
    })
  }
  function onJumlahABChange(nid){
    $(`#jumlah-ab-${nid}`).on('change',{id: nid,sel: selected_ab},(event)=>{
      event.data.sel[event.data.id].Jumlah = $(`#jumlah-ab-${nid}`).val();
    })
  }

  // og jenis ab
  function onJenisOGABChange(nid) {
    return $(`#jenis-og-ab-${nid}`).on('change',{id: nid,sel: selected_og_ab},(event)=>{
      event.data.sel[event.data.id].ABId = $(`#jenis-og-ab-${event.data.id}`).val();
      event.data.sel[event.data.id].JenisAB = $(`#jenis-og-ab-${event.data.id} option`).filter(':selected').text();
      console.log(selected_og_ab);
    });
  }

  function onJumlahOGABChange(nid){
    return $(`#jumlah-og-ab-${nid}`).on('change',{id: nid,sel: selected_og_ab},(event)=>{
      event.data.sel[event.data.id].Jumlah = $(`#jumlah-og-ab-${nid}`).val();
      console.log(selected_og_ab);
    })
  }

  // jenis dt
  function onJenisDTChange(nid) {
    $(`#jenis-dt-${nid}`).on('change',{id: nid,sel: selected_dt},(event)=>{
      event.data.sel[event.data.id].DTId = $(`#jenis-dt-${event.data.id}`).val();
      event.data.sel[event.data.id].JenisDT = $(`#jenis-dt-${event.data.id} option`).filter(':selected').text();
    })
  }
  function onJumlahDTChange(nid){
    $(`#jumlah-dt-${nid}`).on('change',{id: nid,sel: selected_dt},(event)=>{
      event.data.sel[event.data.id].Jumlah = $(`#jumlah-dt-${nid}`).val();
    })
  }

  // og jenis dt
  function onJenisOGDTChange(nid) {
    return $(`#jenis-og-dt-${nid}`).on('change',{id: nid,sel: selected_og_dt},(event)=>{
      event.data.sel[event.data.id].DTId = $(`#jenis-og-dt-${event.data.id}`).val();
      event.data.sel[event.data.id].JenisDT = $(`#jenis-og-dt-${event.data.id} option`).filter(':selected').text();
      console.log(selected_og_dt);
    });
  }
  function onJumlahOGDTChange(nid){
    return $(`#jumlah-og-dt-${nid}`).on('change',{id: nid,sel: selected_og_dt},(event)=>{
      event.data.sel[event.data.id].Jumlah = $(`#jumlah-og-dt-${nid}`).val();
      console.log(selected_og_dt);
    })
  }

  $(document).ready(function(){
    getOGTK();
    getOGAB();
    getOGDT();
    /*
    getJenisAB();
    getJenisDT();


    // on submit
    $("#form-laporan-kegiatan").on("submit",(event)=>{
      event.preventDefault();

      let data = {
        Uraian: $("#uraian").val(),
        Lokasi: $("#lokasi").val(),
        TanggalWaktuAwal: $("#tanggal-awal").val()+" "+$("#waktu-awal").val()+":00",
        TanggalWaktuAkhir: $("#tanggal-akhir").val()+" "+$("#waktu-akhir").val()+":00",
        Keterangan: $("#keterangan").val(),
        TenagaKerjas: selected_tk,
        AlatBerats: selected_ab,
        DumptTrucs: selected_dt
      } 

      // get file
      let fotoPetaLokasi = $("#peta-lokasi-file")
      let fotoAwalKegiatan = $("#awal-kegiatan-file") 
      let fotoAkhirKegiatan = $("#akhir-kegiatan-file") 
      let fotoProsesKegiatan = $("#proses-kegiatan-file") 
      let formData = new FormData()
      
      if(fotoPetaLokasi.val() != "" ) {
        formData.append('peta',fotoPetaLokasi[0].files[0])
      }
      if(fotoAwalKegiatan.val() != ""){
        formData.append('awal',fotoAwalKegiatan[0].files[0])
      }
      if(fotoAkhirKegiatan.val() != ""){
        formData.append('akhir',fotoAkhirKegiatan[0].files[0])
      }
      if(fotoProsesKegiatan.val() != ""){
        formData.append('proses',fotoProsesKegiatan[0].files[0])
      }

      $.post(
          '<?php 
              echo base_url('administrator/laporankegiatanharian/api') 
          ?>',
          JSON.stringify(data)
      ).done(
        function(r){
          let response = JSON.parse(r)
          let kegiatanId = response.KegiatanId
          formData.append('KegiatanId',kegiatanId)
          $.ajax({
            url: "<?php echo base_url('administrator/laporankegiatanharian/photoapi')?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false
          }).done(
            function(){
              window.location.href = "<?php echo base_url('administrator/laporankegiatanharian') ?>";
            }
          ).fail(
              function(){
                alert("Gagal Upload Foto");
              }
          )
        }
      ).fail(
        function(){
          alert("Gagal Kirim Data");
        }
      )
    })
    */
  })
</script>
