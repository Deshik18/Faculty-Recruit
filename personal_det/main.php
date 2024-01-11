<!-- Add this PHP code at the top of your HTML page -->
<?php
session_start(); // Start the session (make sure this is at the top of your PHP file)
include '../config.php';
$application_details = $personal_details = $cadd_det = $contact_det = array();
$sql = "SELECT application_details, per_det, cadd_det, padd_det, contact_det FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($app_details, $per_det, $cadd_det, $padd_det, $contact_det);
$stmt->fetch();
$stmt->close();

// Decode JSON data
$application_details = json_decode($app_details, true);
$personal_details = json_decode($per_det, true);
$cadd_det = json_decode($cadd_det, true);
$padd_det = json_decode($padd_det, true);
$contact_det = json_decode($contact_det, true);
?>
<!-- saved from url=(0059)https://ofa.iiti.ac.in/facrec_che_2023_july_02/facultypanel -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Update your personal details</title>
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
        body { background-color: lightgray; padding-top:0px!important; }
    </style>
</head>

<body>
    <div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
        <div class="container">
            <div class="row" style="margin-bottom:10px; ">
                <div class="col-md-8 col-md-offset-2">
                    <h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: 'Oswald', sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Patna</h3>
                </div>
            </div>
        </div>
    </div>

    <h3 style="color: rgb(225, 4, 37); margin-bottom: 20px; font-weight: bold; text-align: center; font-family: 'Noto Serif', serif; opacity: 0.459205;" class="blink_me">Application for Faculty Position</h3>

    <style type="text/css">
        body { padding-top:30px; }
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
        .form-control { margin-bottom: 20px; }
        label{
            padding: 0 !important;
            text-align: left!important;
            font-family: 'Noto Serif', serif;
        }

        span{
            font-size: 1.2em;
            font-family: 'Oswald', sans-serif!important;
            text-align: left!important;
            padding: 0px 10px 0px 0px!important;
            font-weight: bold;
            color: #414002;
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

        .btn-primary{
            padding: 9px;
        }
    </style>

    <script type="text/javascript">
        function ageCalculator() {
            // Your age calculation logic here
        }
    </script>

    <script type="text/javascript">
        function updateAb(selected) {
            alert('hi');
        }
    </script>

    <script type="text/javascript">
        $(function () {
            $('#dob').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                onSelect: function(dateText, inst) {
                    updateAb(dateText);
                }
            });
        });
    </script>
</body>
</html>



<div class="container">

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 well">
    <form class="form-horizontal" action="process.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="ci_csrf_token" value="">
    <fieldset>
     
         <legend>

            <div class="row">
            <div class="col-md-8">
              <h4>Welcome: <font color="#025198"><strong><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></strong></font></h4>
                </div>
                <div class="col-md-3">
                    <a href="localhost/fac_recruit/personal_det/main.html#" class="btn btn-sm btn-info pull-right" onclick="get_username_from_session()" data-target="#passModal" data-toggle="modal">Change Password</a>
                </div>
            
                <div class="col-md-1">
                    <a href="../fac_login/main.html" class="btn btn-sm btn-success pull-right">Logout</a>
                </div>
            </div>
                             
</legend>   
     
