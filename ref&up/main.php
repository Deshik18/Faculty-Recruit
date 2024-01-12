
<?php
include '../config.php';
include '../check_session.php';
?>
<!-- saved from url=(0066)https://ofa.iiti.ac.in/facrec_che_2023_july_02/submission_complete -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Referees &amp; Upload</title>
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


	
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
			<h3 style="color: rgb(225, 4, 37); margin-bottom: 20px; font-weight: bold; text-align: center; font-family: &quot;Noto Serif&quot;, serif; opacity: 0.870871;" class="blink_me">Application for Faculty Position</h3>


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
  /*padding: 10 !important;*/
  text-align: left!important;
  margin-top: -5px;
  font-family: 'Noto Serif', serif;
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

.panel-info .panel-heading{
  font-size: 1.1em;
  font-family: 'Oswald', sans-serif!important;
  padding-top: 5px;
  padding-bottom: 5px;
}

.panel-danger .panel-heading{
  font-size: 1.1em;
  font-family: 'Oswald', sans-serif!important;
  padding-top: 5px;
  padding-bottom: 5px;
}

.btn-primary {
  padding: 9px;
}

.Acae_data
{
  font-size: 1.1em;
  font-weight: bold;
  color: #414002;
}


.upload_crerti
{
  font-size: 1.1em;
  font-weight: bold;
  color: red;
  text-align: center;
}

.update_crerti
{
  font-size: 1.1em;
  font-weight: bold;
  color: green;
  text-align: center;
}
p
{
  padding-top: 10px;
}
</style>

<!-- all bootstrap buttons classes -->
<!-- 
  class="btn btn-sm, btn-lg, "
  color - btn-success, btn-primary, btn-default, btn-danger, btn-info, btn-warning
-->



