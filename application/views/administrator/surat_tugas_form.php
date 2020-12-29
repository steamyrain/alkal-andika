<div class="container-fluid">
    <h5 style="text-align: center;">FORM SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas">
        <div class="form-group">
            <label>Tanggal :</label>
            <input 
                type="date" 
                name="form-surat-tugas__date"
                class="form-control"
            />
            <?php echo form_error('date', '<div class="text-danger small" ml-3>','</div>'); ?>
        </div>
        <div class="form-group">
            <label>Lokasi :</label>
            <input 
                type="text" 
                name="form-surat-tugas__location"
                class="form-control"
            />
            <?php echo form_error('location', '<div class="text-danger small" ml-3>','</div>'); ?>
        </div>
        <div class="form-group">
            <label>BBM :</label>
            <input 
                type="text" 
                name="form-surat-tugas__fuel"
                class="form-control"
            />
            <?php echo form_error('fuel', '<div class="text-danger small" ml-3>','</div>'); ?>
        </div>
        <div id="subject-container">
            <div class="form-group">
                <label>Operator/Pengemudi/TK :</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Masukkan Nama Operator/Pengemudi/TK" />
                <?php echo form_error('subject', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-button">
                tambah
            </button>
        </div>
        <div id="vehicle-container">
            <div class="form-group">
                <label>Alat Berat/Dump Truck :</label>
                <input type="text" name="vehicle" id="vehicle" class="form-control" placeholder="Masukkan Alat Berat / Dump Truck" />
                <?php echo form_error('vehicle', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="vehicle-container--add-button">
                tambah
            </button>
        </div>
        <!-- Submit -->
        <button 
            type="submit" 
            name="submit" 
            id="submit"
            class="btn btn-primary mb-5 mt-3"
        >
            Simpan
        </button>
    </form>
</div>
<script>
    window.addEventListener("DOMContentLoaded", ()=> {
        var subjectContainer = document.getElementById("subject-container");
        var vehicleContainer = document.getElementById("vehicle-container");
        var addSubjectButton = document.getElementById("subject-container--add-button")
        var addVehicleButton = document.getElementById("vehicle-container--add-button")
        
        // logic for addSubjectButton
        addSubjectButton.addEventListener('click',(event)=>{
            event.preventDefault();
            var div = document.createElement("div");
            var input = document.createElement("input");
            div.className = "form-group";
            input.className="form-control";
            input.placeholder="Masukkan Nama Operator/Pengemudi/TK";
            div.appendChild(input);
            subjectContainer.appendChild(div);
        });
        
        // logic for addVehicleButton
        addVehicleButton.addEventListener('click',(event)=>{
            event.preventDefault();
            var div = document.createElement("div");
            var input = document.createElement("input");
            div.className = "form-group";
            input.className="form-control";
            input.placeholder="Masukkan Alat Berat/Dump Truck";
            div.appendChild(input);
            vehicleContainer.appendChild(div);
        });
    });
</script>
