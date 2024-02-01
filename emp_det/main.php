

<?php
// Start the session (if you haven't already)
include '../config.php';
include '../check_session.php';

$pres_emp_det = $emp_hist = $te_exp = $r_exp = $ind_exp = $area_det = array(); // Initialize as empty arrays
$additional_qualifications = array();
$teach_exp = 'NULL';

$sql = "SELECT teach_exp, pre_emp_det, his_det, te_det, r_det, ind_det, area_det FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($teach_exp, $pres_emp_json, $emp_hist_json, $te_exp_json, $r_exp_json, $ind_exp_json, $area_det_json);
$stmt->fetch();
$stmt->close();

  $pres_emp_det = json_decode($pres_emp_json, true);
  $emp_hist = json_decode($emp_hist_json, true);
  $te_exp = json_decode($te_exp_json, true);
  $r_exp = json_decode($r_exp_json, true);
  $ind_exp = json_decode($ind_exp_json, true);
  $area_det = json_decode($area_det_json, true);

?>
<html>
<head>
	<title>Employment Details</title>
	<link rel="stylesheet" type="text/css" href="../favicon.ico" type="image/x-icon">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-datepicker.css">
	<script type="text/javascript" src="../jquery.js"></script>
	<script type="text/javascript" src="../bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap-datepicker.js"></script>

	<link href="../files/css" rel="stylesheet"> 
	<link href="../files/css(1)" rel="stylesheet"> 
	<link href="../files/css(2)" rel="stylesheet"> 
	<link href="../files/css(3)" rel="stylesheet"> 
	<link href="../files/css(4)" rel="stylesheet"> 
	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link href="../files/css2" rel="stylesheet">
  <script src="../jquery-ui.js"></script>
  <script src="../pikaday.min.js"></script>
  <link rel="stylesheet" href="../pikaday.min.css" />
  <script src="../moment.min.js"></script>



</head>
<style type="text/css">
	body { background-color: lightgray; padding-top:0px!important;}

</style>
<body>
<div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
        	<div class="col-md-8 col-md-offset-2">

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> 

        		<h3 style="text-align:center;color:#414002!important;font-weight: bold;font-size: 2.3em; margin-top: 3px; font-family: 'Noto Sans', sans-serif;">भारतीय प्रौद्योगिकी संस्थान इंदौर</h3> -->
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: 'Oswald', sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Indore</h3>
    			

        	</div>
        	

    	   
        </div>
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
   </div> 
			<h3 style="color: #e10425; margin-bottom: 20px; font-weight: bold; text-align: center;font-family: 'Noto Serif', serif;" class="blink_me">Application for Faculty Position</h3>


<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
.floating-box {
    display: inline-block;
    width: 150px;
    height: 75px;
    margin: 10px;
    border: 3px solid #73AD21;  
}
</style>
<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
label{
  padding: 0 !important;
}
hr{
  border-top: 1px solid #025198 !important;
}
span{
  font-size: 1.2em;
  font-family: 'Oswald', sans-serif!important;
  text-align: left!important;
  padding: 0px 10px 0px 0px!important;
  /*margin-bottom: 20px!important;*/

}
hr{
  border-top: 1px solid #025198 !important;
  border-style: dashed!important;
  border-width: 1.2px;
}

.panel-heading{
  font-size: 1.3em;
  font-family: 'Oswald', sans-serif!important;
  letter-spacing: .5px;
}
.btn-primary {
  padding: 9px;
}
</style>
<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });
</script>

