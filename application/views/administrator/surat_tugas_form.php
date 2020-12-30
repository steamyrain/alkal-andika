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
                <?php echo form_error('subject-operator', '<div class="text-danger small" ml-3>','</div>'); ?>
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
        <div id="subject-driver-container">
            <div class="form-group">
                <label>Pengemudi :</label>
                <select name="subject-driver" id="subject-driver" class="form-control" placeholder="Masukkan Nama Pengemudi"> 
                </select>
                <?php echo form_error('subject-driver', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-driver-button">
                tambah
            </button>
        </div>
        </div>

        <!-- TK -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-labour-container">
            <div class="form-group">
                <label>Tenaga Kerja :</label>
                <select name="subject-labour" id="subject-labour" class="form-control" placeholder="Masukkan Nama Tenaga Kerja"> 
                </select>
                <?php echo form_error('subject-labour', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-labour-button">
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
        var subjectDriverContainer = document.getElementById("subject-driver-container");
        var subjectOperatorContainer = document.getElementById("subject-operator-container");
        var subjectLabourContainer = document.getElementById("subject-labour-container");
        var vehicleContainer = document.getElementById("vehicle-container");

        var addSubjectDriverButton = document.getElementById("subject-container--add-driver-button")
        var addSubjectOperatorButton = document.getElementById("subject-container--add-operator-button")
        var addSubjectLabourButton = document.getElementById("subject-container--add-labour-button")
        var addVehicleButton = document.getElementById("vehicle-container--add-button")

        var subjectDriverSelect = document.getElementById("subject-driver");
        var subjectOperatorSelect = document.getElementById("subject-operator");
        var subjectLabourSelect = document.getElementById("subject-labour");

        var subject_operator;
        var len_operator;
        var subject_driver;
        var len_driver;
        var subject_labour;
        var len_labour;

        // populate select's option with subject 
        function initSubject(subject,subjectSelect,subject,len) {
            var option;
            for (i=0;i<len;i++){
                option = document.createElement("option");
                option.value=subject[i].id;
                option.innerHTML=subject[i].username;
                subjectSelect.appendChild(option);
            }
        }

        // send xhttp request (could use fetch but not supported by older browser)
        var xhttp_operator;
        var xhttp_driver;
        var xhttp_labour;

        xhttp_operator = new XMLHttpRequest();
        xhttp_operator.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject_operator = obj.subject_operator;
            len_operator = Object.keys(obj.subject_operator).length;

            // populate select subject fields
            initSubject(subject_operator,subjectOperatorSelect,subject_operator,len_operator)
        }; 
        xhttp_operator.open("GET","http://192.168.0.140/administrator/surattugas/subject_operator");
        xhttp_operator.send();

        xhttp_driver = new XMLHttpRequest();
        xhttp_driver.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject_driver = obj.subject_driver;
            len_driver = Object.keys(obj.subject_driver).length;

            // populate select subject fields
            initSubject(subject_driver,subjectDriverSelect,subject_driver,len_driver)
        }; 
        xhttp_driver.open("GET","http://192.168.0.140/administrator/surattugas/subject_driver");
        xhttp_driver.send();

        xhttp_labour = new XMLHttpRequest();
        xhttp_labour.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject_labour = obj.subject_labour;
            len_labour = Object.keys(obj.subject_labour).length;

            // populate select subject fields
            initSubject(subject_labour,subjectLabourSelect,subject_labour,len_labour)
        }; 
        xhttp_labour.open("GET","http://192.168.0.140/administrator/surattugas/subject_labour");
        xhttp_labour.send();

        // addSubject function add new form group for selecting surat tugas subject to a container
        var addSubject = function (event,container,subject,len){
            event.preventDefault();
            var div = document.createElement("div");
            var select = document.createElement("select");
            div.className = "form-group";
            select.className="form-control";
            var option;
            for (i=0;i<len;i++){
               option = document.createElement("option");
               option.value=subject[i].id;
               option.innerHTML=subject[i].username;
               select.appendChild(option);
            }
            div.appendChild(select);
            container.appendChild(div);
        };

        // logic for addSubjectButton
        addSubjectDriverButton.addEventListener('click',(event) => {
            addSubject(event,subjectDriverContainer,subject_driver,len_driver);
        },false);

        // logic for addOperatorButton
        addSubjectOperatorButton.addEventListener('click',(event) => {
            addSubject(event,subjectOperatorContainer,subject_operator,len_operator);
        },false);
        
        // logic for addOperatorButton
        addSubjectLabourButton.addEventListener('click',(event) => {
            addSubject(event,subjectLabourContainer,subject_labour,len_labour);
        },false);
        
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
