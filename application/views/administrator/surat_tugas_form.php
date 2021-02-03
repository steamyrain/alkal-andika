<div class="container-fluid">
    <h5 style="text-align: center;">FORM SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas" action="<?php echo base_URL('administrator/surattugas/input_aksi')?>">
        <div class="form-group">
            <label>Tanggal :</label>
            <input 
                type="date" 
                name="form-surat-tugas__date"
                id="form-surat-tugas__date"
                class="form-control"
            />
            <div style="display: none" class="text-danger small ml-3" id="date-error-message"></div>
        </div>
        <div class="form-group">
            <label>Lokasi :</label>
            <input 
                type="text" 
                name="form-surat-tugas__location"
                id="form-surat-tugas__location"
                class="form-control"
                placeholder="Masukkan Nama Lokasi"
            />
            <div style="display: none" class="text-danger small ml-3" id="location-error-message"></div>
        </div>
        <div class="form-group">
            <label>Deskripsi Pekerjaan :</label>
            <textarea 
                name="form-surat-tugas__job"
                id="form-surat-tugas__job"
                class="form-control"
            ></textarea>
            <div style="display: none" class="text-danger small ml-3" id="job-error-message"></div>
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
                <div id="div-subject-operator-0" style="display: grid; grid-template-columns: 3fr 0.2fr; grid-gap: 0.75vw;">
                    <select 
                        name="subject-operator-0" 
                        id="subject-operator-0" 
                        class="form-control" 
                        placeholder="Masukkan Nama Operator"
                    > 
                    </select>
                    <button class="btn btn-danger form-control" id="subject-container--delete-operator-button" onclick="event.preventDefault();">
                            <i class="fa fa-trash"></i>
                    </button>
                </div>
                <?php echo form_error('subject-operator', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div style="display: none" class="text-danger small ml-3" id="operator-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="subject-container--add-operator-button" onclick="event.preventDefault();">
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
                <div id="div-subject-driver-0" style="display: grid; grid-template-columns: 3fr 0.2fr; grid-gap: 0.75vw;">
                    <select 
                        name="subject-driver-0" 
                        id="subject-driver-0" 
                        class="form-control" 
                        placeholder="Masukkan Nama Pengemudi"
                    > 
                    </select>
                    <button class="btn btn-danger form-control" id="subject-container--delete-driver-button" onclick="event.preventDefault();">
                            <i class="fa fa-trash"></i>
                    </button>
                </div>
                <?php echo form_error('subject-driver', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div style="display: none" class="text-danger small ml-3" id="driver-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="subject-container--add-driver-button" onclick="event.preventDefault();">
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
                <div id="div-subject-labour-0" style="display: grid; grid-template-columns: 3fr 0.2fr; grid-gap: 0.75vw;">
                    <select 
                        name="subject-labour-0" 
                        id="subject-labour-0" 
                        class="form-control" 
                        placeholder="Masukkan Nama Tenaga Kerja"
                    > 
                    </select>
                    <button class="btn btn-danger form-control" id="subject-container--delete-labour-button" onclick="event.preventDefault();">
                            <i class="fa fa-trash"></i>
                    </button>
                </div>
                <?php echo form_error('subject-labour', '<div class="text-danger small" ml-3>','</div>'); ?>
            </div>
        </div>
        <div style="display: none" class="text-danger small ml-3" id="labour-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="subject-container--add-labour-button" onclick="event.preventDefault();">
                tambah
            </button>
        </div>
        </div>

        <!-- alat berat -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="vehicle-heavy-container">
            <div class="form-group">
                <label>Alat Berat & BBM (Liter) :</label>
                <div id= "div-vehicle-heavy-0" style="display: grid; grid-template-columns: 3fr 1fr 0.2fr; grid-gap: 0.75vw;">
                    <select 
                        name="vehicle-heavy-0" 
                        id="vehicle-heavy-0" 
                        class="form-control" 
                        placeholder="Masukkan Alat Berat" 
                    >
                    </select>
                    <input 
                        type="number" 
                        id="fuel-vehicle-heavy-0"
                        name="fuel-vehicle-heavy-0"
                        class="form-control"
                        placeholder = "Liter"
                    />
                    <button class="btn btn-danger form-control" id="vehicle-container--delete-heavy-button" onclick="event.preventDefault();">
                            <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div style="display: none" class="text-danger small ml-3" id="heavy-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="vehicle-container--add-heavy-button" onclick="event.preventDefault();">
                tambah
            </button>
        </div>
        </div>

        <!-- dumptruck -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="vehicle-dt-container">
            <div class="form-group">
                <label>Dumptruck & BBM (Liter) :</label>
                <div id= "div-vehicle-dt-0" style="display: grid; grid-template-columns: 3fr 1fr 0.2fr; grid-gap: 0.75vw;">
                    <select 
                        name="vehicle-dt-0" 
                        id="vehicle-dt-0" 
                        class="form-control" 
                        placeholder="Masukkan DT" 
                    >
                    </select>
                    <input 
                        type="number" 
                        id="fuel-vehicle-dt-0"
                        name="fuel-vehicle-dt-0"
                        class="form-control"
                        placeholder = "Liter"
                    />
                    <button class="btn btn-danger form-control" id="vehicle-container--delete-dt-button" onclick="event.preventDefault();">
                            <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div style="display: none" class="text-danger small ml-3" id="dt-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="vehicle-container--add-dt-button" onclick="event.preventDefault();">
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

    // Get Elements from dom
    var subjectDriverContainer; 
    var subjectOperatorContainer;
    var subjectLabourContainer;
    var vehicleHeavyContainer;
    var vehicleDTContainer

    // add button
    var addSubjectDriverButton;
    var addSubjectOperatorButton;
    var addSubjectLabourButton;
    var addVehicleHeavyButton;
    var addVehicleDTButton;

    // delete button
    var deleteSubjectLabourButton;
    var deleteSubjectOperatorButton;
    var deleteSubjectDriverButton;
    var deleteVehicleHeavyButton;
    var deleteVehicleDTButton;

    // select element
    var subjectDriverSelect;
    var subjectOperatorSelect;
    var subjectLabourSelect;
    var vehicleHeavySelect;
    var vehicleDTSelect;

    // support variables
    var subject_operator;
    var len_operator;
    var subject_driver;
    var len_driver;
    var subject_labour;
    var len_labour;
    var vehicle_heavy;
    var len_heavy;
    var vehicle_dt;
    var len_dt;

    // total variable (don't use this variable as total counter!
    // use it for select element's unique id)
    var total_operator;
    var total_driver;
    var total_labour;
    var total_heavy;
    var total_dt;

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_operator;
    var selected_driver;
    var selected_labour;
    var selected_heavy;
    var selected_dt;


    // populate select's option with vehicle
    //function initVehicle(vehicle,vehicleSelect,)

    // send xhttp request (could use fetch but not supported by older browser)
    var xhttp_operator;
    var xhttp_driver;
    var xhttp_labour;
    var xhttp_heavy;
    var xhttp_dt;
        
    // All operations will be done when Dom finally loaded
    window.addEventListener("DOMContentLoaded", ()=> { 
        
        // override submit for debug purposes
        document.getElementById("submit").addEventListener('click',(event)=>{
            event.preventDefault();
            var suratDate = document.getElementById("form-surat-tugas__date").value;
            var suratLocation = document.getElementById("form-surat-tugas__location").value;
            var suratJobDesc = document.getElementById("form-surat-tugas__job").value;
            var subjectOperator = Object.values(selected_operator);
            var subjectDriver = Object.values(selected_driver);
            var subjectLabour = Object.values(selected_labour);
            var suratSubject = subjectOperator.concat(subjectDriver,subjectLabour);
            var suratHeavy = Object.values(selected_heavy);
            var suratDT = Object.values(selected_dt);
            var suratTugas = {
                date: suratDate,
                location: suratLocation,
                job_desc: suratJobDesc,
                subject: suratSubject,
                heavy: suratHeavy,
                dt: suratDT
            };
            var xhrSuratTugas = new XMLHttpRequest();
            xhrSuratTugas.open("POST","<?php echo base_URL('administrator/surattugas/input_aksi'); ?>");
            xhrSuratTugas.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhrSuratTugas.send(JSON.stringify(suratTugas));
            xhrSuratTugas.onreadystatechange = function() {
                if((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)){
                    var jsonResponse = JSON.parse(xhrSuratTugas.responseText);
                    window.location.href = jsonResponse['redirect_url'];
                }
                if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                    console.log('redirect');
                    var jsonResponse = JSON.parse(xhrSuratTugas.responseText);
                    window.location.href = jsonResponse['Location'];
                }
                if((this.readyState === XMLHttpRequest.DONE) && (this.status === 400)){
                    // scroll to top just to have the same ux with other pages
                    window.scrollTo(0,0);

                    // initiate support variables
                    var jsonResponse = JSON.parse(xhrSuratTugas.responseText);
                    var message = jsonResponse['message'];

                    // setup proper error messages
                    if(message['date']){
                        var divErrorDate = document.getElementById('date-error-message');
                        divErrorDate.style.display = 'block';
                        divErrorDate.innerHTML = message['date'];
                    }

                    if(message['job']){
                        var divErrorJob = document.getElementById('job-error-message');
                        divErrorJob.style.display = 'block';
                        divErrorJob.innerHTML = message['job'];
                    }

                    if(message['location']){
                        var divErrorLocation = document.getElementById('location-error-message');
                        divErrorLocation.style.display = 'block';
                        divErrorLocation.innerHTML = message['location'];
                    }

                    if(message['subject']){
                        var divErrorOperator = document.getElementById('operator-error-message');
                        var divErrorDriver = document.getElementById('driver-error-message');
                        var divErrorLabour = document.getElementById('labour-error-message');
                        divErrorOperator.style.display = 'block';
                        divErrorDriver.style.display = 'block';
                        divErrorLabour.style.display = 'block';
                        divErrorOperator.innerHTML = message['subject'];
                        divErrorDriver.innerHTML = message['subject'];
                        divErrorLabour.innerHTML = message['subject'];
                    }

                    if(message['heavy']){
                        var divErrorHeavy = document.getElementById('heavy-error-message');
                        divErrorHeavy.style.display = 'block';
                        divErrorHeavy.innerHTML = message['heavy'];
                    }

                    if(message['dt']){
                        var divErrorDT = document.getElementById('dt-error-message');
                        divErrorDT.style.display = 'block';
                        divErrorDT.innerHTML = message['dt'];
                    }
                }
            }
        },false);

        // Get Elements from dom
        subjectDriverContainer = document.getElementById("subject-driver-container");
        subjectOperatorContainer = document.getElementById("subject-operator-container");
        subjectLabourContainer = document.getElementById("subject-labour-container");
        vehicleHeavyContainer = document.getElementById("vehicle-heavy-container");
        vehicleDTContainer = document.getElementById("vehicle-dt-container");

        // add button
        addSubjectDriverButton = document.getElementById("subject-container--add-driver-button")
        addSubjectOperatorButton = document.getElementById("subject-container--add-operator-button")
        addSubjectLabourButton = document.getElementById("subject-container--add-labour-button")
        addVehicleHeavyButton = document.getElementById("vehicle-container--add-heavy-button")
        addVehicleDTButton = document.getElementById("vehicle-container--add-dt-button")

        // delete button
        deleteSubjectLabourButton = document.getElementById("subject-container--delete-labour-button")
        deleteSubjectOperatorButton = document.getElementById("subject-container--delete-operator-button")
        deleteSubjectDriverButton = document.getElementById("subject-container--delete-driver-button")
        deleteVehicleHeavyButton = document.getElementById("vehicle-container--delete-heavy-button")
        deleteVehicleDTButton = document.getElementById("vehicle-container--delete-dt-button")

        // select element
        subjectDriverSelect = document.getElementById("subject-driver-0");
        subjectOperatorSelect = document.getElementById("subject-operator-0");
        subjectLabourSelect = document.getElementById("subject-labour-0");
        vehicleHeavySelect = document.getElementById("vehicle-heavy-0");
        vehicleDTSelect = document.getElementById("vehicle-dt-0");

        // total variable (don't use this variable as total counter!
        // use it for select element's unique id)
        total_operator = 1;
        total_driver = 1;
        total_labour = 1;
        total_heavy = 1;
        total_dt = 1;

        // initialize object, we use this cause we need the random access through object's keys/properties
        // could use the linked list cause insertion and deletion cost O(1)
        selected_operator = new Object();
        selected_driver = new Object();
        selected_labour = new Object();
        selected_heavy = new Object();
        selected_dt = new Object();

        // populate select's option with vehicle
        //function initVehicle(vehicle,vehicleSelect,)

        // populateOperator populates operator form field
        populateOperators();

        // populateDrivers populates driver form field
        populateDrivers();

        // populateLabours populates labour form field
        populateLabours();

        xhttp_heavy = new XMLHttpRequest();
        xhttp_heavy.onreadystatechange = function() {
            if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                var jsonResponse = JSON.parse(this.responseText);
                window.location.href = jsonResponse['Location'];
            }
            if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
                var obj = JSON.parse(this.responseText);
                vehicle_heavy = obj.vehicle_heavy;
                len_heavy = Object.keys(vehicle_heavy).length;

                // populate vehicleHeavySelect fields
                var heavyCategory="";
                var heavySubcategory="";
                var option;
                var optgroup;
                for(i=0;i<len_heavy;i++){
                    option = document.createElement("option");
                    optgroup = document.createElement("optgroup");
                    if (heavyCategory != vehicle_heavy[i].category){
                        heavyCategory = vehicle_heavy[i].category;
                    }
                    if (heavySubcategory != vehicle_heavy[i].sub_category){
                        heavySubcategory = vehicle_heavy[i].sub_category;
                        if (heavyCategory == heavySubcategory) {
                            optgroup.label =  heavyCategory;
                        } else {
                            optgroup.label =  heavyCategory+" "+vehicle_heavy[i].sub_category;
                        }
                        vehicleHeavySelect.appendChild(optgroup);
                    }
                    option.value=vehicle_heavy[i].id;
                    if(vehicle_heavy[i].plate_number)
                    {
                        option.innerHTML=vehicle_heavy[i].plate_number+' / '+vehicle_heavy[i].type;
                    } else {
                        option.innerHTML=vehicle_heavy[i].serial_number+' / '+vehicle_heavy[i].type;
                    }
                    vehicleHeavySelect.appendChild(option);
                }

                selected_heavy['div-vehicle-heavy-0'] = {
                    "vehicle-heavy-0": vehicleHeavySelect.value, 
                    "fuel-vehicle-heavy-0": 0
                }; 
                
                vehicleHeavySelect.addEventListener('change',(event)=>{
                    selected_heavy['div-vehicle-heavy-0']["vehicle-heavy-0"]=vehicleHeavySelect.value;
                });

                document.getElementById('fuel-vehicle-heavy-0').addEventListener('change',(event)=>{
                    selected_heavy['div-vehicle-heavy-0']['fuel-vehicle-heavy-0']=document.getElementById('fuel-vehicle-heavy-0').value;
                });

                deleteVehicleHeavyButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var div = document.getElementById('div-vehicle-heavy-0');
                    div.remove();
                    delete selected_heavy['div-vehicle-heavy-0'];
                });

                // logic for addVehicleButton
                addVehicleHeavyButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var selectId = `vehicle-heavy-${total_heavy}`;
                    var div = document.createElement("div");
                    var select = document.createElement("select");
                    var input = document.createElement("input");
                    var deleteButton = document.createElement("button");
                    var divGrid = document.createElement("div");
                    div.className = "form-group";
                    div.id = `div-${selectId}`;
                    select.className="form-control";
                    select.id=selectId;
                    input.type="number";
                    input.id=`fuel-${selectId}`;
                    input.className="form-control";
                    input.placeholder="Liter"
                    deleteButton.innerHTML='<i class="fa fa-trash"></i>'; 
                    deleteButton.className="form-control btn btn-danger"

                    var heavyCategory="";
                    var heavySubcategory="";
                    var option;
                    var optgroup;
                    for(i=0;i<len_heavy;i++){
                        option = document.createElement("option");
                        optgroup = document.createElement("optgroup");
                        if (heavyCategory != vehicle_heavy[i].category){
                            heavyCategory = vehicle_heavy[i].category;
                        }
                        if (heavySubcategory != vehicle_heavy[i].sub_category){
                            heavySubcategory = vehicle_heavy[i].sub_category;
                            if (heavyCategory == heavySubcategory) {
                                optgroup.label =  heavyCategory;
                            } else {
                                optgroup.label =  heavyCategory+" "+vehicle_heavy[i].sub_category;
                            }
                            select.appendChild(optgroup);
                        }
                        option.value=vehicle_heavy[i].id;
                        if(vehicle_heavy[i].plate_number)
                        {
                            option.innerHTML=vehicle_heavy[i].plate_number+' / '+vehicle_heavy[i].type;
                        } else {
                            option.innerHTML=vehicle_heavy[i].serial_number+' / '+vehicle_heavy[i].type;
                        }
                        select.appendChild(option);
                    } 

                    divGrid.style="display: grid; grid-template-columns: 3fr 1fr 0.2fr; grid-gap: 0.75vw;";
                    deleteButton.addEventListener('click',(event)=>{event.preventDefault();});
                    divGrid.appendChild(select);
                    divGrid.appendChild(input);
                    divGrid.appendChild(deleteButton);
                    div.appendChild(divGrid);
                    vehicleHeavyContainer.appendChild(div);

                    select.addEventListener('change',(event)=>{
                        selected_heavy[div.id][select.id]=select.value;
                    });
                    input.addEventListener('change',(event)=>{
                        selected_heavy[div.id][input.id]=input.value;
                    });
                    deleteButton.addEventListener('click',(event)=>{
                        event.preventDefault();
                        divGrid.remove();
                        delete selected_heavy[div.id];
                    });
                    var dataHeavy = new Object();
                    dataHeavy[selectId] = select.value;
                    dataHeavy[input.id] = 0;
                    selected_heavy[div.id]=dataHeavy;
                    total_heavy++;
                });
            } 
        }

        xhttp_heavy.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_ab')?>");
        xhttp_heavy.send();

        xhttp_dt = new XMLHttpRequest();
        xhttp_dt.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_dt')?>"); 
        xhttp_dt.send();
        // use function instead of arrow function for assigning callback outside parameter 
        xhttp_dt.onreadystatechange = function() {
            if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                var jsonResponse = JSON.parse(this.responseText);
                window.location.href = jsonResponse['Location'];
            }
            if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)){
                var obj = JSON.parse(this.responseText);
                vehicle_dt = obj.vehicle_dt;
                len_dt = Object.keys(vehicle_dt).length; 

                // populate options for select dt
                var option;
                var optgroup;
                var category = "";
                for (i=0;i<len_dt;i++) {
                    optgroup = document.createElement("optgroup");
                    option = document.createElement("option"); 
                    option.value = vehicle_dt[i].id;
                    option.innerHTML = vehicle_dt[i].plate_number;
                    if (category != vehicle_dt[i].category){
                        optgroup.label = vehicle_dt[i].category;
                        category = vehicle_dt[i].category;
                        vehicleDTSelect.appendChild(optgroup);
                    }
                    vehicleDTSelect.appendChild(option);
                }

                selected_dt['div-vehicle-dt-0']={
                    'vehicle-dt-0': vehicleDTSelect.value,
                    'fuel-vehicle-dt-0': 0
                };

                vehicleDTSelect.addEventListener('change',(event)=>{
                    selected_dt['div-vehicle-dt-0']["vehicle-dt-0"]=vehicleDTSelect.value;
                });

                document.getElementById('fuel-vehicle-dt-0').addEventListener('change',(event)=>{
                    selected_dt['div-vehicle-dt-0']['fuel-vehicle-dt-0']=document.getElementById('fuel-vehicle-dt-0').value;
                });

                deleteVehicleDTButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var div = document.getElementById('div-vehicle-dt-0');
                    div.remove();
                    delete selected_dt['div-vehicle-dt-0'];
                });

                // logic for addVehicleButton
                addVehicleDTButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var selectId = `vehicle-dt-${total_dt}`;
                    var div = document.createElement("div");
                    var select = document.createElement("select");
                    var input = document.createElement("input");
                    var deleteButton = document.createElement("button");
                    var divGrid = document.createElement("div");
                    div.className = "form-group";
                    div.id = `div-${selectId}`;
                    select.className="form-control";
                    select.id=selectId;
                    input.type="number";
                    input.id=`fuel-${selectId}`;
                    input.className="form-control";
                    input.placeholder="Liter"
                    deleteButton.innerHTML='<i class="fa fa-trash"></i>'; 
                    deleteButton.className="form-control btn btn-danger"

                    var option;
                    var optgroup;
                    var category="";
                    for (i=0;i<len_dt;i++){
                        option= document.createElement("option");
                        optgroup = document.createElement("optgroup");
                        option.value = vehicle_dt[i].id;
                        option.innerHTML = vehicle_dt[i].plate_number;
                        if (category != vehicle_dt[i].category) {
                            optgroup.label = vehicle_dt[i].category;
                            select.appendChild(optgroup);
                            category = vehicle_dt[i].category;
                        } 
                        select.appendChild(option);
                    }
                    var dataDT = new Object();
                    dataDT[select.id] = select.value;
                    dataDT[input.id]=0;
                    selected_dt[div.id] = dataDT;

                    total_dt++;

                    select.addEventListener('change',(event)=>{
                        selected_dt[div.id][select.id]=select.value;
                    });

                    input.addEventListener('change',(event)=>{
                        selected_dt[div.id][input.id]=input.value;
                    });

                    deleteButton.addEventListener('click',(event)=>{
                        event.preventDefault();
                        div.remove();
                        delete selected_dt[div.id];
                    });

                    divGrid.style="display: grid; grid-template-columns: 3fr 1fr 0.2fr; grid-gap: 0.75vw;";
                    deleteButton.addEventListener('click',(event)=>{event.preventDefault();});
                    divGrid.appendChild(select);
                    divGrid.appendChild(input);
                    divGrid.appendChild(deleteButton);
                    div.appendChild(divGrid);
                    vehicleDTContainer.appendChild(div);
                }); 
            }
        };
    });

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
    var addSubject = function (event,container,subject,len,select_id,select_init,selected){
        event.preventDefault();
        var div = document.createElement("div");
        var select = document.createElement("select");
        var divGrid = document.createElement("div");
        var deleteButton = document.createElement("button");
        div.className = "form-group";
        div.id = `div-${select_id}`
        select.className="form-control";
        select.id=select_id;
        divGrid.style="display: grid; grid-template-columns: 3fr 0.2fr; grid-gap: 0.75vw";
        deleteButton.innerHTML="<i class='fa fa-trash'></i>";
        deleteButton.className="btn btn-danger form-control"
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
        deleteButton.addEventListener('click',(event)=>{
            event.preventDefault();
            var divSelect = document.getElementById(`div-${select_id}`);
            divSelect.remove();
            delete selected[select_id];
        })
        divGrid.appendChild(select);
        divGrid.appendChild(deleteButton);
        div.appendChild(divGrid);
        container.appendChild(div);
    };

    function populateOperators() {
        xhttp_operator = new XMLHttpRequest();
        xhttp_operator.onreadystatechange = function() {
            if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                var jsonResponse = JSON.parse(this.responseText);
                window.location.href = jsonResponse['Location'];
            }
            if ((this.readyState === XMLHttpRequest.DONE)&&(this.status===200)) {
                var obj = JSON.parse(this.responseText);
                subject_operator = obj.subject_operator;
                len_operator = Object.keys(obj.subject_operator).length;

                // populate select subject fields
                initSubject(subjectOperatorSelect,subject_operator,len_operator)
                selected_operator['subject-operator-0'] = subjectOperatorSelect.value;
                subjectOperatorSelect.addEventListener('change',(event) => {
                    selected_operator['subject-operator-0']=subjectOperatorSelect.value;
                }) 

                // logic for delete button
                deleteSubjectOperatorButton.addEventListener('click',(event) => {
                    var select_id = "subject-operator-0";
                    event.preventDefault();
                    var divSelect = document.getElementById(`div-${select_id}`);
                    divSelect.remove();
                    delete selected_operator[select_id];
                });
                 
                // logic for addOperatorButton
                addSubjectOperatorButton.addEventListener('click',(event) => {
                    var id = `subject-operator-${total_operator}`;
                    var init_id = 'subject-operator-0';
                    addSubject(event,subjectOperatorContainer,subject_operator,len_operator,id,init_id,selected_operator);
                    var otherOperatorSelect = document.getElementById(id);
                    selected_operator[id] = otherOperatorSelect.value;
                    total_operator += 1;
                },false);
            }
        }; 
        xhttp_operator.open("GET","<?php echo base_URL('administrator/surattugas/subject_operator')?>");
        xhttp_operator.send();
    }

    function populateDrivers(){
        xhttp_driver = new XMLHttpRequest();
        xhttp_driver.onreadystatechange = function() {
            if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                var jsonResponse = JSON.parse(this.responseText);
                window.location.href = jsonResponse['Location'];
            }
            if ((this.readyState === XMLHttpRequest.DONE)&&(this.status===200)) {
                var obj = JSON.parse(this.responseText);
                subject_driver = obj.subject_driver;
                len_driver = Object.keys(obj.subject_driver).length;

                // populate select subject fields
                initSubject(subjectDriverSelect,subject_driver,len_driver)
                selected_driver['subject-driver-0'] = subjectDriverSelect.value;
                subjectDriverSelect.addEventListener('change',(event) => {
                    selected_driver['subject-driver-0']=subjectDriverSelect.value;
                }) 

                // logic for delete button
                deleteSubjectDriverButton.addEventListener('click',(event) => {
                    var select_id = "subject-driver-0";
                    event.preventDefault();
                    var divSelect = document.getElementById(`div-${select_id}`);
                    divSelect.remove();
                    delete selected_driver[select_id];
                });
                 
                // logic for addSubjectButton
                addSubjectDriverButton.addEventListener('click',(event) => {
                    var id = `subject-driver-${total_driver}`
                    var init_id = 'subject-driver-0';
                    addSubject(event,subjectDriverContainer,subject_driver,len_driver,id,init_id,selected_driver);
                    var otherDriverSelect = document.getElementById(id);
                    selected_driver[id] = otherDriverSelect.value;
                    total_driver += 1;
                },false);
            }
        };
        xhttp_driver.open("GET","<?php echo base_URL('administrator/surattugas/subject_driver')?>");
        xhttp_driver.send();
    } 

    function populateLabours(){
        xhttp_labour = new XMLHttpRequest();
        xhttp_labour.onreadystatechange = function() {
            if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                var jsonResponse = JSON.parse(this.responseText);
                window.location.href = jsonResponse['Location'];
            }
            if ((this.readyState === XMLHttpRequest.DONE)&&(this.status===200)) {
                var obj = JSON.parse(this.responseText);
                subject_labour = obj.subject_labour;
                len_labour = Object.keys(obj.subject_labour).length;

                // populate select subject fields
                initSubject(subjectLabourSelect,subject_labour,len_labour)
                selected_labour['subject-labour-0'] = subjectLabourSelect.value;
                subjectLabourSelect.addEventListener('change',(event) => {
                    selected_labour['subject-labour-0']=subjectLabourSelect.value;
                }) 

                // logic for delete button
                deleteSubjectLabourButton.addEventListener('click',(event) => {
                    var select_id = "subject-labour-0";
                    event.preventDefault();
                    var divSelect = document.getElementById(`div-${select_id}`);
                    divSelect.remove();
                    delete selected_labour[select_id];
                });

                // logic for addLabourButton
                addSubjectLabourButton.addEventListener('click',(event) => {
                    var id = `subject-labour-${total_labour}`
                    var init_id = 'subject-labour-0';
                    addSubject(event,subjectLabourContainer,subject_labour,len_labour,id,init_id,selected_labour);
                    var otherLabourSelect = document.getElementById(id);
                    selected_labour[id] = otherLabourSelect.value;
                    total_labour += 1;
                },false);
            }
        };  
        xhttp_labour.open("GET","<?php echo base_URL('administrator/surattugas/subject_labour')?>");
        xhttp_labour.send();
    }
</script>