<script type="text/javascript">
var tr="";
var counter_exp=1;
var counter_t_exp=2;
var counter_r_exp=3;
var counter_ind_exp=4;


  $(document).ready(function(){
    
    $("#add_more_exp").click(function(){
        create_tr();
        create_serial('exp');
        create_input('position[]', 'Position','position'+counter_exp, 'exp',counter_exp, 'exp');
        create_input('org[]', 'Organization/Institution', 'org'+counter_exp,'exp',counter_exp, 'exp');
        create_input('doj[]', 'DD/MM/YYYY', 'doj'+counter_exp,'exp',counter_exp, 'exp',  false, false, true, true);
        create_input('dol[]', 'DD/MM/YYYY', 'dol'+counter_exp,'exp',counter_exp, 'exp',  false, false, true, true);
        create_input('duration[]', 'Duration','duration'+counter_exp, 'exp',counter_exp,'exp', true);
        counter_exp++;
        return false;
    });

    $("#add_more_t_exp").click(function(){
        create_tr();
        create_serial('t_exp');
        create_input('te_position[]', 'Position','te_position'+counter_t_exp, 't_exp',counter_t_exp, 't_exp');
        create_input('te_employer[]', 'Employer', 'te_employer'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_course[]', 'Courses', 'te_course'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_ug_pg[]', 'UG/PG', 'te_ug_pg'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_no_stu[]', 'No. of Students', 'te_no_stu'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_doj[]', 'DD/MM/YYYY', 'te_doj'+counter_t_exp,'t_exp',counter_t_exp, 't_exp',  false, false, true, false, true);
        create_input('te_dol[]', 'DD/MM/YYYY', 'te_dol'+counter_t_exp,'t_exp',counter_t_exp, 't_exp',  false, false, true, false, true);
        create_input('te_duration[]', 'Duration', 'te_duration'+counter_t_exp,'t_exp',counter_t_exp, 't_exp', true);
        counter_t_exp++;
        return false;
    });

    
    $("#add_more_r_exp").click(function(){
        create_tr();
        create_serial('r_exp');
        create_input('r_exp_position[]', 'Position','r_exp_position'+counter_r_exp, 'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_institute[]', 'Institute', 'r_exp_institute'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_supervisor[]', 'Supervisor', 'r_exp_supervisor'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_doj[]', 'DD/MM/YYYY', 'r_exp_doj'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp', false, false, true, false, false, true);
        create_input('r_exp_dol[]', 'DD/MM/YYYY', 'r_exp_dol'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp',  false, false, true, false, false, true);
        create_input('r_exp_duration[]', 'Duration', 'r_exp_duration'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp',  true);
        counter_r_exp++;
        return false;
    });



$("#add_more_ind_exp").click(function(){
    create_tr();
    create_serial('ind_exp');
    create_input('ind_org[]', 'Organization','ind_org'+counter_ind_exp, 'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('ind_work[]', 'Work Profile', 'ind_work'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('ind_doj[]', 'MM/DD/YYYY', 'ind_doj'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp', false, false, true, false, false, false, true);
    create_input('ind_dol[]', 'DD/MM/YYYY', 'ind_dol'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp',  false, false, true, false, false, false, true);
    create_input('period[]', 'Duration', 'period'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp', true);
    counter_ind_exp++;
    return false;
  });

  });

  function create_select()
  {
    
  }
  function create_tr()
  {
    tr=document.createElement("tr");
  }
  function create_serial(tbody_id)
  {
    //console.log(tbody_id);
    var td=document.createElement("td");
    // var x=0;
    var x = document.getElementById(tbody_id).rows.length;
    // if(document.getElementById(tbody_id).rows)
    // {
    // }
    td.innerHTML=x;
    tr.appendChild(td);
  }
   function for_date_picker(obj)
  {
    obj.setAttribute("data-provide", "datepicker");
    obj.className += " datepicker";
    return obj;

  }

// Function to initialize datepicker
  function initializeDatepicker(elementId) {
      $(elementId).datepicker({
          format: 'dd/mm/yyyy',
          autoclose: true,
      });
  }

  function parseDate(dateString) {
    var parts = dateString.split("/");
    return new Date(parts[2], parts[0] - 1, parts[1]);
}


function dur1(counter){
  console.log("Hi");
  var dojId = 'doj' + counter;
  var dolId = 'dol' + counter;
  var durationId = 'duration' + counter;

  var dojValue = document.getElementById(dojId).value;
  var dolValue = document.getElementById(dolId).value;

  console.log('Debug: dojValue =', dojValue);
  console.log('Debug: dolValue =', dolValue);

  var dojDate = parseDate(dojValue);
  var dolDate = parseDate(dolValue);

  console.log('Debug: dojDate =', dojDate);
  console.log('Debug: dolDate =', dolDate);

  if (dojDate && dolDate) {
        var durationInMilliseconds = dolDate - dojDate;

        console.log('Debug: durationInMilliseconds =', durationInMilliseconds);

        var years = Math.floor(durationInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
        var months = Math.floor((durationInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 * 60 * 1000));

        if (!isNaN(years) && !isNaN(months)) {
            document.getElementById(durationId).value = years + " years " + months + " months";
        } else {
            console.log('Debug: Invalid duration values');
        }
    } else {
        console.log('Debug: Date values are not valid');
    }

    console.log('Debug: End calculateDur');
}

function dur2(counter){
  var dojId = 'te_doj' + counter;
  var dolId = 'te_dol' + counter;
  var durationId = 'te_duration' + counter;

  var dojValue = document.getElementById(dojId).value;
  var dolValue = document.getElementById(dolId).value;

  console.log('Debug: dojValue =', dojValue);
  console.log('Debug: dolValue =', dolValue);

  var dojDate = parseDate(dojValue);
  var dolDate = parseDate(dolValue);

  console.log('Debug: dojDate =', dojDate);
  console.log('Debug: dolDate =', dolDate);

  if (dojDate && dolDate) {
        var durationInMilliseconds = dolDate - dojDate;

        console.log('Debug: durationInMilliseconds =', durationInMilliseconds);

        var years = Math.floor(durationInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
        var months = Math.floor((durationInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 * 60 * 1000));

        if (!isNaN(years) && !isNaN(months)) {
            document.getElementById(durationId).value = years + " years " + months + " months";
        } else {
            console.log('Debug: Invalid duration values');
        }
    } else {
        console.log('Debug: Date values are not valid');
    }

    console.log('Debug: End calculateDur');
}

function dur3(counter){
  var dojId = 'r_exp_doj' + counter;
  var dolId = 'r_exp_dol' + counter;
  var durationId = 'r_exp_duration' + counter;

  var dojValue = document.getElementById(dojId).value;
  var dolValue = document.getElementById(dolId).value;

  console.log('Debug: dojValue =', dojValue);
  console.log('Debug: dolValue =', dolValue);

  var dojDate = parseDate(dojValue);
  var dolDate = parseDate(dolValue);

  console.log('Debug: dojDate =', dojDate);
  console.log('Debug: dolDate =', dolDate);

  if (dojDate && dolDate) {
        var durationInMilliseconds = dolDate - dojDate;

        console.log('Debug: durationInMilliseconds =', durationInMilliseconds);

        var years = Math.floor(durationInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
        var months = Math.floor((durationInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 * 60 * 1000));

        if (!isNaN(years) && !isNaN(months)) {
            document.getElementById(durationId).value = years + " years " + months + " months";
        } else {
            console.log('Debug: Invalid duration values');
        }
    } else {
        console.log('Debug: Date values are not valid');
    }

    console.log('Debug: End calculateDur');
}

function dur4(counter){
  var dojId = 'ind_doj' + counter;
  var dolId = 'ind_dol' + counter;
  var durationId = 'period' + counter;

  var dojValue = document.getElementById(dojId).value;
  var dolValue = document.getElementById(dolId).value;

  console.log('Debug: dojValue =', dojValue);
  console.log('Debug: dolValue =', dolValue);

  var dojDate = parseDate(dojValue);
  var dolDate = parseDate(dolValue);

  console.log('Debug: dojDate =', dojDate);
  console.log('Debug: dolDate =', dolDate);

  if (dojDate && dolDate) {
        var durationInMilliseconds = dolDate - dojDate;

        console.log('Debug: durationInMilliseconds =', durationInMilliseconds);

        var years = Math.floor(durationInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
        var months = Math.floor((durationInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 * 60 * 1000));

        if (!isNaN(years) && !isNaN(months)) {
            document.getElementById(durationId).value = years + " years " + months + " months";
        } else {
            console.log('Debug: Invalid duration values');
        }
    } else {
        console.log('Debug: Date values are not valid');
    }

    console.log('Debug: End calculateDur');
}


function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, select=false, datepicker_set=false, calc_Dur1 = false, calc_Dur2 = false, calc_Dur3 = false, calc_Dur4 = false)
  {
    if(select==false)
    {
      var input=document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("name", t_name);
      input.setAttribute("id", id);
      input.setAttribute("placeholder", place_value);
      input.setAttribute("class", "form-control input-md");
      input.setAttribute("required", "");
      var td=document.createElement("td");
      td.appendChild(input);
      if (calc_Dur1) {
        // Add an event listener for the input change
        input.addEventListener("change", function () {
          dur1(counter);
        });

        // Assuming Bootstrap Datepicker
        if (datepicker_set) {
          var picker = new Pikaday({
              field: inputElement,
              format: 'DD/MM/YYYY',
              yearRange: [1950, new Date().getFullYear()],
              toString: function (date) {
                  // Format the date to 'DD/MM/YYYY'
                  return moment(date).format('DD/MM/YYYY');
              },
              onSelect: function () {
                  updateDuration(inputElement, durationElement);
              }
          });
        }
      }
    if (calc_Dur2) {
        // Add an event listener for the input change
        input.addEventListener("change", function () {
            dur2(counter);
        });

        // Assuming Bootstrap Datepicker
        if (datepicker_set) {
          var picker = new Pikaday({
              field: inputElement,
              format: 'DD/MM/YYYY',
              yearRange: [1950, new Date().getFullYear()],
              toString: function (date) {
                  // Format the date to 'DD/MM/YYYY'
                  return moment(date).format('DD/MM/YYYY');
              },
              onSelect: function () {
                  updateDuration(inputElement, durationElement);
              }
          });
        }
    }

    if (calc_Dur3) {
        // Add an event listener for the input change
        input.addEventListener("change", function () {
            dur3(counter);
        });

        // Assuming Bootstrap Datepicker
        if (datepicker_set) {
          var picker = new Pikaday({
              field: inputElement,
              format: 'DD/MM/YYYY',
              yearRange: [1950, new Date().getFullYear()],
              toString: function (date) {
                  // Format the date to 'DD/MM/YYYY'
                  return moment(date).format('DD/MM/YYYY');
              },
              onSelect: function () {
                  updateDuration(inputElement, durationElement);
              }
          });
        }
    }

      if (calc_Dur4) {
          // Add an event listener for the input change
          input.addEventListener("change", function () {
              dur4(counter);
          });

          // Assuming Bootstrap Datepicker
          if (datepicker_set) {
            var picker = new Pikaday({
                field: inputElement,
                format: 'DD/MM/YYYY',
                yearRange: [1950, new Date().getFullYear()],
                toString: function (date) {
                    // Format the date to 'DD/MM/YYYY'
                    return moment(date).format('DD/MM/YYYY');
                },
                onSelect: function () {
                    updateDuration(inputElement, durationElement);
                }
            });
          }
      }
    }
    if(select==true)
    {
      var sel=document.createElement("select");
      sel.setAttribute("name", t_name);
      sel.setAttribute("id", id);
      sel.setAttribute("class", "form-control input-md");
      sel.innerHTML+="<option>Select</option>";
      sel.innerHTML+="<option value='Principal Investigator'>Principal Investigator</option>";
      sel.innerHTML+="<option value='Co-investigator'>Co-investigator</option>";
      var td=document.createElement("td");
      td.appendChild(sel);
    }
    if(datepicker_set==true)
    {
      input = for_date_picker(input);
    }
    if(btn==true)
    {
      var but=document.createElement("button");
      but.setAttribute("class", "close");
      but.setAttribute("onclick", "remove_row('"+remove_name+"','"+counter+"', '"+tbody_id+"')");
      but.innerHTML="x";
      td.appendChild(but);
    }
    tr.setAttribute("id", "row"+counter);
    tr.appendChild(td);
    document.getElementById(tbody_id).appendChild(tr);
  }
  function remove_row(remove_name, n, tbody_id)
  {
    var tab=document.getElementById(remove_name);
    var tr=document.getElementById("row"+n);
    tab.removeChild(tr);
    var x = document.getElementById(tbody_id).rows.length;
    for(var i=0; i<=x; i++)
    {
      $("#"+tbody_id).find("tr:eq("+i+") td:first").text(i);
      
    }
    
  }

  function removeRow(button) {
    // Get the row to be removed
    var row = button.parentNode.parentNode;

    // Remove the row from the table
    row.parentNode.removeChild(row);

    // Update S. No. after removing the row
    updateSerialNumbers();
  }

  function updateSerialNumbers() {
    var rows = document.querySelectorAll('#exp tr:not(:first-child)');

    rows.forEach(function (row, index) {
        // Update the serial number in the first cell of each row
        row.cells[0].textContent = index + 1;
    });
}
function initPikaday(inputId, durationId) {
    var inputElement = document.getElementById(inputId);
    var durationElement = document.getElementById(durationId);

    if (inputElement && durationElement) {
        var picker = new Pikaday({
            field: inputElement,
            format: 'DD/MM/YYYY',
            yearRange: [1950, new Date().getFullYear()],
            toString: function (date) {
                // Format the date to 'DD/MM/YYYY'
                return moment(date).format('DD/MM/YYYY');
            },
            onSelect: function () {
                updateDuration(inputElement, durationElement);
            }
        });

        // Initial update of duration
        updateDuration(inputElement, durationElement);
    }
}
function updateDuration(startInput, durationInput) {
    var startDateString = startInput.value;

    // Log the input date string for debugging
    console.log('Input Date String:', startDateString);

    // Parse the date string using moment
    var startDate = moment(startDateString, 'DD/MM/YY', true);

    // Check if moment successfully parsed the date
    if (!startDate.isValid()) {
        console.error('Invalid date format:', startDateString);
        return;
    }

    var endDate = moment(); // Assuming current date as end date, modify as needed
    var duration = moment.duration(endDate.diff(startDate));
    var years = duration.years();
    var months = duration.months();

    // Log information to the console
    console.log('Start Date:', startDate.format('DD/MM/YYYY')); // Format to 'DD/MM/YYYY'
    console.log('End Date:', endDate.format('DD/MM/YYYY')); // Format to 'DD/MM/YYYY'
    console.log('Duration:', duration.humanize()); // Outputs a human-readable duration

    // Update the duration input
    durationInput.value = years + ' years ' + months + ' months';
    console.log('Updated Duration:', durationInput.value);
}

</script>
<!-- all bootstrap buttons classes -->
<!-- 
  class="btn btn-sm, btn-lg, "
  color - btn-success, btn-primary, btn-default, btn-danger, btn-info, btn-warning
-->


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 well">
            <form class="form-horizontal" action="process.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="ci_csrf_token" value="" />
            <fieldset>
             
                 <legend>
                  <div class="row">
                    <div class="col-md-10">
                    <h4>Welcome: <font color="#025198"><strong><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></strong></font></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="../fac_login/main.html" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">3. Employment Details</h4>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(A) Present Employment</div>
        <div class="panel-body">
          <span class="col-md-2 control-label" for="pres_emp_position">Position</span>  
          <div class="col-md-4">
          <input id="pres_emp_position" value="<?php echo (is_array($pres_emp_det) && array_key_exists('position', $pres_emp_det)) ? $pres_emp_det['position'] : ''; ?>" name="pres_emp_position" type="text" placeholder="Position" class="form-control input-md" autofocus="" required="">
          </div>

          <span class="col-md-2 control-label" for="pres_emp_employer">Organization/Institution</span>  
          <div class="col-md-4">
          <input id="pres_emp_employer" value="<?php echo (is_array($pres_emp_det) && array_key_exists('employer', $pres_emp_det)) ? $pres_emp_det['employer'] : ''; ?>" name="pres_emp_employer" type="text" placeholder="Organization/Institution" class="form-control input-md" autofocus="">
          </div> 
          
          <span class="col-md-2 control-label" for="pres_status">Status</span>  
          <div class="col-md-4">
              <select id="pres_status" name="pres_status" class="form-control input-md" required="">
                  <option value="">Select</option>
                  <option value="Central Govt." <?php echo (is_array($pres_emp_det) && array_key_exists('status', $pres_emp_det) && $pres_emp_det['status'] === 'Central Govt.') ? 'selected' : ''; ?>>Central Govt.</option>
                  <option value="State Government" <?php echo (is_array($pres_emp_det) && array_key_exists('status', $pres_emp_det) && $pres_emp_det['status'] === 'State Government') ? 'selected' : ''; ?>>State Government</option>
                  <option value="Private" <?php echo (is_array($pres_emp_det) && array_key_exists('status', $pres_emp_det) && $pres_emp_det['status'] === 'Private') ? 'selected' : ''; ?>>Private</option>
                  <option value="Quasi Govt." <?php echo (is_array($pres_emp_det) && array_key_exists('status', $pres_emp_det) && $pres_emp_det['status'] === 'Quasi Govt.') ? 'selected' : ''; ?>>Quasi Govt.</option>
                  <option value="Other" <?php echo (is_array($pres_emp_det) && array_key_exists('status', $pres_emp_det) && $pres_emp_det['status'] === 'Other') ? 'selected' : ''; ?>>Other</option>
              </select>
          </div>

          <span class="col-md-2 control-label" for="pres_emp_doj">Date of Joining</span>  
          <div class="col-md-4">
          <input id="pres_emp_doj" onchange="calculateDuration('pres_emp')" name="pres_emp_doj" type="text" placeholder="Date of Joining" value="<?php echo (is_array($pres_emp_det) && array_key_exists('doj', $pres_emp_det)) ? $pres_emp_det['doj'] : ''; ?>" class="form-control input-md datepicker" required="">
          </div>

          <span class="col-md-2 control-label" for="pres_emp_dol">Date of Leaving <br />(Mention Continue if working)</span>  
          <div class="col-md-4">
          <input id="pres_emp_dol" onchange="calculateDuration('pres_emp')" value="<?php echo (is_array($pres_emp_det) && array_key_exists('dol', $pres_emp_det)) ? $pres_emp_det['dol'] : ''; ?>" name="pres_emp_dol" type="text" placeholder="Date of Leaving" class="form-control input-md datepicker" required="">
          </div>
          
          <span class="col-md-2 control-label" for="pres_emp_duration">Duration (in years & months)</span>  
          <div class="col-md-4">
          <input id="pres_emp_duration" name="pres_emp_duration" type="text" placeholder="Duration" value="<?php echo (is_array($pres_emp_det) && array_key_exists('duration', $pres_emp_det)) ? $pres_emp_det['duration'] : ''; ?>" class="form-control input-md" required="">
          </div>


         

  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <div class="panel-heading">(B) Employment History (After PhD, Starting with Latest)  </strong></font>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_more_exp">Add Details</button></div>
      <div class="panel-body">
        
           <table class="table table-bordered">
              <tbody id="exp">
              
                <tr height="30px">
                <th class="col-md-1"> S. No.</th>
                <th class="col-md-3"> Position </th>
                <th class="col-md-4"> Organization/Institution </th>
                <th class="col-md-1"> Date of Joining</th>
                <th class="col-md-1"> Date of Leaving </th>
                <th class="col-md-2"> Duration (in years & months)</th>
              </tr>

              <?php
            // Iterate through additional qualification data and populate the fields
            if (!empty($emp_hist)) {
                foreach ($emp_hist as $index => $qualification) {
            ?>
                    <tr height="60px">
                    <td class="col-md-1"><?php echo $index + 1; ?></td>
                        <td class="col-md-2">
                            <input id="position<?= $index + 1 ?>" name="position[]" type="text" placeholder="Position" class="form-control input-md" autofocus="" value="<?= $qualification['position'] ?? '' ?>">
                        </td>
                        <td class="col-md-2">
                          <input id="org<?= $index + 1 ?>" name="org[]" type="text" placeholder="Employer" class="form-control input-md" autofocus="" value="<?= $qualification['org'] ?? '' ?>">
                        </td>
                        <td class="col-md-2">
                          <input id="doj<?= $index + 1 ?>" name="doj[]" type="text" placeholder="MM/DD/YY" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['doj'] ?? '' ?>">
                        </td>
                        <td class="col-md-1">
                            <input id="dol<?= $index + 1 ?>" name="dol[]" type="text" placeholder="MM/DD/YY" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['dol'] ?? '' ?>">
                        </td>
                        <td class="col-md-1">
                          <input id="duration<?= $index + 1 ?>" name="duration[]" type="text" placeholder="Duration" class="form-control input-md" autofocus="" value="<?= $qualification['duration'] ?? '' ?>">
                          <button type="button" class="btn btn-light btn-sm" style="background-color: white; color: lightgray; font-size: 22px; margin-left: 120px;" onclick="removeRow(this)">x</button>
                        </td>
                  </tr>
            <?php
                }
            }
            ?>  
            
                             </tbody>
              </table>

              
              
          <h4 style="color:red;">
            <div>
              <textarea style="height:35px; font-weight: bold; color: red;" class="form-control input-md" name="teach_exp_declaration" readonly required="">Experience : Minimum 3 years’ post phd experience</textarea>

              <input type="radio" name="teach_exp" value="Yes" <?php echo ($teach_exp === 'Yes') ? 'checked' : ''; ?> required="">Yes</input>

              <input type="radio" name="teach_exp" value="No" <?php echo ($teach_exp === 'No') ? 'checked' : ''; ?> required="">No</input>
            </div>
        </div>
      </div>
    </div>

<!-- Teaching Experience  -->
          
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
    <div class="panel-heading">(C) Teaching Experience (After PhD)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_t_exp">Add Details</button></div>
      <div class="panel-body">
        <table class="table table-bordered">
            <tbody id="t_exp">
            
            <tr height="30px">
              <th class="col-md-1"> S. No.</th>
              <th class="col-md-2"> Position</th>
              <th class="col-md-1"> Employer </th>
              <th class="col-md-1"> Course Taught </th>
              <th class="col-md-1"> UG/PG </th>
              <th class="col-md-1"> No. of Students </th>
              <th class="col-md-1"> Date of Joining the Institute</th>
              <th class="col-md-1"> Date of Leaving the Institute</th>
              <th class="col-md-1"> Duration (in years & months) </th>
              
            </tr>
            <?php
            // Iterate through additional qualification data and populate the fields
            if (!empty($te_exp)) {
                foreach ($te_exp as $index => $qualification) {
            ?>
                    <tr height="60px">
                        <td class="col-md-1"><?php echo $index + 1; ?></td>
                        <td class="col-md-2">
                            <input id="te_position<?= $index + 1 ?>" name="te_position[]" type="text" placeholder="Position" class="form-control input-md" autofocus="" value="<?= $qualification['position'] ?? '' ?>">
                        </td>
                        <td class="col-md-2">
                          <input id="te_employer<?= $index + 1 ?>" name="te_employer[]" type="text" placeholder="Employer" class="form-control input-md" autofocus="" value="<?= $qualification['employer'] ?? '' ?>">
                        </td>
                        <td class="col-md-2">
                          <input id="te_course<?= $index + 1 ?>" name="te_course[]" type="text" placeholder="Course Taught" class="form-control input-md" autofocus="" value="<?= $qualification['course'] ?? '' ?>">
                        </td>
                        <td class="col-md-1">
                            <input id="te_ug_pg<?= $index + 1 ?>" name="te_ug_pg[]" type="text" placeholder="UG/PG" class="form-control input-md" autofocus="" value="<?= $qualification['ug_pg'] ?? '' ?>">
                        </td>
                        <td class="col-md-1">
                          <input id="te_no_stu<?= $index + 1 ?>" name="te_no_stu[]" type="text" placeholder="No. of Students" class="form-control input-md" autofocus="" value="<?= $qualification['no_stu'] ?? '' ?>">
                        </td>
                        <td class="col-md-1">
                          <input id="te_doj<?= $index + 1 ?>" name="te_doj[]" type="text" placeholder="Date of Joining the Institue" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['doj'] ?? '' ?>">
                        </td>
                        <td class="col-md-3">
                          <input id="te_dol<?= $index + 1 ?>" name="te_dol[]" type="text" placeholder="Date of Leaving the Institue" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['dol'] ?? '' ?>">
                        </td>
                        <td class="col-md-3">
                          <input id="te_duration<?= $index + 1 ?>" name="te_duration[]" type="text" placeholder="Duration(in years & months)" class="form-control input-md" autofocus="" value="<?= $qualification['duration'] ?? '' ?>">
                          <button type="button" class="btn btn-light btn-sm" style="background-color: white; color: lightgray; font-size: 22px; margin-left: 120px;" onclick="removeRow(this)">x</button>
                        </td>
                  </tr>
            <?php
                }
            }
            ?>        
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>

  <!-- c) Research Experience: (including Postdoctoral) input-->
                 
<div class="row">
<div class="col-md-12">
  <div class="panel panel-success">
  <div class="panel-heading">(D) Research Experience (Post PhD, including Post Doctoral)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_r_exp">Add Details</button></div>
    <div class="panel-body">
    <table class="table table-bordered">
    <thead>
        <tr>
            <th class="col-md-1">S. No.</th>
            <th class="col-md-1">Position</th>
            <th class="col-md-2">Institute</th>
            <th class="col-md-2">Supervisor</th>
            <th class="col-md-1">Date of Joining</th>
            <th class="col-md-1">Date of Leaving</th>
            <th class="col-md-1">Duration (in years & months)</th>
        </tr>
    </thead>
    <tbody id="r_exp">
        <?php
        // Iterate through additional qualification data and populate the fields
        if (!empty($r_exp)) {
            foreach ($r_exp as $index => $qualification) {
                ?>
                <tr height="60px">
                    <td class="col-md-1"><?php echo $index + 1; ?></td>
                    <td class="col-md-2">
                        <input id="r_exp_position<?= $index + 1 ?>" name="r_exp_position[]" type="text" placeholder="Position" class="form-control input-md" autofocus="" value="<?= $qualification['position'] ?? '' ?>">
                    </td>
                    <td class="col-md-2">
                        <input id="r_exp_institute<?= $index + 1 ?>" name="r_exp_institute[]" type="text" placeholder="Institute" class="form-control input-md" autofocus="" value="<?= $qualification['institute'] ?? '' ?>">
                    </td>
                    <td class="col-md-2">
                        <input id="r_exp_supervisor<?= $index + 1 ?>" name="r_exp_supervisor[]" type="text" placeholder="Supervisor" class="form-control input-md" autofocus="" value="<?= $qualification['supervisor'] ?? '' ?>">
                    </td>
                    <td class="col-md-1">
                        <input id="r_exp_doj<?= $index + 1 ?>" name="r_exp_doj[]" type="text" placeholder="Date of Joining" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['doj'] ?? '' ?>">
                    </td>
                    <td class="col-md-1">
                        <input id="r_exp_dol<?= $index + 1 ?>" name="r_exp_dol[]" type="text" placeholder="Date of Leaving" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['dol'] ?? '' ?>">
                    </td>
                    <td class="col-md-1">
                        <input id="r_exp_duration<?= $index + 1 ?>" name="r_exp_duration[]" type="text" placeholder="Duration (in years & months)" class="form-control input-md" autofocus="" value="<?= $qualification['duration'] ?? '' ?>">
                        <button type="button" class="btn btn-light btn-sm" style="background-color: white; color: lightgray; font-size: 22px; margin-left: 120px;" onclick="removeRow(this)">x</button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

      </div>
    </div>
  </div>
</div>


<!-- g)  Industrial Experience Interaction -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">(E) Industrial Experience &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_ind_exp">Add Details</button></div>
            <div class="panel-body">

                <table class="table table-bordered">
                    <thead>
                        <tr height="30px">
                            <th class="col-md-1">S. No.</th>
                            <th class="col-md-2">Organization</th>
                            <th class="col-md-3">Work Profile</th>
                            <th class="col-md-2">Date of Joining</th>
                            <th class="col-md-2">Date of Leaving</th>
                            <th class="col-md-2">Duration (in years & months)</th>
                        </tr>
                    </thead>
                    <tbody id="ind_exp">

                        <?php
                        // Iterate through additional qualification data and populate the fields
                        if (!empty($ind_exp)) {
                            foreach ($ind_exp as $index => $qualification) {
                        ?>
                                <tr height="60px">
                                    <td class="col-md-1"><?php echo $index + 1; ?></td>
                                    <td class="col-md-2">
                                        <input id="ind_org<?= $index + 1 ?>" name="ind_org[]" type="text" placeholder="Organization" class="form-control input-md" autofocus="" value="<?= $qualification['org'] ?>">
                                    </td>
                                    <td class="col-md-3">
                                        <input id="ind_work<?= $index + 1 ?>" name="ind_work[]" type="text" placeholder="Work Profile" class="form-control input-md" autofocus="" value="<?= $qualification['work'] ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input id="ind_doj<?= $index + 1 ?>" name="ind_doj[]" type="text" placeholder="Date of Joining" class="form-control input-md datepicker" value="<?= $qualification['doj'] ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input id="ind_dol<?= $index + 1 ?>" name="ind_dol[]" type="text" placeholder="Date of Leaving" class="form-control input-md datepicker" value="<?= $qualification['dol'] ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input id="period<?= $index + 1 ?>" name="period[]" type="text" placeholder="Duration (in years & months)" class="form-control input-md" value="<?= $qualification['period'] ?>">
                                        <button type="button" class="btn btn-light btn-sm" style="background-color: white; color: lightgray; font-size: 22px; margin-left: 120px;" onclick="removeRow(this)">x</button>
                                    </td>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<h4 style="text-align:center; font-weight: bold; color: #6739bb;">4. Area(s) of Specialization and Current Area(s) of Research</h4>
 <div class="row">
  <div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-body">
        <strong>Areas of specialization</strong>
        <textarea style="height:150px" placeholder="Areas of specialization" class="form-control input-md" name="area_spl" maxlength="500" required=""><?php echo isset($area_det['area_spl']) ? $area_det['area_spl'] : ''; ?></textarea>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-body">
        <strong>Current Area of research</strong>
        <textarea style="height:150px" placeholder="Current Area of research" class="form-control input-md" name="area_rese" maxlength="500" required=""><?php echo isset($area_det['area_rese']) ? $area_det['area_rese'] : ''; ?></textarea>
      </div>
    </div>
  </div>
 </div>

<!-- <div class="form-group">
  
  <div class="col-md-1">
    <a href="../acad_det/main.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
  </div>

  <div class="col-md-11">
    <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right" style="margin-left: 75%;">SAVE & NEXT</button>
    
  </div>
  
</div> -->

<div class="form-group">
  <div class="col-md-1">
    <a href="../acad_det/main.php" class="btn btn-primary pull-left">
      &lt; <!-- HTML entity for the '<' symbol -->
    </a>
  </div>

  <div class="col-md-6">
    <span class="pull-right" style="margin-right: 20px;">Page 3/9</span>
  </div>

  <div class="col-md-11">
    <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right" style="margin-left: 75%;">SAVE & NEXT</button>
  </div>
</div>
          
</fieldset>
</form>

        </div>
    </div>
</div>

<script type="text/javascript">
  function yearcalc()
  { 
    // alert('hi');
    var num1=document.getElementById("yoj").value;
    var num2=document.getElementById("yog").value;

    var duration_year=parseFloat(num2)-parseFloat(num1);
    // alert(duration_year);
    document.getElementById("result_test").value = duration_year ;
   
  }
 
</script>

<div id="footer"></div>
</body>
</html>

<script>
    <?php
    if (!empty($emp_hist)) {
        foreach ($emp_hist as $index => $qualification) {
            ?>
            initPikaday("doj<?= $index + 1 ?>", "duration<?= $index + 1 ?>");
            initPikaday("dol<?= $index + 1 ?>", "duration<?= $index + 1 ?>");
            <?php
        }
    }
    ?>
    <?php
    if (!empty($te_exp)) {
        foreach ($te_exp as $index => $qualification) {
            ?>
            initPikaday("te_doj<?= $index + 1 ?>", "te_duration<?= $index + 1 ?>");
            initPikaday("te_dol<?= $index + 1 ?>", "te_duration<?= $index + 1 ?>");
            <?php
        }
    }
    ?>
    <?php
    if (!empty($r_exp)) {
        foreach ($r_exp as $index => $qualification) {
            ?>
            initPikaday("r_exp_doj<?= $index + 1 ?>", "r_exp_duration<?= $index + 1 ?>");
            initPikaday("r_exp_dol<?= $index + 1 ?>", "r_exp_duration<?= $index + 1 ?>");
            <?php
        }
    }
    ?>
    <?php
    if (!empty($ind_exp)) {
        foreach ($ind_exp as $index => $qualification) {
            ?>
            initPikaday("ind_doj<?= $index + 1 ?>", "period<?= $index + 1 ?>");
            initPikaday("ind_dol<?= $index + 1 ?>", "period<?= $index + 1 ?>");
            <?php
        }
    }
    ?>
    var dateFields = ['pres_emp_doj', 'pres_emp_dol'];
    var durationField = 'pres_emp_duration';

    dateFields.forEach(function (field) {
        initPikaday(field, durationField);
    });
</script>

<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script>