
<?php
include '../config.php';
include '../check_session.php';
session_start();

$s_proj = $awards = $prof_trg = $membership = $consultancy = array(); // Initialize as empty arrays
$additional_qualifications = array();

$sql = "SELECT s_proj, prof_trg, membership, awards, consultancy FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($s_proj_json, $prof_trg_json, $membership_json, $awards_json, $consultancy_json);
$stmt->fetch();
$stmt->close();

  $s_proj = json_decode($s_proj_json, true);
  $awards = json_decode($awards_json, true);
  $prof_trg = json_decode($prof_trg_json, true);
  $membership = json_decode($membership_json, true);
  $consultancy = json_decode($consultancy_json, true);
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Academic Industrial Experience</title>
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


	
<style type="text/css">
	body { background-color: lightgray; padding-top:0px!important;}

</style></head>

<body>
<div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
        	<div class="col-md-8 col-md-offset-2">

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> 

        		<h3 style="text-align:center;color:#414002!important;font-weight: bold;font-size: 2.3em; margin-top: 3px; font-family: &#39;Noto Sans&#39;, sans-serif;">भारतीय प्रौद्योगिकी संस्थान इंदौर</h3> -->
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: &#39;Oswald&#39;, sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Patna</h3>
    			

        	</div>
        	

    	   
        </div>
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
   </div> 
			<h3 style="color: rgb(225, 4, 37); margin-bottom: 20px; font-weight: bold; text-align: center; font-family: &quot;Noto Serif&quot;, serif; opacity: 0.955053;" class="blink_me">Application for Faculty Position</h3>

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
var tr = "";
var counter_s_proj = 1;
var counter_award = 1;
var counter_prof_trg = 1;
var counter_membership = 1;
var counter_consultancy = 1;

$(document).ready(function () {

    $("#add_more_s_proj").click(function () {
        create_tr();
        create_serial('s_proj');
        create_input('agency[]', 'Sponsoring Agency', 'agency' + counter_s_proj, 's_proj', counter_s_proj, 's_proj');
        create_input('stitle[]', 'Title of Project', 'stitle' + counter_s_proj, 's_proj', counter_s_proj, 's_proj');
        create_input('samount[]', 'Amount of grant', 'samount' + counter_s_proj, 's_proj', counter_s_proj, 's_proj');
        create_input('speriod[]', 'Period', 'speriod' + counter_s_proj, 's_proj', counter_s_proj, 's_proj');
        create_input('s_role[]', 'Role', 's_role' + counter_s_proj, 's_proj', counter_s_proj, 's_proj', false, true);
        create_input('s_status[]', 'Status', 's_status' + counter_s_proj, 's_proj', counter_s_proj, 's_proj', true);
        counter_s_proj++;
        return false;
    });

    $("#add_more_award").click(function () {
        create_tr();
        create_serial('award');
        create_input('award_nature[]', 'Name of Award', 'award_nature' + counter_award, 'award', counter_award, 'award');
        create_input('award_org[]', 'Granting body/Organization', 'award_org' + counter_award, 'award', counter_award, 'award');
        create_input('award_year[]', 'Year', 'award_year' + counter_award, 'award', counter_award, 'award', true);
        counter_award++;
        return false;
    });

    $("#add_more_prog_trg").click(function () {
        create_tr();
        create_serial('prof_trg');
        create_input('trg[]', 'Taining Received', 'trg' + counter_prof_trg, 'prof_trg', counter_prof_trg, 'prof_trg');
        create_input('porg[]', 'Organization', 'porg' + counter_prof_trg, 'prof_trg', counter_prof_trg, 'prof_trg');
        create_input('pyear[]', 'Year', 'pyear' + counter_prof_trg, 'prof_trg', counter_prof_trg, 'prof_trg');
        create_input('pduration[]', 'Duration', 'pduration' + counter_prof_trg, 'prof_trg', counter_prof_trg, 'prof_trg', true);
        counter_prof_trg++;
        return false;
    });

    $("#add_membership").click(function () {
        create_tr();
        create_serial('membership');
        create_input('mname[]', 'Name of the Professional Society', 'mname' + counter_membership, 'membership', counter_membership, 'membership');
        create_input('mstatus[]', 'Membership Status (Lifetime/Annual)', 'mstatus' + counter_membership, 'membership', counter_membership, 'membership', true);
        counter_membership++;
        return false;
    });

    $("#add_consultancy").click(function () {
        create_tr();
        create_serial('consultancy');
        create_input('c_org[]', 'Organization', 'c_org' + counter_consultancy, 'consultancy', counter_consultancy, 'consultancy');
        create_input('ctitle[]', 'Title of Project', 'ctitle' + counter_consultancy, 'consultancy', counter_consultancy, 'consultancy');
        create_input('camount[]', 'Amount of grant', 'camount' + counter_consultancy, 'consultancy', counter_consultancy, 'consultancy');
        create_input('cperiod[]', 'Period', 'cperiod' + counter_consultancy, 'consultancy', counter_consultancy, 'consultancy');

        create_input('c_role[]', 'Role', 'c_role' + counter_consultancy, 'consultancy', counter_consultancy, 'consultancy', false, true);
        create_input('c_status[]', 'Status', 'c_status' + counter_consultancy, 'consultancy', counter_consultancy, 'consultancy', true);
        counter_consultancy++;
        return false;
    });
});

