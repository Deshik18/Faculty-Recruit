
<?php
include '../config.php';
session_start();

// Retrieve PhD Thesis Supervision data
$phdQuery = "SELECT phd_thesis FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($phdQuery);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$phdTheses = json_decode($result->fetch_assoc()['phd_thesis'], true);

// Retrieve M.Tech Thesis Supervision data
$mtechQuery = "SELECT mtech_thesis FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($mtechQuery);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$mtechTheses = json_decode($result->fetch_assoc()['mtech_thesis'], true);

// Retrieve B.Tech Thesis Supervision data
$btechQuery = "SELECT btech_thesis FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($btechQuery);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$btechTheses = json_decode($result->fetch_assoc()['btech_thesis'], true);
?>
<!-- saved from url=(0060)https://ofa.iiti.ac.in/facrec_che_2023_july_02/thesis_course -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Academic Experience </title>
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
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: &#39;Oswald&#39;, sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Patna</h3>
    			

        	</div>
        	

    	   
        </div>
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
   </div> 
			<h3 style="color: rgb(225, 4, 37); margin-bottom: 20px; font-weight: bold; text-align: center; font-family: &quot;Noto Serif&quot;, serif; opacity: 0.988634;" class="blink_me">Application for Faculty Position</h3>

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
var tr="";

