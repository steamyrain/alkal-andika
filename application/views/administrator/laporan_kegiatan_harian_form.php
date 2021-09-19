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
        <!-- Keterangan -->
        <div class="form-group">
            <label for="keterangan" class="col-form-label" aria-required="true" aria-invalid="false">Keterangan Kegiatan</label>
            <input id="keterangan" name="keterangan" class="form-control" required>
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
              style="
                display: grid;
                grid-template-rows: 1fr 1fr 0.2fr;
                grid-gap: 0.75vw;
              "
            >
              <div
              >
                <label>Jenis TK / Jumlah TK</label>
                <button class="btn btn-primary">
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
                    required
                />
                <button class="btn btn-danger form-control" id="subject-container--delete-operator-button" onclick="event.preventDefault();">
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
              style="
                display: grid;
                grid-template-rows: 1fr 1fr 0.2fr;
                grid-gap: 0.75vw;
              "
            >
              <div>
                <label>Jenis Alat / Jumlah Alat</label>
                <button class="btn btn-primary">
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
                    required
                />
                <button class="btn btn-danger form-control" id="-container--delete-operator-button" onclick="event.preventDefault();">
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
  function getJobRole(){
    return $.ajax({
        type: 'GET',
        url: '<?php echo base_url('administrator/laporankegiatanharian/jenistk')?>',
        dataType: 'json',
        success: function (r){
          job_role = r;
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
      }
    })
  }
  $(document).ready(function(){
    getJobRole();
    getJenisAB();
  })
</script>
