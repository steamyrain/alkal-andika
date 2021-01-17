<div class="container-fluid">
    <h5 style="text-align: center;">DETAIL SUBJEK SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas" action="<?php echo base_URL('administrator/surattugas/input_aksi')?>">

        <!-- operator -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-operator-container">
            <div class="form-group">
                <label>Operator :</label>
                <?php 
                    $opBuff=json_decode($st_operator_og); 
                    $i = 0;
                    foreach($opBuff as $op) {
                ?>
                    <div 
                        id="div-subject-operator-<?php echo $i; ?>" 
                        style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw;"
                        class="form-group"
                    >
                        <select 
                            name="subject-operator-<?php echo $i; ?>" 
                            id="subject-operator-<?php echo $i; ?>" 
                            class="form-control" 
                            placeholder="Masukkan Nama Operator"
                        > 
                        </select>
                        <button 
                            class="btn btn-danger form-control" 
                            id="subject-container--delete-operator-button-<?php echo $i; ?>"
                        >
                            hapus
                        </button>
                    </div>
                <?php 
                        $i++;
                    } 
                ?>
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
            background-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-driver-container">
            <div class="form-group">
                <label>Pengemudi :</label>
                <?php 
                    $drBuff=json_decode($st_driver_og); 
                    $i = 0;
                    foreach($drBuff as $dr) {
                ?>
                    <div
                        id="div-subject-driver-<?php echo $i;?>" 
                        style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw;"
                        class="form-group"
                    >
                        <select 
                            name="subject-driver-<?php echo $i;?>" 
                            id="subject-driver-<?php echo $i;?>" 
                            class="form-control" 
                            placeholder="Masukkan Nama Pengemudi"
                        > 
                        </select>
                        <button 
                            class="btn btn-danger form-control" 
                            id="subject-container--delete-driver-button-<?php echo $i;?>"
                        >
                            hapus
                        </button>
                    </div>
                <?php 
                        $i++;
                    } 
                ?>
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
            background-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-labour-container">
            <div class="form-group">
                <label>Tenaga Kerja :</label>
                <div id="div-subject-labour-0" style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw;">
                    <select 
                        name="subject-labour-0" 
                        id="subject-labour-0" 
                        class="form-control" 
                        placeholder="Masukkan Nama Tenaga Kerja"
                    > 
                    </select>
                    <button class="btn btn-danger form-control" id="subject-container--delete-labour-button" onclick="event.preventDefault();">hapus</button>
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

    // initialize st og variables;
    var stId = <?php echo $st_id; ?>;
    var st_operator = <?php echo $st_operator_og; ?>;    
    var st_driver = <?php echo $st_driver_og; ?>;    
    var st_labour = <?php echo $st_labour_og; ?>;    
    var len_st_operator = st_operator.length; 
    var len_st_driver = st_driver.length; 
    var len_st_labour = st_labour.length; 
    
    // Get Elements from dom
    var subjectDriverContainer; 
    var subjectOperatorContainer;
    var subjectLabourContainer;

    // add button
    var addSubjectDriverButton;
    var addSubjectOperatorButton;
    var addSubjectLabourButton;

    // delete button
    var deleteSubjectLabourButton;
    var deleteSubjectOperatorButton;
    var deleteSubjectDriverButton;

    // select element
    var subjectDriverSelect;
    var subjectOperatorSelect;
    var subjectLabourSelect;

    // support variables
    var subject_operator;
    var len_operator;
    var subject_driver;
    var len_driver;
    var subject_labour;
    var len_labour;

    // total variable (don't use this variable as total counter!
    // use it for select element's unique id)
    var total_operator;
    var total_driver;
    var total_labour;

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_operator;
    var selected_driver;
    var selected_labour;

    // populate select's option with vehicle
    //function initVehicle(vehicle,vehicleSelect,)

    // send xhttp request (could use fetch but not supported by older browser)
    var xhttp_operator;
    var xhttp_driver;
    var xhttp_labour;
        
    // All operations will be done when Dom finally loaded
    window.addEventListener("DOMContentLoaded", ()=> { 

        // populateOGOperator populates original operator form fields
        populateOGOperators();

        // override submit for debug purposes
        document.getElementById("submit").addEventListener('click',(event)=>{
            event.preventDefault();
        },false);

        /*
        // override submit for debug purposes
        document.getElementById("submit").addEventListener('click',(event)=>{
            event.preventDefault();
        },false);

        // Get Elements from dom
        subjectDriverContainer = document.getElementById("subject-driver-container");
        subjectOperatorContainer = document.getElementById("subject-operator-container");
        subjectLabourContainer = document.getElementById("subject-labour-container");

        // add button
        addSubjectDriverButton = document.getElementById("subject-container--add-driver-button")
        addSubjectOperatorButton = document.getElementById("subject-container--add-operator-button")
        addSubjectLabourButton = document.getElementById("subject-container--add-labour-button")

        // delete button
        deleteSubjectLabourButton = document.getElementById("subject-container--delete-labour-button")
        deleteSubjectOperatorButton = document.getElementById("subject-container--delete-operator-button")
        deleteSubjectDriverButton = document.getElementById("subject-container--delete-driver-button")
    */

        // select element
        subjectDriverSelect = document.getElementById("subject-driver-0");
        subjectOperatorSelect = document.getElementById("subject-operator-0");
        subjectLabourSelect = document.getElementById("subject-labour-0");

        

        // total variable (don't use this variable as total counter!
        // use it for select element's unique id)
        total_operator = len_st_operator;
        total_driver = len_st_driver;
        total_labour = len_st_labour;

        /*
        // initialize object, we use this cause we need the random access through object's keys/properties
        // could use the linked list cause insertion and deletion cost O(1)
        selected_operator = new Object();
        selected_driver = new Object();
        selected_labour = new Object();

        // populateOperator populates operator form field
        populateOperators();

        // populateDrivers populates driver form field
        populateDrivers();

        // populateLabours populates labour form field
        populateLabours();
     */

    });

    // populate select's option with subject 
    function initOGSubject(subjectSelect,subject,len,ogSubjectId) {
        var option;
        for (i=0;i<len;i++){
            option = document.createElement("option");
            option.value=subject[i].id;
            option.innerHTML=subject[i].username;
            if (subject[i].id == ogSubjectId) {
                option.selected = "true";
            }
            subjectSelect.appendChild(option);
        }
    }

    /*
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
        divGrid.style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw";
        deleteButton.innerHTML="hapus";
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
    };*/

    function populateOGOperators() {
        xhttp_operator = new XMLHttpRequest();
        xhttp_operator.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject_operator = obj.subject_operator;
            len_operator = Object.keys(obj.subject_operator).length;

            // populate og select subject fields
            var i = 0
            for (;i<len_st_operator;i++) {
                subjectOperatorSelect = document.getElementById(`subject-operator-${i}`);
                initOGSubject(subjectOperatorSelect,subject_operator,len_operator,st_operator[i].id);
            }

            /* change with loop over og data 
            selected_operator['subject-operator-0'] = subjectOperatorSelect.value;
            subjectOperatorSelect.addEventListener('change',(event) => {
                selected_operator['subject-operator-0']=subjectOperatorSelect.value;
            })
             */

        }; 
        xhttp_operator.open("GET","<?php echo base_URL('administrator/surattugas/subject_operator')?>");
        xhttp_operator.send();
    }

    /*
    function populateDrivers(){
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
     */
</script>
