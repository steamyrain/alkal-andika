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
                <select name="subject-operator-0" id="subject-operator-0" class="form-control" placeholder="Masukkan Nama Operator"> 
                </select>
                <?php echo form_error('subject-operator', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-operator-button" onclick="event.preventDefault();">
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
                <select name="subject-driver-0" id="subject-driver-0" class="form-control" placeholder="Masukkan Nama Pengemudi"> 
                </select>
                <?php echo form_error('subject-driver', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-driver-button" onclick="event.preventDefault();">
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
                <select name="subject-labour-0" id="subject-labour-0" class="form-control" placeholder="Masukkan Nama Tenaga Kerja"> 
                </select>
                <?php echo form_error('subject-labour', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="subject-container--add-labour-button" onclick="event.preventDefault();">
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
                <label>Alat Berat / Dump Truck & BBM (Liter) :</label>
                <div style="display: grid; grid-template-columns: 4fr 1fr; grid-gap: 0.75vw;">
                    <input 
                        type="text" 
                        name="vehicle" 
                        id="vehicle" 
                        class="form-control" 
                        placeholder="Masukkan Alat Berat / Dump Truck" 
                    />
                    <input 
                        type="number" 
                        name="form-surat-tugas__fuel"
                        class="form-control"
                        placeholder = "Liter BBM"
                    />
                </div>
                <?php echo form_error('fuel', '<div class="text-danger small" ml-3>','</div>'); ?>
                <?php echo form_error('vehicle', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <button id="vehicle-container--add-button" onclick="event.preventDefault();">
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
            onclick="event.preventDefault();"
        >
            Simpan
        </button>
    </form>
</div>
<script>
    window.addEventListener("DOMContentLoaded", ()=> { 
        document.getElementById("submit").addEventListener('click',(event)=>{
            event.preventDefault();
            console.log(selected_operator);
            console.log(selected_driver);
            console.log(selected_labour);
        },false);
        // Get Elements from dom
        var subjectDriverContainer = document.getElementById("subject-driver-container");
        var subjectOperatorContainer = document.getElementById("subject-operator-container");
        var subjectLabourContainer = document.getElementById("subject-labour-container");
        var vehicleContainer = document.getElementById("vehicle-container");

        var addSubjectDriverButton = document.getElementById("subject-container--add-driver-button")
        var addSubjectOperatorButton = document.getElementById("subject-container--add-operator-button")
        var addSubjectLabourButton = document.getElementById("subject-container--add-labour-button")
        var addVehicleButton = document.getElementById("vehicle-container--add-button")

        var subjectDriverSelect = document.getElementById("subject-driver-0");
        var subjectOperatorSelect = document.getElementById("subject-operator-0");
        var subjectLabourSelect = document.getElementById("subject-labour-0");

        var subject_operator;
        var len_operator;
        var subject_driver;
        var len_driver;
        var subject_labour;
        var len_labour;

        // total variable
        var total_operator = 1;
        var total_driver = 1;
        var total_labour = 1;

        // initialize object
        var selected_operator = new Object();
        var selected_driver = new Object();
        var selected_labour = new Object();

        // populate select's option with subject 
        function initSubject(subjectSelect,subject,len) {
            var option;
            for (i=0;i<len;i++){
                option = document.createElement("option");
                option.value=subject[i].id;
                option.innerHTML=subject[i].username;
                subjectSelect.appendChild(option);
            }
        }

        // addSubject function add new form group for selecting surat tugas subject to a container
        var addSubject = function (event,container,subject,len,select_id,selected){
            event.preventDefault();
            var div = document.createElement("div");
            var select = document.createElement("select");
            div.className = "form-group";
            select.className="form-control";
            select.id=select_id;
            var option;
            for (i=0;i<len;i++){
               option = document.createElement("option");
               option.value=subject[i].id;
               option.innerHTML=subject[i].username;
               select.appendChild(option);
            }
            select.addEventListener('change',(event)=>{
                selected[select_id] = select.value; 
            });
            div.appendChild(select);
            container.appendChild(div);
        };

        // populate select's option with vehicle
        //function initVehicle(vehicle,vehicleSelect,)

        // send xhttp request (could use fetch but not supported by older browser)
        var xhttp_operator;
        var xhttp_driver;
        var xhttp_labour;
        var xhttp_vehicle;

        xhttp_operator = new XMLHttpRequest();
        xhttp_operator.onreadystatechange = function() {
            if ((this.readyState === XMLHttpRequest.DONE)&&(this.status===200)) {
                var obj = JSON.parse(this.responseText);
                subject_operator = obj.subject_operator;
                len_operator = Object.keys(obj.subject_operator).length;

                // populate select subject fields
                initSubject(subjectOperatorSelect,subject_operator,len_operator)
                selected_operator['subject-operator-0'] = subjectOperatorSelect.value;
                subjectOperatorSelect.addEventListener('change',(event) => {
                    selected_operator['subject-operator-0']=subjectOperatorSelect.value;
                    console.log(selected_operator['subject-operator-0']);
                }) 
                 
                // logic for addOperatorButton
                addSubjectOperatorButton.addEventListener('click',(event) => {
                    var id = `subject-operator-${total_operator}`
                    addSubject(event,subjectOperatorContainer,subject_operator,len_operator,id,selected_operator);
                    var otherOperatorSelect = document.getElementById(id);
                    selected_operator[id] = otherOperatorSelect.value;
                    total_operator += 1;
                    console.log(`total_operator = ${total_operator}`);
                },false);
            }
        }; 
        xhttp_operator.open("GET","<?php echo base_URL('administrator/surattugas/subject_operator')?>");
        xhttp_operator.send();

        xhttp_driver = new XMLHttpRequest();
        xhttp_driver.onreadystatechange = function() {
            if ((this.readyState === XMLHttpRequest.DONE)&&(this.status===200)) {
                var obj = JSON.parse(this.responseText);
                subject_driver = obj.subject_driver;
                len_driver = Object.keys(obj.subject_driver).length;

                // populate select subject fields
                initSubject(subjectDriverSelect,subject_driver,len_driver)
                selected_driver['subject-driver-0'] = subjectDriverSelect.value;
                subjectDriverSelect.addEventListener('change',(event) => {
                    selected_driver['subject-driver-0']=subjectDriverSelect.value;
                    console.log(selected_driver['subject-driver-0']);
                }) 
                 
                // logic for addSubjectButton
                addSubjectDriverButton.addEventListener('click',(event) => {
                    var id = `subject-driver-${total_driver}`
                    addSubject(event,subjectDriverContainer,subject_driver,len_driver,id,selected_driver);
                    var otherDriverSelect = document.getElementById(id);
                    selected_driver[id] = otherDriverSelect.value;
                    total_driver += 1;
                    console.log(`total_driver = ${total_driver}`);
                },false);
            }
        }; 
        xhttp_driver.open("GET","<?php echo base_URL('administrator/surattugas/subject_driver')?>");
        xhttp_driver.send();

        xhttp_labour = new XMLHttpRequest();
        xhttp_labour.onreadystatechange = function() {
            if ((this.readyState === XMLHttpRequest.DONE)&&(this.status===200)) {
                var obj = JSON.parse(this.responseText);
                subject_labour = obj.subject_labour;
                len_labour = Object.keys(obj.subject_labour).length;

                // populate select subject fields
                initSubject(subjectLabourSelect,subject_labour,len_labour)
                selected_labour['subject-labour-0'] = subjectLabourSelect.value;
                subjectLabourSelect.addEventListener('change',(event) => {
                    selected_labour['subject-labour-0']=subjectLabourSelect.value;
                    console.log(selected_labour['subject-labour-0']);
                }) 

                // logic for addLabourButton
                addSubjectLabourButton.addEventListener('click',(event) => {
                    var id = `subject-labour-${total_labour}`
                    addSubject(event,subjectLabourContainer,subject_labour,len_labour,id,selected_labour);
                    var otherLabourSelect = document.getElementById(id);
                    selected_labour[id] = otherLabourSelect.value;
                    total_labour += 1;
                    console.log(`total_labour = ${total_labour}`);
                },false);
            }
        }; 
        xhttp_labour.open("GET","<?php echo base_URL('administrator/surattugas/subject_labour')?>");
        xhttp_labour.send();

        xhttp_vehicle = new XMLHttpRequest();
        xhttp_vehicle.onreadystatechange = function() {
            if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
                    console.log("get vehicle success!")

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
            } 
        }
        xhttp_vehicle.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_ab')?>");
        xhttp_vehicle.send();
 
    });
</script>