function create_select() {

}

function create_tr() {
    tr = document.createElement("tr");
}

function create_serial(tbody_id) {
    var td = document.createElement("td");
    var x = document.getElementById(tbody_id).rows.length;
    td.innerHTML = x;
    tr.appendChild(td);
}

function for_date_picker(obj) {
    obj.setAttribute("data-provide", "datepicker");
    obj.className += " datepicker";
    return obj;
}

function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn = false, select = false, datepicker_set = false) {
    if (select == false) {
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", t_name);
        input.setAttribute("id", id);
        input.setAttribute("placeholder", place_value);
        input.setAttribute("class", "form-control input-md");
        input.setAttribute("required", "");
        var td = document.createElement("td");
        td.appendChild(input);
    }
    if (select == true) {
        var sel = document.createElement("select");
        sel.setAttribute("name", t_name);
        sel.setAttribute("id", id);
        sel.setAttribute("class", "form-control input-md");
        sel.innerHTML += "<option>Select</option>";
        sel.innerHTML += "<option value='Principal Investigator'>Principal Investigator</option>";
        sel.innerHTML += "<option value='Co-investigator'>Co-investigator</option>";
        var td = document.createElement("td");
        td.appendChild(sel);
    }
    if (datepicker_set == true) {
        input = for_date_picker(input);
    }
    if (btn == true) {
        var but = document.createElement("button");
        but.setAttribute("class", "close");
        but.setAttribute("onclick", "remove_row('" + remove_name + "','" + counter + "', '" + tbody_id + "')");
        but.innerHTML = "x";
        td.appendChild(but);
    }
    tr.setAttribute("id", "row" + counter);
    tr.appendChild(td);
    document.getElementById(tbody_id).appendChild(tr);
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
}

function remove_row(remove_name, n, tbody_id) {
    var tab = document.getElementById(remove_name);
    var tr = document.getElementById("row" + n);
    tab.removeChild(tr);

    // Update row numbers
    updateRowNumbers(tbody_id);
}

function updateRowNumbers(tbody_id) {
    var rows = document.getElementById(tbody_id).rows;
    for (var i = 0; i < rows.length; i++) {
        rows[i].cells[0].innerHTML = i + 1;
    }
}
</script>

<script>
    function removeRow(button) {
        // Assuming the button is in a td, and the tr is the parent
        var row = button.closest('tr');
        row.remove();
    }
</script>


<div class="container">
  
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 well">
            <form class="form-horizontal" action="process.php" method="post" enctype="multipart/form-data">
            <fieldset>
              <input type="hidden" name="ci_csrf_token" value="">
             
                 <legend>
                  <div class="row">
                    <div class="col-md-10">
                        <h4>Welcome : <font color="#025198"><strong><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></strong></font></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="../fac_login/main.html" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>