<div id="project_show">
<div class="row">
  <div class="col-md-12">

    <!-- Advertisement Number field -->
    <label class="col-md-2 control-label" for="adv_num">Advertisement Number *</label>
    <div class="col-md-4">
      <select id="adv_num" name="adv_num" class="form-control input-md" required="">
        <option value="">Select</option>
        <option <?php echo (isset($application_details['adv_num']) && $application_details['adv_num'] === 'IITP/FACREC/2023/NOV/02') ? 'selected="selected"' : ''; ?> value="IITP/FACREC/2023/NOV/02">IITP/FACREC/2023/NOV/02</option>
      </select>
    </div>

    <!-- Date of Application field -->
    <label class="col-md-2 control-label" for="doa">Date of Application </label>
    <div class="col-md-4">
      <input id="doa" name="doa" type="text" readonly="readonly" value="<?php echo $_SESSION['doa']; ?>" placeholder="" class="form-control input-md" required="">
    </div>

    <!-- Application Number field -->
    <label class="col-md-2 control-label" for="ref_num">Application Number</label>
    <div class="col-md-4">
      <input id="ref_num" name="ref_num" type="text" readonly="readonly" value="1698404495" placeholder="" class="form-control input-md" required="">
    </div>

    <!-- Post Applied for field -->
    <label class="col-md-2 control-label" for="post">Post Applied for *</label>
    <div class="col-md-4">
        <select id="post" name="post" class="form-control input-md" required="">
            <option value="">Select</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Professor') ? 'selected="selected"' : ''; ?> value="Professor">Professor</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Associate Professor') ? 'selected="selected"' : ''; ?> value="Associate Professor">Associate Professor</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Assistant Professor Grade I') ? 'selected="selected"' : ''; ?> value="Assistant Professor Grade I">Assistant Professor Grade I</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Assistant Professor Grade II') ? 'selected="selected"' : ''; ?> value="Assistant Professor Grade II">Assistant Professor Grade II</option>
        </select>
    </div>

    <!-- Department/School field -->
    <label class="col-md-2 control-label" for="dept">Department/School *</label>
    <div class="col-md-4">
        <select id="dept" name="dept" class="form-control input-md" required="">
            <option value="">Select</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Chemical Engineering') ? 'selected="selected"' : ''; ?> value="Chemical Engineering">Chemical Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Computer Science and Engineering') ? 'selected="selected"' : ''; ?> value="Computer Science and Engineering">Computer Science and Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Electrical Engineering') ? 'selected="selected"' : ''; ?> value="Electrical Engineering">Electrical Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Mechanical Engineering') ? 'selected="selected"' : ''; ?> value="Mechanical Engineering">Mechanical Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Civil Engineering') ? 'selected="selected"' : ''; ?> value="Civil Engineering">Civil Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Metallurgical and Materials Engineering') ? 'selected="selected"' : ''; ?> value="Metallurgical and Materials Engineering">Metallurgical and Materials Engineering</option>
            <!-- Add similar lines for other options -->
        </select>
    </div>


    <!-- Form Name -->
    
      
    <!-- Text input-->