<div class="container">
  
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 well">
            
              
            <fieldset>
             
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
       </fieldset>
       <?php
      function renderFileInputField($fieldName, $displayName, $uploadsDir, $fileFieldsMapping)
      {
          $filePath = $uploadsDir . $fileFieldsMapping[$fieldName];
          // Check if the file already exists
          if (file_exists($filePath)) {
              // File exists, display the filename and a link to view it
              echo "<p>Existing File: " . basename($filePath) . ' <a href="' . $filePath . '" target="_blank">View File</a></p>';
              echo "<input id=\"$fieldName\" name=\"$fieldName\" type=\"file\" class=\"form-control input-md\">";
          } else {
              // File doesn't exist, allow the user to upload
              echo "<input id=\"$fieldName\" name=\"$fieldName\" type=\"file\" class=\"form-control input-md\">";
          }
      }

      $selected_department = $_SESSION['dept'];
      $fname = $_SESSION['fname'];
      $lname = $_SESSION['lname'];
      $name_email_cat = strtoupper($fname . '_' . $lname . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
      $uploadsDir = '../' . $_SESSION['adv_num'] . '/' . $selected_department . '/' . $name_email_cat . '/';
      $fileFieldsMapping = [
          'userfile7' => 'Research_Paper.pdf',
          'userfile'  => 'PHD_Certificate.pdf',
          'userfile1' => 'PG_Certificate.pdf',
          'userfile2' => 'UG_Certificate.pdf',
          'userfile3' => '12th_HSC_Diploma.pdf',
          'userfile4' => '10th_SSC_Certificate.pdf',
          'userfile9' => 'Payslip.pdf',
          'userfile10' => 'NOC.pdf',
          'userfile8' => '10_Years_Post_PHD_Experience_Certificate.pdf',
          'userfile6' => 'Any_Other_Document.pdf',
          'userfile5' => 'Signature.jpg',
          // ... add other mappings for the rest of the fields
      ];
      ?>


<!-- publication file upload           -->
<form class="form-horizontal" action="process.php" method="post" enctype="multipart/form-data" onsubmit="return confirm_box();" id="upload_frm">
<!-- Reprints of 5 Best Research Papers Section -->
<h4 style="text-align:center; font-weight: bold; color: #6739bb;">20. Reprints of 5 Best Research Papers *</h4>
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-info">
            <div class="panel-heading">Upload 5 Best Research Papers in a single PDF &lt; 6MB 
               <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('full_5_paper')">View Uploaded File </a>
               <br><br>
            </div>
            <div class="panel-body">
               <div class="col-md-5">
                  <p class="update_crerti">Update 5 best papers</p>
               </div>
               <div class="col-md-7">
                  <!-- <input id="full_5_paper" name="userfile7" type="file" class="form-control input-md"> -->
                  <?php renderFileInputField('userfile7', 'Research_Paper.pdf', $uploadsDir, $fileFieldsMapping); ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Certificate file code start -->
   <h4 style="text-align:center; font-weight: bold; color: #6739bb;">21. Check List of the documents attached with the online application *</h4>
   <div class="row">
      <!-- ... Other document panels ... -->
      <div class="col-md-4">
         <div class="panel panel-info">
            <div class="panel-heading">PHD Certificate <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('phd')">View Uploaded File </a></div>
            <div class="panel-body">
               <p class="update_crerti">Update PHD Certificate</p>
               <!-- <input id="phd" name="userfile" type="file" class="form-control input-md"> -->
               <?php renderFileInputField('userfile', 'PHD_Certificate.pdf', $uploadsDir, $fileFieldsMapping); ?>
            </div>
         </div>
      </div>

<!-- PG Documents Section -->
<div class="col-md-4">
    <div class="panel panel-info">
        <div class="panel-heading">PG Documents <a href="javascript:void(0);" class="btn-sm btn-info" onclick="viewUploadedFile('post_gr', 'post_gr-preview')">View Uploaded File</a></div>
        <div class="panel-body">
            <p class="update_crerti">Update All semester/year-Marksheets and degree certificate</p>
            <!-- <input id="post_gr" name="userfile1" type="file" class="form-control input-md"> -->
            <?php renderFileInputField('userfile1', 'PG_Certificate.pdf', $uploadsDir, $fileFieldsMapping); ?>
        </div>
    </div>
</div>

<!-- UG Documents Section -->
<div class="col-md-4">
    <div class="panel panel-info">
        <div class="panel-heading">UG Documents <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('under_gr')">View Uploaded File</a></div>
        <div class="panel-body">
            <p class="update_crerti">Update All semester/year-Marksheets and degree certificate</p>
            <!-- <input id="under_gr" name="userfile2" type="file" class="form-control input-md"> -->
            <?php renderFileInputField('userfile2', 'UG_Certificate.pdf', $uploadsDir, $fileFieldsMapping); ?>
        </div>
    </div>
</div>

<!-- 12th certificate -->
<div class="col-md-4">
    <div class="panel panel-info">
        <div class="panel-heading">12th/HSC/Diploma Documents <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('higher_sec')">View Uploaded File</a></div>
        <div class="panel-body">
            <p class="update_crerti">Update 12th/HSC/Diploma/Marksheet(s) and passing certificate</p>
            <!-- <input id="higher_sec" name="userfile3" type="file" class="form-control input-md"> -->
            <?php renderFileInputField('userfile3', '12th_HSC_Diploma.pdf', $uploadsDir, $fileFieldsMapping); ?>
        </div>
    </div>
</div>

<!-- 10th certificate -->
<div class="col-md-4">
    <div class="panel panel-info">
        <div class="panel-heading">10th/SSC Documents <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('high_school')">View Uploaded File</a></div>
        <div class="panel-body">
            <p class="update_crerti">Update 10th/SSC/Marksheet(s) and passing certificate</p>
            <!-- <input id="high_school" name="userfile4" type="file" class="form-control input-md"> -->
            <?php renderFileInputField('userfile4', '10th_SSC_Certificate.pdf', $uploadsDir, $fileFieldsMapping); ?>
        </div>
    </div>
</div>

<!-- Pay Slip -->
<div class="col-md-4">
    <div class="panel panel-info">
        <div class="panel-heading">Pay Slip <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('pay_slip')">View Uploaded File</a></div>
        <div class="panel-body">
            <p class="update_crerti">Update Pay Slip</p>
            <!-- <input id="pay_slip" name="userfile9" type="file" class="form-control input-md"> -->
            <?php renderFileInputField('userfile9', 'Payslip.pdf', $uploadsDir, $fileFieldsMapping); ?>
        </div>
    </div>
</div>

<!-- Undertaking NOC -->
<div class="col-md-6">
    <div class="panel panel-info">
        <div class="panel-heading">NOC or Undertaking <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('noc_under')">View Uploaded File</a></div>
        <div class="panel-body">
            <p class="update_crerti">Undertaking-in case, NOC is not available at the time of application but will be provided at the time of the interview</p>
            <!-- <input id="noc_under" name="userfile10" type="file" class="form-control input-md"> -->
            <?php renderFileInputField('userfile10', 'NOC.pdf', $uploadsDir, $fileFieldsMapping); ?>
        </div>
    </div>
</div>

<!-- 10 years post phd exp certificate -->
<div class="col-md-5">
    <div class="panel panel-info">
        <div class="panel-heading">Post phd Experience Certificate/All Experience Certificates/ Last Pay slip/ <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('post_phd_10')">View Uploaded File</a></div>
        <div class="panel-body">
            <p class="update_crerti">Update Certificate</p>
            <!-- <input id="post_phd_10" name="userfile8" type="file" class="form-control input-md"> -->
            <?php renderFileInputField('userfile8', '10_Year_Post_PHD_Experience_Certificate.pdf', $uploadsDir, $fileFieldsMapping); ?>
        </div>
    </div>
</div>

<!-- Misc certificate -->
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">Upload any other relevant document in a single PDF (For example award certificate, experience certificate etc) &lt;1MB. <a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('misc_certi')">View Uploaded File</a></div>
        <div class="panel-body">
            <div class="col-md-5">
                <p class="update_crerti">Upload any other document</p>
            </div>
            <div class="col-md-7">
                <!-- <input id="misc_certi" name="userfile6" type="file" class="form-control input-md"> -->
                <?php renderFileInputField('userfile6', 'Any_Other_Document.pdf', $uploadsDir, $fileFieldsMapping); ?>
            </div>
        </div>
    </div>
</div>

<!-- Signature certificate -->
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-danger">
            <div class="panel-heading">Upload your Signature in JPG only<a href="#" class="btn-sm btn-info" onclick="viewUploadedFile('signature')">View Uploaded File</a></div>
            <div class="panel-body">
                <!-- <input id="signature" name="userfile5" type="file" class="form-control input-md"> -->
                <?php renderFileInputField('userfile5', 'Signature.*', $uploadsDir, $fileFieldsMapping); ?>
            </div>
            <p class="upload_crerti"></p>
        </div>
    </div>
    <div class="col-md-12">

    </div>
</div>



<h4 style="text-align:center; font-weight: bold; color: #6739bb;">22. Referees *</h4>

       <div class="row">
       <div class="col-md-12">
         <div class="panel panel-success">
         <div class="panel-heading">Fill the Details<button type="button" class="btn btn-success" onclick="addRow()">Add Referee</button></div>
           <div class="panel-body">
             <table class="table table-bordered">
                 <tbody id="acde">
                 
                 <tr height="30px">
                   <th class="col-md-2"> Name </th>
                   <th class="col-md-3"> Position </th>
                   <th class="col-md-3"> Association with Referee</th>
                   <th class="col-md-3"> Institution/Organization</th>
                   <th class="col-md-2"> E-mail </th>
                   <th class="col-md-2"> Contact No.</th>
                 </tr>
                 <?php
                 $referees = array(); // Initialize as empty arrays
                 $sql = "SELECT refrees FROM faculty_details WHERE email = ?";
                 $stmt = $conn->prepare($sql);
                 $stmt->bind_param("s", $_SESSION['email']);
                 $stmt->execute();
                 $stmt->bind_result($referees_json);
                 $stmt->fetch();
                 $stmt->close();
                 
                 $referees = json_decode($referees_json, true);
                        // Assuming $referees is an array containing referee details retrieved from the database
                        if (!empty($referees)) {
                            foreach ($referees as $index => $referee) {
                        ?>
                                <tr height="60px">
                                    <td class="col-md-2">
                                        <input id="name<?= $index + 1 ?>" name="name[]" type="text" placeholder="Name" class="form-control input-md" autofocus="" value="<?= $referee['name'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-3">
                                        <input id="position<?= $index + 1 ?>" name="position[]" type="text" placeholder="Position" class="form-control input-md" autofocus="" value="<?= $referee['position'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-3">
                                        <input id="association<?= $index + 1 ?>" name="association[]" type="text" placeholder="Association with Referee" class="form-control input-md" autofocus="" value="<?= $referee['association'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-3">
                                        <input id="institution<?= $index + 1 ?>" name="institution[]" type="text" placeholder="Institution/Organization" class="form-control input-md" autofocus="" value="<?= $referee['institution'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input id="email<?= $index + 1 ?>" name="email[]" type="text" placeholder="E-mail" class="form-control input-md" autofocus="" value="<?= $referee['email'] ?? '' ?>">
                                    </td>
                                    <td class="col-md-2">
                                        <input id="contact<?= $index + 1 ?>" name="contact[]" type="text" placeholder="Contact No." class="form-control input-md" autofocus="" value="<?= $referee['contact'] ?? '' ?>">
                                        <button type="button" class="btn btn-light btn-sm" style="background-color: white; color: lightgray; font-size: 22px;" onclick="removeRow(this)">x</button>
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
<!-- Referees Details -->


<input type="hidden" name="ci_csrf_token" value="">
    
 
<hr> 
<div class="form-group">
<div class="col-md-10">
  <a href="../rel_info/main.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
  

</div>

<div class="col-md-2">
  <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE &amp; NEXT</button>

</div>


</div>

</form>
</div> 
</div>
<script type="text/javascript">
function confirm_box()
{
  if(confirm("Dear Candidate, \n\nAre you sure that you are ready to submit the application? Press OK to submit the application. Press CANCEL to edit. \nOnce you press OK you cannot make any changes.\n\nThank you."))
  {
    return true;
  }
  else
  {
    return false;
  }
}
function submit_frm()
{
  alert();
  document.getElementById("upload_frm").submit();
}
</script>



<script type="text/javascript">
function addRow() {
            var newRow = `
                <tr>
                    <td><input type="text" class="form-control" name="referee_name[]"></td>
                    <td><input type="text" class="form-control" name="referee_position[]"></td>
                    <td><input type="text" class="form-control" name="referee_association[]"></td>
                    <td><input type="text" class="form-control" name="referee_institution[]"></td>
                    <td><input type="email" class="form-control" name="referee_email[]"></td>
                    <td><input type="tel" class="form-control" name="referee_contact[]"></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                </tr>
            `;

            $("#acde").append(newRow);
        }

        function removeRow(button) {
            $(button).closest("tr").remove();
        }
</script>

<script>
   function viewUploadedFile(fileId) {
      var inputElement = document.getElementById(fileId);
      var file = inputElement.files[0];

      if (file) {
         var fileUrl = URL.createObjectURL(file);
         window.open(fileUrl, '_blank');
      }
   }
</script>

<div id="footer"></div>



<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script></div></body></html>