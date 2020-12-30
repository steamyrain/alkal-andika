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

        <!-- operator -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-operator-container">
            <div class="form-group">
                <label>Operator :</label>
                <select name="subject-operator" id="subject-operator" class="form-control" placeholder="Masukkan Nama Operator"> 
                </select>
                <?php echo form_error('subject', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-operator-button">
                tambah
            </button>
        </div>
        </div>

        <!-- pengemudi -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-container">
            <div class="form-group">
                <label>Pengemudi :</label>
                <select name="subject" id="subject" class="form-control" placeholder="Masukkan Nama Pengemudi"> 
                </select>
                <?php echo form_error('subject', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-button">
                tambah
            </button>
        </div>
        </div>

        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
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
        var subjectSelect = document.getElementById("subject");
        var subject;
        var len;

        // send xhttp request (could use fetch but not supported by older browser)
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject = obj.subject;
            len = Object.keys(obj.subject).length;
            var option;
            for (i=0;i<len;i++){
               option = document.createElement("option");
               option.value=subject[i].id;
               option.innerHTML=subject[i].username;
               subjectSelect.appendChild(option);
            }
        }; 
        xhttp.open("GET","http://192.168.0.140/administrator/surattugas/subject");
        xhttp.send();

        // addSubject function add new form group for selecting surat tugas subject to a container
        var addSubject = function (event){
            event.preventDefault();
            var div = document.createElement("div");
            var select = document.createElement("select");
            div.className = "form-group";
            select.className="form-control";
            select.placeholder="Masukkan Nama Operator/Pengemudi/TK";
            var option;
            for (i=0;i<len;i++){
               option = document.createElement("option");
               option.value=subject[i].id;
               option.innerHTML=subject[i].username;
               select.appendChild(option);
            }
            div.appendChild(select);
            subjectContainer.appendChild(div);
        }

        // logic for addSubjectButton
        addSubjectButton.addEventListener('click',addSubject,false);
        
        // logic for addVehicleButton
        addVehicleButton.addEventListener('click',(event)=>{
            event.preventDefault();
            var div = document.createElement("div");
            var input = document.createElement("input");
            div.className = "form-group";
            input.className="form-control";
            input.placeholder="Masukkan Alat Berat / Dump Truck";
            div.appendChild(input);
            vehicleContainer.appendChild(div);
        });
    });
</script>