<!-- Membership of Professional Societies -->
<h4 style="text-align:center; font-weight: bold; color: #6739bb;">9. Membership of Professional Societies</h4>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">Fill the Details &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_membership">Add Details</button></div>
            <div class="panel-body">
            <table class="table table-bordered">
                    <tbody id="membership">
                        <tr height="30px">
                            <th class="col-md-1">S. No.</th>
                            <th class="col-md-3">Name of the Professional Society</th>
                            <th class="col-md-3">Membership Status (Lifetime/Annual)</th>
                        </tr>
                        <?php
                        if (!empty($membership)) {
                            foreach ($membership as $index => $society) {
                        ?>
                                <tr height="60px">
                                    <td class="col-md-1"><?php echo $index + 1; ?></td>
                                    <td class="col-md-3">
                                        <input name="mname[]" type="text" class="form-control input-md" value="<?= $society['name'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-3">
                                        <input name="mstatus[]" type="text" class="form-control input-md" value="<?= $society['status'] ?? '' ?>">
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


<!-- Professional Training -->
<h4 style="text-align:center; font-weight: bold; color: #6739bb;">10. Professional Training</h4>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">Fill the Details &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_prog_trg">Add Details</button></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody id="prof_trg">
                        <tr height="30px">
                            <th class="col-md-1">S. No.</th>
                            <th class="col-md-3">Type of Training Received</th>
                            <th class="col-md-3">Organisation</th>
                            <th class="col-md-2">Year</th>
                            <th class="col-md-2">Duration (in years &amp; months)</th>
                        </tr>
                        <?php
                        if (!empty($prof_trg)) {
                            foreach ($prof_trg as $index => $training) {
                        ?>
                                <tr height="60px">
                                    <td class="col-md-1"><?php echo $index + 1; ?></td>
                                    <td class="col-md-3">
                                        <input name="trg[]" type="text" class="form-control input-md" value="<?= $training['name'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-3">
                                        <input name="porg[]" type="text" class="form-control input-md" value="<?= $training['organization'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="pyear[]" type="text" class="form-control input-md" value="<?= $training['year'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="pduration[]" type="text" class="form-control input-md" value="<?= $training['duration'] ?? '' ?>">
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


<!-- Award(s) and Recognition(s) -->
<h4 style="text-align:center; font-weight: bold; color: #6739bb;">11. Award(s) and Recognition(s)</h4>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">Fill the Details &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_award">Add Details</button></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody id="award">
                        <tr height="30px">
                            <th class="col-md-1">S. No.</th>
                            <th class="col-md-3">Name of Award</th>
                            <th class="col-md-3">Awarded By</th>
                            <th class="col-md-2">Year</th>
                        </tr>
                        <?php
                        if (!empty($awards)) {
                            foreach ($awards as $index => $award) {
                        ?>
                                <tr height="60px">
                                    <td class="col-md-1"><?php echo $index + 1; ?></td>
                                    <td class="col-md-3">
                                        <input name="award_nature[]" type="text" class="form-control input-md" value="<?= $award['nature'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-3">
                                        <input name="award_org[]" type="text" class="form-control input-md" value="<?= $award['organization'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="award_year[]" type="text" class="form-control input-md" value="<?= $award['year'] ?? '' ?>">
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



<!-- Sponsored Projects/Consultancy Details -->
<h4 style="text-align:center; font-weight: bold; color: #6739bb;">12. Sponsored Projects/Consultancy Details</h4>

<!-- (A) Sponsored Projects -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">(A) Sponsored Projects &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_s_proj">Add Details</button></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody id="s_proj">
                        <tr height="30px">
                            <th class="col-md-1">S. No.</th>
                            <th class="col-md-2">Sponsoring Agency</th>
                            <th class="col-md-2">Title of Project</th>
                            <th class="col-md-2">Sanctioned Amount (₹)</th>
                            <th class="col-md-1">Period</th>
                            <th class="col-md-2">Role</th>
                            <th class="col-md-2">Status</th>
                        </tr>
                        <?php if (!empty($s_proj)): ?>
                            <?php foreach ($s_proj as $index => $project): ?>
                                <tr height="60px">
                                    <td class="col-md-1"><?= $index + 1 ?></td>
                                    <td class="col-md-2">
                                        <input name="agency[]" type="text" class="form-control input-md" value="<?= $project['agency'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="stitle[]" type="text" class="form-control input-md" value="<?= $project['title'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="samount[]" type="text" class="form-control input-md" value="<?= $project['amount'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-1">
                                        <input name="speriod[]" type="text" class="form-control input-md" value="<?= $project['period'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="s_role[]" type="text" class="form-control input-md" value="<?= $project['role'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="s_status[]" type="text" class="form-control input-md" value="<?= $project['status'] ?? '' ?>">
                                        <button type="button" class="btn btn-light btn-sm" style="background-color: white; color: lightgray; font-size: 22px; margin-left: 5px;" onclick="removeRow(this)">x</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- (B) Consultancy Details -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">(B) Consultancy Projects &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_consultancy">Add Details</button></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody id="consultancy">
                        <tr height="30px">
                            <th class="col-md-1">S. No.</th>
                            <th class="col-md-3">Organization</th>
                            <th class="col-md-2">Title of Project</th>
                            <th class="col-md-2">Amount of Grant</th>
                            <th class="col-md-1">Period</th>
                            <th class="col-md-2">Role</th>
                            <th class="col-md-2">Status</th>
                        </tr>
                        <?php if (!empty($consultancy)): ?>
                            <?php foreach ($consultancy as $index => $project): ?>
                                <tr height="60px">
                                    <td class="col-md-1"><?= $index + 1 ?></td>
                                    <td class="col-md-3">
                                        <input name="c_org[]" type="text" class="form-control input-md" value="<?= $project['organization'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="ctitle[]" type="text" class="form-control input-md" value="<?= $project['title'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="camount[]" type="text" class="form-control input-md" value="<?= $project['amount'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-1">
                                        <input name="cperiod[]" type="text" class="form-control input-md" value="<?= $project['period'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="c_role[]" type="text" class="form-control input-md" value="<?= $project['role'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input name="c_status[]" type="text" class="form-control input-md" value="<?= $project['status'] ?? '' ?>">
                                        <button type="button" class="btn btn-light btn-sm" style="background-color: white; color: lightgray; font-size: 22px; margin-left: 5px;" onclick="removeRow(this)">x</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


            <div class="form-group">
              
              <div class="col-md-1">
                <a href="../pub_det/main.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
              </div>

              <div class="col-md-11">
                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE &amp; NEXT</button>
                
              </div>
              
            </div>


            </fieldset>
            </form>
            
            

        </div>
    </div>
</div>

<div id="footer"></div>



<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script></body></html>