var counter_thesis=1;
var counter_pg_thesis=1;
var counter_ug_thesis=1;

  $(document).ready(function(){
 
  $("#add_pg_thesis").click(function(){
          create_tr();
          create_serial('pg_thesis_sup');
          create_input('pg_scholar[]', 'Scholar','pg_scholar'+counter_pg_thesis, 'pg_thesis_sup',counter_pg_thesis, 'pg_thesis_sup');
          create_input('pg_thesis[]', 'Title of Thesis','pg_thesis'+counter_pg_thesis, 'pg_thesis_sup',counter_pg_thesis, 'pg_thesis_sup');
          create_input('pg_role[]', 'Role','pg_role'+counter_pg_thesis, 'pg_thesis_sup',counter_pg_thesis, 'pg_thesis_sup', false,true);
          create_input('pg_ths_status[]', 'Ongoing/Completed', 'pg_status'+counter_pg_thesis,'pg_thesis_sup',counter_pg_thesis, 'pg_thesis_sup');
          create_input('pg_ths_year[]', 'Ongoing Since/ Year of Completion', 'pg_ths_year'+counter_pg_thesis,'pg_thesis_sup',counter_pg_thesis, 'pg_thesis_sup',true);
          counter_pg_thesis++;
          return false;
    });

  $("#add_ug_thesis").click(function(){
          create_tr();
          create_serial('ug_thesis_sup');
          create_input('ug_scholar[]', 'Scholar','ug_scholar'+counter_ug_thesis, 'ug_thesis_sup',counter_ug_thesis, 'ug_thesis_sup');
          create_input('ug_thesis[]', 'Title of Thesis','ug_thesis'+counter_ug_thesis, 'ug_thesis_sup',counter_ug_thesis, 'ug_thesis_sup');
          create_input('ug_role[]', 'Role','ug_role'+counter_ug_thesis, 'ug_thesis_sup',counter_ug_thesis, 'ug_thesis_sup', false,true);
          create_input('ug_ths_status[]', 'Ongoing/Completed', 'ug_status'+counter_ug_thesis,'ug_thesis_sup',counter_ug_thesis, 'ug_thesis_sup');
          create_input('ug_ths_year[]', 'Ongoing Since/ Year of Completion', 'ug_ths_year'+counter_ug_thesis,'ug_thesis_sup',counter_ug_thesis, 'ug_thesis_sup',true);
          counter_ug_thesis++;
          return false;
    });

    $("#add_thesis").click(function(){
          create_tr();
          create_serial('thesis_sup');
          create_input('phd_scholar[]', 'Scholar','phd_scholar'+counter_thesis, 'thesis_sup',counter_thesis, 'thesis_sup');
          create_input('phd_thesis[]', 'Title of Thesis','phd_thesis'+counter_thesis, 'thesis_sup',counter_thesis, 'thesis_sup');
          create_input('phd_role[]', 'Role','phd_role'+counter_thesis, 'thesis_sup',counter_thesis, 'thesis_sup', false,true);
          create_input('phd_ths_status[]', 'Ongoing/Completed', 'phd_ths_status'+counter_thesis,'thesis_sup',counter_thesis, 'thesis_sup');
          create_input('phd_ths_year[]', 'Ongoing Since/ Year of Completion', 'phd_ths_year'+counter_thesis,'thesis_sup',counter_thesis, 'thesis_sup',true);
          counter_thesis++;
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
  function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, select=false, datepicker_set=false)
  {
    //console.log(counter);
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
    }
    if(select==true)
    {

      var sel=document.createElement("select");
      sel.setAttribute("name", t_name);
      sel.setAttribute("id", id);
      sel.setAttribute("class", "form-control input-md");
      sel.innerHTML+="<option>Select</option>";
      sel.innerHTML+="<option value='Supervisor with no Co-supervisor'>Supervisor with no Co-supervisor</option>";
      sel.innerHTML+="<option value='Supervisor with Co-supervisor'>Supervisor with Co-supervisor</option>";
      sel.innerHTML+="<option value='Co-Supervisor'>Co-Supervisor</option>";
      var td=document.createElement("td");
      td.appendChild(sel);
    }
    if(datepicker_set==true)
    {
      input=for_date_picker(input);
    }
    if(btn==true)
    {
      // alert();
      var but=document.createElement("button");
      but.setAttribute("class", "close");
      but.setAttribute("onclick", "remove_row('"+remove_name+"','"+counter+"', '"+tbody_id+"')");
      but.innerHTML="x";
      td.appendChild(but);
    }
    tr.setAttribute("id", "row" + tbody_id + counter);
        tr.appendChild(td);
        document.getElementById(tbody_id).appendChild(tr);
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    
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
                        <h4>Welcome : <font color="#025198"><strong>Marisol&nbsp;Mosciski</strong></font></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="../fac_login/main.html" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>

  
<!-- PHD Theses supervision -->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">13. Research Supervision:</h4>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">(phd_thesis) PhD Thesis Supervision  &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_thesis">Add Details</button></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody id="thesis_sup">

                        <tr height="30px">
                            <th class="col-md-1">S. No.</th>
                            <th class="col-md-3">Name of Student/Research Scholar</th>
                            <th class="col-md-2">Title of Thesis</th>
                            <th class="col-md-2">Role</th>
                            <th class="col-md-2">Ongoing/Completed</th>
                            <th class="col-md-2">Ongoing Since/Year of Completion</th>
                        </tr>

                        <?php if (!empty($phdTheses)) : ?>
                          <?php foreach ($phdTheses as $index => $record) : ?>
                              <tr height="60px">
                                  <td class="col-md-1"><?= $index + 1 ?></td>
                                  <td class="col-md-3">
                                      <input name="phd_scholar[]" type="text" class="form-control input-md" value="<?= $record['scholar'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="phd_thesis[]" type="text" class="form-control input-md" value="<?= $record['thesis'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="phd_role[]" type="text" class="form-control input-md" value="<?= $record['role'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="phd_ths_status[]" type="text" class="form-control input-md" value="<?= $record['status'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="phd_ths_year[]" type="text" class="form-control input-md" value="<?= $record['year'] ?? '' ?>">
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

<!-- Master Theses supervision -->

      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-success">
            <div class="panel-heading">(B). M.Tech/M.E./Master's Degree  &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_pg_thesis">Add Details</button></div>
              <div class="panel-body">

                    <table class="table table-bordered">
                        <tbody id="pg_thesis_sup">
                        
                        <tr height="30px">
                          <th class="col-md-1"> S. No.</th>
                          <th class="col-md-3"> Name of Student/Research Scholar </th>
                          <th class="col-md-2"> Title of Thesis</th>
                          <th class="col-md-2"> Role</th>
                          <th class="col-md-2"> Ongoing/Completed</th>
                          <th class="col-md-2"> Ongoing Since/ Year of Completion</th>
                          
                        </tr>
                        <?php if (!empty($mtechTheses)) : ?>
                          <?php foreach ($mtechTheses as $index => $record) : ?>
                              <tr height="60px">
                                  <td class="col-md-1"><?= $index + 1 ?></td>
                                  <td class="col-md-3">
                                      <input name="pg_scholar[]" type="text" class="form-control input-md" value="<?= $record['scholar'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="pg_thesis[]" type="text" class="form-control input-md" value="<?= $record['thesis'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="pg_role[]" type="text" class="form-control input-md" value="<?= $record['role'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="pg_ths_status[]" type="text" class="form-control input-md" value="<?= $record['status'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="pg_ths_year[]" type="text" class="form-control input-md" value="<?= $record['year'] ?? '' ?>">
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




<!-- Bachelor Theses supervision -->

      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-success">
            <div class="panel-heading">(C) B.Tech/B.E./Bachelor's Degree &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_ug_thesis">Add Details</button></div>
              <div class="panel-body">

                    <table class="table table-bordered">
                        <tbody id="ug_thesis_sup">
                        
                        <tr height="30px">
                          <th class="col-md-1"> S. No.</th>
                          <th class="col-md-3"> Name of Student </th>
                          <th class="col-md-2"> Title of Project</th>
                          <th class="col-md-2"> Role</th>
                          <th class="col-md-2"> Ongoing/Completed</th>
                          <th class="col-md-2"> Ongoing Since/ Year of Completion</th>
                          
                        </tr>
                        <?php if (!empty($btechTheses)) : ?>
                          <?php foreach ($btechTheses as $index => $record) : ?>
                              <tr height="60px">
                                  <td class="col-md-1"><?= $index + 1 ?></td>
                                  <td class="col-md-3">
                                      <input name="ug_scholar[]" type="text" class="form-control input-md" value="<?= $record['scholar'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="ug_thesis[]" type="text" class="form-control input-md" value="<?= $record['thesis'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="ug_role[]" type="text" class="form-control input-md" value="<?= $record['role'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="ug_ths_status[]" type="text" class="form-control input-md" value="<?= $record['status'] ?? '' ?>">
                                  </td>
                                  <td class="col-md-2">
                                      <input name="ug_ths_year[]" type="text" class="form-control input-md" value="<?= $record['year'] ?? '' ?>">
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
      <!-- Courses Taken -->

            <!-- Button -->

            <div class="form-group">
              
              <div class="col-md-1">
                <a href="../acad_ind_exp/main.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
              </div>

              <div class="col-md-11">
                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE &amp; NEXT</button>
                
              </div>
              
            </div>

            <!-- <div class="form-group">
              <label class="col-md-5 control-label" for="submit"></label>
              <div class="col-md-4">
                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-primary">SUBMIT</button>

              </div>
            </div> -->

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