<!-- <h5><font color="#025198"><strong>1. Name:</strong></font></h5>             -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">1. Personal Details <small class="pull-right">Upload/Update Photo *</small></div>
            <div class="panel-body" style="height: 390px">
                <div class="col-md-10">
                    <div class="row">
                        <!-- First Name field -->
                        <span class="col-md-2 control-label" for="fname">First Name *</span>
                        <div class="col-md-4">
                            <input id="fname" value="<?php echo isset($personal_details['fname']) ? $personal_details['fname'] : ''; ?>" name="fname" type="text" placeholder="First name" class="form-control input-md" maxlength="15" required="">
                        </div>

                        <!-- Middle Name field -->
                        <span class="col-md-2 control-label" for="mname">Middle Name</span>
                        <div class="col-md-4">
                            <input id="mname" value="<?php echo isset($personal_details['mname']) ? $personal_details['mname'] : ''; ?>" name="mname" type="text" placeholder="Middle name" class="form-control input-md" maxlength="12">
                        </div>

                        <!-- Last Name field -->
                        <span class="col-md-2 control-label" for="lname">Last Name *</span>
                        <div class="col-md-4">
                            <input id="lname" value="<?php echo isset($personal_details['lname']) ? $personal_details['lname'] : ''; ?>" name="lname" type="text" placeholder="Last name" class="form-control input-md" maxlength="15" required="">
                        </div>

                        <!-- Nationality field -->
                        <span class="col-md-2 control-label" for="nationality">Nationality *</span>
                        <div class="col-md-4">
                            <select id="nationality" name="nationality" class="form-control input-md" required="">
                                <option value="">Select</option>
                                <option <?php echo (isset($personal_details['nationality']) && $personal_details['nationality'] === 'Indian') ? 'selected="selected"' : ''; ?> value="Indian">Indian</option>
                                <option <?php echo (isset($personal_details['nationality']) && $personal_details['nationality'] === 'OCI') ? 'selected="selected"' : ''; ?> value="OCI">OCI</option>
                            </select>
                        </div>

                        <!-- Date of Birth field -->
                        <span class="col-md-2 control-label" for="dob">Date of Birth DD/MM/YYYY *</span>
                        <div class="col-md-4">
                            <input id="dob" name="dob" value="<?php echo isset($personal_details['dob']) ? $personal_details['dob'] : ''; ?>" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" onfocusout="ageCalculator()">
                            <input type="hidden" name="Date" id="Date" value="31/08/2023" />
                        </div>

                        <!-- Gender field -->
                        <span class="col-md-2 control-label" for="gender">Gender *</span>
                        <div class="col-md-4">
                            <select id="gender" name="gender" class="form-control input-md" required="">
                                <option value="">Select</option>
                                <option <?php echo (isset($personal_details['gender']) && $personal_details['gender'] === 'Male') ? 'selected="selected"' : ''; ?> value="Male">Male</option>
                                <option <?php echo (isset($personal_details['gender']) && $personal_details['gender'] === 'Female') ? 'selected="selected"' : ''; ?> value="Female">Female</option>
                                <option <?php echo (isset($personal_details['gender']) && $personal_details['gender'] === 'Other') ? 'selected="selected"' : ''; ?> value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Marital Status field -->
                        <span class="col-md-2 control-label" for="mstatus">Marital Status *</span>
                        <div class="col-md-4">
                            <select id="mstatus" name="mstatus" class="form-control input-md" required="">
                                <option value="">Select</option>
                                <option <?php echo (isset($personal_details['mstatus']) && $personal_details['mstatus'] === 'Married') ? 'selected="selected"' : ''; ?> value="Married">Married</option>
                                <option <?php echo (isset($personal_details['mstatus']) && $personal_details['mstatus'] === 'Unmarried') ? 'selected="selected"' : ''; ?> value="Unmarried">Unmarried</option>
                                <option <?php echo (isset($personal_details['mstatus']) && $personal_details['mstatus'] === 'Other') ? 'selected="selected"' : ''; ?> value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Category field -->
                        <span class="col-md-2 control-label" for="cast">Category</span>
                        <div class="col-md-4">
                            <input id="cast" name="cast" type="text" placeholder="cast" readonly='readonly' value="<?php echo isset($_SESSION['cast']) ? $_SESSION['cast'] : ''; ?>" class="form-control input-md" required="">
                        </div>

                        <!-- ID Proof field -->
                        <span class="col-md-2 control-label" for="id_proof">ID Proof *</span>
                        <div class="col-md-4">
                            <select id="id_proof" name="id_proof" class="form-control input-md" required="">
                                <option value="">Select</option>
                                <option <?php echo (isset($personal_details['id_proof']) && $personal_details['id_proof'] === 'AADHAR') ? 'selected="selected"' : ''; ?> value="AADHAR">AADHAR</option>
                                <option <?php echo (isset($personal_details['id_proof']) && $personal_details['id_proof'] === 'PAN-CARD') ? 'selected="selected"' : ''; ?> value="PAN-CARD">PAN-CARD</option>
                                <option <?php echo (isset($personal_details['id_proof']) && $personal_details['id_proof'] === 'DRIVING-LICENSE') ? 'selected="selected"' : ''; ?> value="DRIVING-LICENSE">DRIVING-LICENSE</option>
                                <option <?php echo (isset($personal_details['id_proof']) && $personal_details['id_proof'] === 'VOTER ID') ? 'selected="selected"' : ''; ?> value="VOTER ID">VOTER ID</option>
                                <option <?php echo (isset($personal_details['id_proof']) && $personal_details['id_proof'] === 'PASSPORT') ? 'selected="selected"' : ''; ?> value="PASSPORT">PASSPORT</option>
                                <option <?php echo (isset($personal_details['id_proof']) && $personal_details['id_proof'] === 'RATION CARD') ? 'selected="selected"' : ''; ?> value="RATION CARD">RATION CARD</option>
                                <option <?php echo (isset($personal_details['id_proof']) && $personal_details['id_proof'] === 'OTHERS') ? 'selected="selected"' : ''; ?> value="OTHERS">OTHERS</option>
                            </select>
                        </div>

                        <!-- Upload ID Proof field 
                        <span class="col-md-2 control-label" for="id_card_file">Upload ID Proof *</span>
                        <div class="col-md-4">
                            <input id="id_card_file" name="userfile2" type="file" class="form-control input-md" required="">
                        </div> -->
                        <!-- Upload ID Proof field -->
                        <span class="col-md-2 control-label" for="id_card_file">Upload ID Proof</span>
                        <div class="col-md-4">
                            <?php
                             if (isset($application_details['adv_num']) && isset($application_details['dept']) && isset($personal_details['fname']) && isset($personal_details['lname'])) {
                              $adv_num = $application_details['adv_num'];
                              $selected_department = $application_details['dept']; // Corrected department access
                              $fname = $personal_details['fname'];
                              $lname = $personal_details['lname']; // Corrected typo in variable name
                              $name_email_cat = strtoupper($fname . '_' . $lname . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
                             }
                              $photo_upload_dir = '../' . $adv_num . '/' . $selected_department . '/' . $name_email_cat . '/';
                              $id_proof_file_path = $photo_upload_dir . 'IDproof.*';

                            // Check if the ID proof file exists
                            $id_proof_files = glob($id_proof_file_path);
                            if (!empty($id_proof_files)) {
                                $id_proof_file = $id_proof_files[0]; // Assuming there is only one ID proof file
                                ?>

                                <!-- Display existing ID proof with a link to view it -->
                                <a href="<?php echo $id_proof_file; ?>" target="_blank">View ID Proof</a>

                                <!-- Display the file name (optional) -->
                                <?php echo pathinfo($id_proof_file)['basename']; ?>

                                <!-- Set the value of the input field to the existing ID proof name -->
                                <input id="id_card_file" name="userfile2" type="file" class="form-control input-md" value="<?php echo pathinfo($id_proof_file)['basename']; ?>" required="" readonly="readonly">
                            <?php } else { ?>
                                <!-- Allow the user to upload a new ID proof if not already uploaded -->
                                <input id="id_card_file" name="userfile2" type="file" class="form-control input-md" required="">
                            <?php } ?>
                        </div>

                                </div>



                        <!-- Father's Name field -->
                        <span class="col-md-2 control-label" for="father_name">Father's Name *</span>
                        <div class="col-md-4">
                            <input id="father_name" value="<?php echo isset($personal_details['father_name']) ? $personal_details['father_name'] : ''; ?>" name="father_name" type="text" placeholder="Father's Name" class="form-control input-md" maxlength="30" required="">
                        </div>
                    </div>
                <!--
                <div class="col-md-2 pull-right">
                    <img class="thumbnail pull-right" height="150" width="130" />
                    <input id="photo" name="userfile" type="file" class="form-control input-md" required="">
                    <strong>Please upload your recent photo <font color="red">( <1 MB) in JPG | JPEG format</font> only.</strong>
                </div> -->
                <!-- Upload Profile Photo field -->
              <div class="col-md-2 pull-right">
                  <?php
                  // Path to the uploaded profile photo
                  $photo_upload_dir = '../' . $adv_num . '/' . $selected_department . '/' . $name_email_cat . '/';
                  $profile_photo_path = $photo_upload_dir . 'Photo.jpg';

                  // Check if the profile photo file exists
                  if (file_exists($profile_photo_path)) {
                      ?>
                      <!-- Display existing profile photo with a link to view it -->
                      <a href="<?php echo $profile_photo_path; ?>" target="_blank">View Profile Photo</a>

                      <!-- Display the file name (optional) -->
                      <?php echo pathinfo($profile_photo_path)['basename']; ?>

                      <!-- Set the value of the input field to the existing photo name -->
                      <input id="photo" name="userfile" type="file" class="form-control input-md" value="<?php echo 'Photo.jpg'; ?>" required="" readonly="readonly">
                  <?php } else { ?>
                      <!-- Allow the user to upload a new profile photo -->
                      <img class="thumbnail pull-right" height="150" width="130" />
                      <input id="photo" name="userfile" type="file" class="form-control input-md" required="">
                      <strong>Please upload your recent photo <font color="red">( <1 MB) in JPG | JPEG format</font> only.</strong>
                  <?php } ?>
              </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <!-- Correspondence Address -->
      <div class="panel-heading">2. Correspondence Address</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <span class="control-label" for="cadd">Correspondence Address </span>
            <br />
            <br />
            <textarea style="height:40px" placeholder="Street" class="form-control input-md" name="cadd" maxlength="200" required=""><?php echo isset($cadd_det['street']) ? $cadd_det['street'] : ''; ?></textarea>

            <textarea style="height:40px" placeholder="City" class="form-control input-md" name="cadd1" maxlength="200" required=""><?php echo isset($cadd_det['city']) ? $cadd_det['city'] : ''; ?></textarea>

            <textarea style="height:40px" placeholder="State" class="form-control input-md" name="cadd2" maxlength="200" required=""><?php echo isset($cadd_det['state']) ? $cadd_det['state'] : ''; ?></textarea>

            <textarea style="height:40px" placeholder="Country" class="form-control input-md" name="cadd3" maxlength="200" required=""><?php echo isset($cadd_det['country']) ? $cadd_det['country'] : ''; ?></textarea>

            <textarea style="height:40px" placeholder="PIN/ZIP" class="form-control input-md" name="cadd4" maxlength="6" required=""><?php echo isset($cadd_det['zip']) ? $cadd_det['zip'] : ''; ?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <!-- Permanent Address -->
      <div class="panel-heading">3. Permanent Address</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <span class="control-label" for="padd">Permanent Address </span>
            <br />
            <br />
            <textarea style="height:40px" placeholder="Street" class="form-control input-md" name="padd" maxlength="200" required=""><?php echo isset($padd_det['street']) ? $padd_det['street'] : ''; ?></textarea>

            <textarea style="height:40" placeholder="City" class="form-control input-md" name="padd1" maxlength="200" required=""><?php echo isset($padd_det['city']) ? $padd_det['city'] : ''; ?></textarea>

            <textarea style="height:40" placeholder="State" class="form-control input-md" name="padd2" maxlength="200" required=""><?php echo isset($padd_det['state']) ? $padd_det['state'] : ''; ?></textarea>

            <textarea style="height:40" placeholder="Country" class="form-control input-md" name="padd3" maxlength="200" required=""><?php echo isset($padd_det['country']) ? $padd_det['country'] : ''; ?></textarea>

            <textarea style="height:40;" placeholder="PIN/ZIP" class="form-control input-md" name="padd4" maxlength="6" required=""><?php echo isset($padd_det['zip']) ? $padd_det['zip'] : ''; ?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <!-- Contact Details -->
      <div class="panel-heading">4. Contact Details (with STD/ISD code)</div>
          <div class="panel-body">
        <div class="form-group">
            <label class="col-md-2 control-label" for="mobile">Mobile *</label>
            <div class="col-md-4">
                <input id="mobile" name="mobile" type="text" placeholder="Mobile" class="form-control input-md" required maxlength="20" value="<?php echo isset($contact_det['mobile']) ? $contact_det['mobile'] : ''; ?>">
            </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label" for="email">Email</label>
          <div class="col-md-4">
              <input id="email" name="email" type="text" placeholder="email" readonly value="<?php echo $_SESSION['email']; ?>" class="form-control input-md" required>
          </div>
      </div>


        <div class="form-group">
            <label class="col-md-2 control-label" for="mobile_2">Alternate Mobile </label>
            <div class="col-md-4">
                <input id="mobile_2" name="mobile_2" type="text" placeholder="Alternate Mobile" class="form-control input-md" maxlength="20" value="<?php echo isset($contact_det['mobile_2']) ? $contact_det['mobile_2'] : ''; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="email_2">Alternate Email </label>
            <div class="col-md-4">
                <input id="email_2" name="email_2" type="email" placeholder="Alternate Email" class="form-control input-md" value="<?php echo isset($contact_det['email_2']) ? $contact_det['email_2'] : ''; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="landline">Landline Number</label>
            <div class="col-md-4">
                <input id="landline" name="landline" type="text" placeholder="Landline Number" class="form-control input-md" maxlength="20" value="<?php echo isset($contact_det['landline']) ? $contact_det['landline'] : ''; ?>">
            </div>
        </div>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
  </div>
</div>


<!-- add the div for hide -->
</div>
</div>

</fieldset>
</form>


</div>
</div>


<div id="passModal" class="modal fade" role="dialog">
<form action="https://ofa.iiti.ac.in/facrec_che_2023_july_02/facultypanel/change_pass" method="post">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
      <h2>Change Password</h2>

  </div>
  <div class="modal-body">
      <h3>Change Password For : <font color="#3377a0"><strong id="username_mod"></strong></font></h3>
      <input type="hidden" name="fid" id="fid" value="" />
      <div class="form-group">
          <label>Current Password</label>
          <input type="password" name="cr_password" placeholder="Current Password" class="form-control"/>
      </div>
      <div class="form-group">
          <label>New Password</label>
          <input type="password" name="n_password" placeholder="New Password" class="form-control"/>
      </div>
      <div class="form-group">
          <label>Confirm New Password</label>
          <input type="password" name="cn_password" placeholder="New Confirm Password" class="form-control"/>
      </div>
  </div>
  <div class="modal-footer">
      <button type="submit" name="submit" value="Submit" class="btn btn-info" >Submit</button>
      <button class="btn btn-danger" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</form>
</div>


<script type="text/javascript">
$(document).ready(function(){

  var show_status = '';
  if(show_status==1){
    show1();
  }

});
function get_username(u, fid)
{
document.getElementById("username_mod").innerHTML=u;
// document.getElementById("fname").value=u;
document.getElementById("fid").value=fid;
}
// function form_submit(a, b)
// {
//     window.location="https://ofa.iiti.ac.in/facrec_che_2023_july_02/news/change/"+a+"/"+b;
// }
</script>


<script type="text/javascript">
 function show_none()
 {
 // alert("Hello! I am an alert box!!");
 document.getElementById('project_show').style.display ='none';
 }

 function show1()
 {
 // alert("Hello! I am an alert box!!");
 document.getElementById('project_show').style.display = 'block';
 }
</script>

<div id="footer"></div>
</body>
</html>

<script type="text/javascript">
  
  function blinker() {
      $('.blink_me').fadeOut(500);
      $('.blink_me').fadeIn(500);
  }

  setInterval(blinker, 1000);
</script>