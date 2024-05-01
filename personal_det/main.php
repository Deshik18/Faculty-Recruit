<!-- Add this PHP code at the top of your HTML page -->
<?php // Start the session (make sure this is at the top of your PHP file)
include '../config.php';
include '../check_session.php';
$fn_ln_cast = $application_details = $personal_details = $cadd_det = $padd_det = $contact_det = array();
$sql = "SELECT fn_ln_cast, application_details, per_det, cadd_det, padd_det, contact_det FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($fn_ln_cast_json, $app_details, $per_det, $c_det, $p_det, $cont_det);
$stmt->fetch();
$stmt->close();
// Decode JSON data
$fn_ln_cast = json_decode($fn_ln_cast_json, true);
$application_details = json_decode($app_details, true);
$personal_details = json_decode($per_det, true);
$cadd_det = json_decode($c_det, true);
$padd_det = json_decode($p_det, true);
$contact_det = json_decode($cont_det, true);
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
                    <!-- <a href="localhost/fac_recruit/personal_det/main.php#" class="btn btn-sm btn-info pull-right" onclick="get_username_from_session()" data-target="#passModal" data-toggle="modal">Change Password</a> -->
                    <a href="../fac_forgotpwd/main2.html" class="btn btn-sm btn-info pull-right">Change Password</a>
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
        <?php if(!isset($application_details['adv_num'])){ ?>
        <option value="">Select</option>
        <option <?php echo (isset($application_details['adv_num']) && $application_details['adv_num'] === 'IITP-FACREC-2023-NOV-02') ? 'selected="selected"' : ''; ?> value="IITP-FACREC-2023-NOV-02">IITP-FACREC-2023-NOV-02</option>
        <?php }else{ ?>
            <option value="<?php echo $application_details['adv_num']; ?>" readonly="readonly"><?php echo $application_details['adv_num']; ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Date of Application field -->
    <label class="col-md-2 control-label" for="doa">Date of Application </label>
    <div class="col-md-4">
      <input id="doa" name="doa" type="text" readonly="readonly" value="<?php echo isset($_SESSION['doa']) ? $_SESSION['doa'] : ''; ?>" placeholder="" class="form-control input-md" required="">
    </div>

    <!-- Application Number field -->
    <label class="col-md-2 control-label" for="ref_num">Application Number</label>
    <div class="col-md-4">
      <input id="ref_num" name="ref_num" type="text" readonly="readonly" value="<?php echo $fn_ln_cast['ref_num']; ?>" placeholder="" class="form-control input-md" required="">
    </div>

    <!-- Post Applied for field -->
    <label class="col-md-2 control-label" for="post">Post Applied for *</label>
    <div class="col-md-4">
        <select id="post" name="post" class="form-control input-md" required="">
            <?php if(!isset($application_details['post'])){ ?>
            <option value="">Select</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Professor') ? 'selected="selected"' : ''; ?> value="Professor">Professor</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Associate Professor') ? 'selected="selected"' : ''; ?> value="Associate Professor">Associate Professor</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Assistant Professor Grade I') ? 'selected="selected"' : ''; ?> value="Assistant Professor Grade I">Assistant Professor Grade I</option>
            <option <?php echo (isset($application_details['post']) && $application_details['post'] === 'Assistant Professor Grade II') ? 'selected="selected"' : ''; ?> value="Assistant Professor Grade II">Assistant Professor Grade II</option>
            <?php }else{ ?>
            <option value="<?php echo $application_details['post']; ?>" readonly="readonly"><?php echo $application_details['post']; ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- Department/School field -->
    <label class="col-md-2 control-label" for="dept">Department/School *</label>
    <div class="col-md-4">
        <select id="dept" name="dept" class="form-control input-md" required="">
            <?php if(!isset($application_details['dept'])){ ?>
            <option value="">Select</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Chemical Engineering') ? 'selected="selected"' : ''; ?> value="Chemical Engineering">Chemical Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Computer Science and Engineering') ? 'selected="selected"' : ''; ?> value="Computer Science and Engineering">Computer Science and Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Electrical Engineering') ? 'selected="selected"' : ''; ?> value="Electrical Engineering">Electrical Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Mechanical Engineering') ? 'selected="selected"' : ''; ?> value="Mechanical Engineering">Mechanical Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Civil Engineering') ? 'selected="selected"' : ''; ?> value="Civil Engineering">Civil Engineering</option>
            <option <?php echo (isset($application_details['dept']) && $application_details['dept'] === 'Metallurgical and Materials Engineering') ? 'selected="selected"' : ''; ?> value="Metallurgical and Materials Engineering">Metallurgical and Materials Engineering</option>
            <?php }else{ ?>
            <option value="<?php echo $application_details['dept']; ?>" readonly="readonly"><?php echo $application_details['dept']; ?></option>
            <?php } ?>
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
                            if (isset($application_details['adv_num']) && isset($application_details['dept']) && isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($application_details['post']) && isset($application_details['ref_num'])) {
                                $selected_department = strtoupper($application_details['dept']); // Convert department name to uppercase
                                $post = $application_details['post'];
                                $ref_num = $application_details['ref_num'];
                                $name_email_cat = strtoupper($_SESSION['first_name'] . '_' . $_SESSION['last_name'] . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
                                $photo_upload_dir = '../' . $application_details['adv_num'] . '/' . $selected_department . '/' . $post . '/' . $_SESSION['cast'] . '/' . $ref_num . '_' . $name_email_cat . '_supportingdocs/';
                                $id_proof_file_path = $photo_upload_dir . 'IDproof.*';

                                // Check if the ID proof file exists
                                $id_proof_files = glob($id_proof_file_path);
                                if (!empty($id_proof_files)) {
                                    $id_proof_file = $id_proof_files[0]; // Assuming there is only one ID proof file
                                    ?>

                                    <!-- Display existing ID proof with a link to view it -->
                                    <a href="<?php echo $id_proof_file; ?>" target="_blank">View ID Proof</a>

                                    <!-- Display the file name -->
                                    <?php echo pathinfo($id_proof_file)['basename']; ?>

                                    <!-- Set the value of the input field to the existing ID proof name -->
                                    <input id="id_card_file" name="userfile2" type="file" class="form-control input-md" value="<?php echo pathinfo($id_proof_file)['basename']; ?>" readonly="readonly">
                                <?php } else { ?>
                                    <!-- Allow the user to upload a new ID proof if not already uploaded -->
                                    <input id="id_card_file" name="userfile2" type="file" class="form-control input-md" required="">
                                <?php }
                            } else{ ?>
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
                  // Check if session message exists
                  if (isset($_SESSION['message'])) {
                      // Display session message in dark red
                      echo '<p style="color: darkred;">' . $_SESSION['message'] . '</p>';
                      // Unset the session message to prevent it from displaying again
                      unset($_SESSION['message']);
                  }
                  // Path to the uploaded profile photo
                  if (isset($application_details['adv_num']) && isset($application_details['dept']) && isset($_SESSION['first_name']) && isset($application_details['ref_num'])) {
                    $selected_department = strtoupper($application_details['dept']); // Convert department name to uppercase
                    $post = $application_details['post'];
                    $ref_num = $application_details['ref_num'];
                    $name_email_cat = strtoupper($_SESSION['first_name'] . '_' . $_SESSION['last_name'] . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
                    $photo_upload_dir = '../' . $application_details['adv_num'] . '/' . $selected_department . '/' . $post . '/' . $_SESSION['cast'] . '/' . $ref_num . '_' . $name_email_cat . '_supportingdocs/';
                    $profile_photo_path = $photo_upload_dir . 'Photo.*';

                    // Check if the ID proof file exists
                    $profile_photo_files = glob($profile_photo_path);
                    if (!empty($profile_photo_path)) {
                        $profile_photo_file = $profile_photo_files[0]; // Assuming there is only one ID proof file
                        ?>

                        <img src="<?php echo $profile_photo_file; ?>" alt="Profile Photo" height="150" width="130" class="thumbnail pull-right">

                        <input id="photo" name="userfile" type="file" class="form-control input-md" value="<?php echo $profile_photo_file; ?>" readonly="readonly">
                    <?php } else { ?>
                        <img class="thumbnail pull-right" height="150" width="130" />
                        <input id="photo" name="userfile" type="file" class="form-control input-md" required="">
                        <strong>Please upload your recent photo <font color="red">( <1 MB) in JPG | JPEG format</font> only.</strong>
                    <?php }
                } else{ ?>
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

            <!-- <textarea style="height:40px" placeholder="Country" class="form-control input-md" name="cadd3" maxlength="200" required=""><?php //echo isset($cadd_det['country']) ? $cadd_det['country'] : ''; ?></textarea> -->     
            <select id="country" name="cadd3" class="form-control">
                <option value="">Select Country</option>
                <option value="Afghanistan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Afghanistan" ? "selected" : ""; ?>>Afghanistan</option>
                <option value="Aland Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Aland Islands" ? "selected" : ""; ?>>Aland Islands</option>
                <option value="Albania" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Albania" ? "selected" : ""; ?>>Albania</option>
                <option value="Algeria" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Algeria" ? "selected" : ""; ?>>Algeria</option>
                <option value="American Samoa" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "American Samoa" ? "selected" : ""; ?>>American Samoa</option>
                <option value="Andorra" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Andorra" ? "selected" : ""; ?>>Andorra</option>
                <option value="Angola" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Angola" ? "selected" : ""; ?>>Angola</option>
                <option value="Anguilla" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Anguilla" ? "selected" : ""; ?>>Anguilla</option>
                <option value="Antarctica" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Antarctica" ? "selected" : ""; ?>>Antarctica</option>
                <option value="Antigua and Barbuda" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Antigua and Barbuda" ? "selected" : ""; ?>>Antigua and Barbuda</option>
                <option value="Argentina" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Argentina" ? "selected" : ""; ?>>Argentina</option>
                <option value="Armenia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Armenia" ? "selected" : ""; ?>>Armenia</option>
                <option value="Aruba" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Aruba" ? "selected" : ""; ?>>Aruba</option>
                <option value="Australia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Australia" ? "selected" : ""; ?>>Australia</option>
                <option value="Austria" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Austria" ? "selected" : ""; ?>>Austria</option>
                <option value="Azerbaijan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Azerbaijan" ? "selected" : ""; ?>>Azerbaijan</option>
                <option value="Bahamas" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bahamas" ? "selected" : ""; ?>>Bahamas</option>
                <option value="Bahrain" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bahrain" ? "selected" : ""; ?>>Bahrain</option>
                <option value="Bangladesh" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bangladesh" ? "selected" : ""; ?>>Bangladesh</option>
                <option value="Barbados" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Barbados" ? "selected" : ""; ?>>Barbados</option>
                <option value="Belarus" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Belarus" ? "selected" : ""; ?>>Belarus</option>
                <option value="Belgium" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Belgium" ? "selected" : ""; ?>>Belgium</option>
                <option value="Belize" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Belize" ? "selected" : ""; ?>>Belize</option>
                <option value="Benin" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Benin" ? "selected" : ""; ?>>Benin</option>
                <option value="Bermuda" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bermuda" ? "selected" : ""; ?>>Bermuda</option>
                <option value="Bhutan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bhutan" ? "selected" : ""; ?>>Bhutan</option>
                <option value="Bolivia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bolivia" ? "selected" : ""; ?>>Bolivia</option>
                <option value="Bosnia and Herzegovina" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bosnia and Herzegovina" ? "selected" : ""; ?>>Bosnia and Herzegovina</option>
                <option value="Botswana" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Botswana" ? "selected" : ""; ?>>Botswana</option>
                <option value="Bouvet Island" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bouvet Island" ? "selected" : ""; ?>>Bouvet Island</option>
                <option value="Brazil" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Brazil" ? "selected" : ""; ?>>Brazil</option>
                <option value="British Indian Ocean Territory" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "British Indian Ocean Territory" ? "selected" : ""; ?>>British Indian Ocean Territory</option>
                <option value="Brunei Darussalam" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Brunei Darussalam" ? "selected" : ""; ?>>Brunei Darussalam</option>
                <option value="Bulgaria" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Bulgaria" ? "selected" : ""; ?>>Bulgaria</option>
                <option value="Burkina Faso" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Burkina Faso" ? "selected" : ""; ?>>Burkina Faso</option>
                <option value="Burundi" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Burundi" ? "selected" : ""; ?>>Burundi</option>
                <option value="Cambodia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cambodia" ? "selected" : ""; ?>>Cambodia</option>
                <option value="Cameroon" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cameroon" ? "selected" : ""; ?>>Cameroon</option>
                <option value="Canada" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Canada" ? "selected" : ""; ?>>Canada</option>
                <option value="Cape Verde" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cape Verde" ? "selected" : ""; ?>>Cape Verde</option>
                <option value="Cayman Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cayman Islands" ? "selected" : ""; ?>>Cayman Islands</option>
                <option value="Central African Republic" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Central African Republic" ? "selected" : ""; ?>>Central African Republic</option>
                <option value="Chad" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Chad" ? "selected" : ""; ?>>Chad</option>
                <option value="Chile" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Chile" ? "selected" : ""; ?>>Chile</option>
                <option value="China" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "China" ? "selected" : ""; ?>>China</option>
                <option value="Christmas Island" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Christmas Island" ? "selected" : ""; ?>>Christmas Island</option>
                <option value="Cocos (Keeling) Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cocos (Keeling) Islands" ? "selected" : ""; ?>>Cocos (Keeling) Islands</option>
                <option value="Colombia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Colombia" ? "selected" : ""; ?>>Colombia</option>
                <option value="Comoros" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Comoros" ? "selected" : ""; ?>>Comoros</option>
                <option value="Congo" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Congo" ? "selected" : ""; ?>>Congo</option>
                <option value="Congo, The Democratic Republic of The" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Congo, The Democratic Republic of The" ? "selected" : ""; ?>>Congo, The Democratic Republic of The</option>
                <option value="Cook Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cook Islands" ? "selected" : ""; ?>>Cook Islands</option>
                <option value="Costa Rica" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Costa Rica" ? "selected" : ""; ?>>Costa Rica</option>
                <option value="Cote D'ivoire" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cote D'ivoire" ? "selected" : ""; ?>>Cote D'ivoire</option>
                <option value="Croatia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Croatia" ? "selected" : ""; ?>>Croatia</option>
                <option value="Cuba" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cuba" ? "selected" : ""; ?>>Cuba</option>
                <option value="Cyprus" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Cyprus" ? "selected" : ""; ?>>Cyprus</option>
                <option value="Czech Republic" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Czech Republic" ? "selected" : ""; ?>>Czech Republic</option>
                <option value="Denmark" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Denmark" ? "selected" : ""; ?>>Denmark</option>
                <option value="Djibouti" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Djibouti" ? "selected" : ""; ?>>Djibouti</option>
                <option value="Dominica" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Dominica" ? "selected" : ""; ?>>Dominica</option>
                <option value="Dominican Republic" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Dominican Republic" ? "selected" : ""; ?>>Dominican Republic</option>
                <option value="Ecuador" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Ecuador" ? "selected" : ""; ?>>Ecuador</option>
                <option value="Egypt" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Egypt" ? "selected" : ""; ?>>Egypt</option>
                <option value="El Salvador" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "El Salvador" ? "selected" : ""; ?>>El Salvador</option>
                <option value="Equatorial Guinea" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Equatorial Guinea" ? "selected" : ""; ?>>Equatorial Guinea</option>
                <option value="Eritrea" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Eritrea" ? "selected" : ""; ?>>Eritrea</option>
                <option value="Estonia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Estonia" ? "selected" : ""; ?>>Estonia</option>
                <option value="Ethiopia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Ethiopia" ? "selected" : ""; ?>>Ethiopia</option>
                <option value="Falkland Islands (Malvinas)" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Falkland Islands (Malvinas)" ? "selected" : ""; ?>>Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Faroe Islands" ? "selected" : ""; ?>>Faroe Islands</option>
                <option value="Fiji" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Fiji" ? "selected" : ""; ?>>Fiji</option>
                <option value="Finland" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Finland" ? "selected" : ""; ?>>Finland</option>
                <option value="France" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "France" ? "selected" : ""; ?>>France</option>
                <option value="French Guiana" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "French Guiana" ? "selected" : ""; ?>>French Guiana</option>
                <option value="French Polynesia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "French Polynesia" ? "selected" : ""; ?>>French Polynesia</option>
                <option value="French Southern Territories" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "French Southern Territories" ? "selected" : ""; ?>>French Southern Territories</option>
                <option value="Gabon" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Gabon" ? "selected" : ""; ?>>Gabon</option>
                <option value="Gambia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Gambia" ? "selected" : ""; ?>>Gambia</option>
                <option value="Georgia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Georgia" ? "selected" : ""; ?>>Georgia</option>
                <option value="Germany" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Germany" ? "selected" : ""; ?>>Germany</option>
                <option value="Ghana" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Ghana" ? "selected" : ""; ?>>Ghana</option>
                <option value="Gibraltar" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Gibraltar" ? "selected" : ""; ?>>Gibraltar</option>
                <option value="Greece" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Greece" ? "selected" : ""; ?>>Greece</option>
                <option value="Greenland" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Greenland" ? "selected" : ""; ?>>Greenland</option>
                <option value="Grenada" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Grenada" ? "selected" : ""; ?>>Grenada</option>
                <option value="Guadeloupe" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Guadeloupe" ? "selected" : ""; ?>>Guadeloupe</option>
                <option value="Guam" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Guam" ? "selected" : ""; ?>>Guam</option>
                <option value="Guatemala" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Guatemala" ? "selected" : ""; ?>>Guatemala</option>
                <option value="Guernsey" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Guernsey" ? "selected" : ""; ?>>Guernsey</option>
                <option value="Guinea" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Guinea" ? "selected" : ""; ?>>Guinea</option>
                <option value="Guinea-bissau" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Guinea-bissau" ? "selected" : ""; ?>>Guinea-bissau</option>
                <option value="Guyana" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Guyana" ? "selected" : ""; ?>>Guyana</option>
                <option value="Haiti" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Haiti" ? "selected" : ""; ?>>Haiti</option>
                <option value="Heard Island and Mcdonald Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Heard Island and Mcdonald Islands" ? "selected" : ""; ?>>Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Holy See (Vatican City State)" ? "selected" : ""; ?>>Holy See (Vatican City State)</option>
                <option value="Honduras" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Honduras" ? "selected" : ""; ?>>Honduras</option>
                <option value="Hong Kong" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Hong Kong" ? "selected" : ""; ?>>Hong Kong</option>
                <option value="Hungary" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Hungary" ? "selected" : ""; ?>>Hungary</option>
                <option value="Iceland" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Iceland" ? "selected" : ""; ?>>Iceland</option>
                <option value="India" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "India" ? "selected" : ""; ?>>India</option>
                <option value="Indonesia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Indonesia" ? "selected" : ""; ?>>Indonesia</option>
                <option value="Iran, Islamic Republic of" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Iran, Islamic Republic of" ? "selected" : ""; ?>>Iran, Islamic Republic of</option>
                <option value="Iraq" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Iraq" ? "selected" : ""; ?>>Iraq</option>
                <option value="Ireland" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Ireland" ? "selected" : ""; ?>>Ireland</option>
                <option value="Isle of Man" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Isle of Man" ? "selected" : ""; ?>>Isle of Man</option>
                <option value="Israel" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Israel" ? "selected" : ""; ?>>Israel</option>
                <option value="Italy" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Italy" ? "selected" : ""; ?>>Italy</option>
                <option value="Jamaica" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Jamaica" ? "selected" : ""; ?>>Jamaica</option>
                <option value="Japan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Japan" ? "selected" : ""; ?>>Japan</option>
                <option value="Jersey" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Jersey" ? "selected" : ""; ?>>Jersey</option>
                <option value="Jordan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Jordan" ? "selected" : ""; ?>>Jordan</option>
                <option value="Kazakhstan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Kazakhstan" ? "selected" : ""; ?>>Kazakhstan</option>
                <option value="Kenya" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Kenya" ? "selected" : ""; ?>>Kenya</option>
                <option value="Kiribati" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Kiribati" ? "selected" : ""; ?>>Kiribati</option>
                <option value="Korea, Democratic People's Republic of" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Korea, Democratic People's Republic of" ? "selected" : ""; ?>>Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Korea, Republic of" ? "selected" : ""; ?>>Korea, Republic of</option>
                <option value="Kuwait" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Kuwait" ? "selected" : ""; ?>>Kuwait</option>
                <option value="Kyrgyzstan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Kyrgyzstan" ? "selected" : ""; ?>>Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Lao People's Democratic Republic" ? "selected" : ""; ?>>Lao People's Democratic Republic</option>
                <option value="Latvia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Latvia" ? "selected" : ""; ?>>Latvia</option>
                <option value="Lebanon" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Lebanon" ? "selected" : ""; ?>>Lebanon</option>
                <option value="Lesotho" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Lesotho" ? "selected" : ""; ?>>Lesotho</option>
                <option value="Liberia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Liberia" ? "selected" : ""; ?>>Liberia</option>
                <option value="Libyan Arab Jamahiriya" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Libyan Arab Jamahiriya" ? "selected" : ""; ?>>Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Liechtenstein" ? "selected" : ""; ?>>Liechtenstein</option>
                <option value="Lithuania" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Lithuania" ? "selected" : ""; ?>>Lithuania</option>
                <option value="Luxembourg" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Luxembourg" ? "selected" : ""; ?>>Luxembourg</option>
                <option value="Macao" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Macao" ? "selected" : ""; ?>>Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Macedonia, The Former Yugoslav Republic of" ? "selected" : ""; ?>>Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Madagascar" ? "selected" : ""; ?>>Madagascar</option>
                <option value="Malawi" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Malawi" ? "selected" : ""; ?>>Malawi</option>
                <option value="Malaysia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Malaysia" ? "selected" : ""; ?>>Malaysia</option>
                <option value="Maldives" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Maldives" ? "selected" : ""; ?>>Maldives</option>
                <option value="Mali" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Mali" ? "selected" : ""; ?>>Mali</option>
                <option value="Malta" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Malta" ? "selected" : ""; ?>>Malta</option>
                <option value="Marshall Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Marshall Islands" ? "selected" : ""; ?>>Marshall Islands</option>
                <option value="Martinique" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Martinique" ? "selected" : ""; ?>>Martinique</option>
                <option value="Mauritania" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Mauritania" ? "selected" : ""; ?>>Mauritania</option>
                <option value="Mauritius" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Mauritius" ? "selected" : ""; ?>>Mauritius</option>
                <option value="Mayotte" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Mayotte" ? "selected" : ""; ?>>Mayotte</option>
                <option value="Mexico" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Mexico" ? "selected" : ""; ?>>Mexico</option>
                <option value="Micronesia, Federated States of" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Micronesia, Federated States of" ? "selected" : ""; ?>>Micronesia, Federated States of</option>
                <option value="Moldova, Republic of" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Moldova, Republic of" ? "selected" : ""; ?>>Moldova, Republic of</option>
                <option value="Monaco" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Monaco" ? "selected" : ""; ?>>Monaco</option>
                <option value="Mongolia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Mongolia" ? "selected" : ""; ?>>Mongolia</option>
                <option value="Montenegro" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Montenegro" ? "selected" : ""; ?>>Montenegro</option>
                <option value="Montserrat" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Montserrat" ? "selected" : ""; ?>>Montserrat</option>
                <option value="Morocco" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Morocco" ? "selected" : ""; ?>>Morocco</option>
                <option value="Mozambique" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Mozambique" ? "selected" : ""; ?>>Mozambique</option>
                <option value="Myanmar" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Myanmar" ? "selected" : ""; ?>>Myanmar</option>
                <option value="Namibia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Namibia" ? "selected" : ""; ?>>Namibia</option>
                <option value="Nauru" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Nauru" ? "selected" : ""; ?>>Nauru</option>
                <option value="Nepal" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Nepal" ? "selected" : ""; ?>>Nepal</option>
                <option value="Netherlands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Netherlands" ? "selected" : ""; ?>>Netherlands</option>
                <option value="Netherlands Antilles" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Netherlands Antilles" ? "selected" : ""; ?>>Netherlands Antilles</option>
                <option value="New Caledonia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "New Caledonia" ? "selected" : ""; ?>>New Caledonia</option>
                <option value="New Zealand" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "New Zealand" ? "selected" : ""; ?>>New Zealand</option>
                <option value="Nicaragua" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Nicaragua" ? "selected" : ""; ?>>Nicaragua</option>
                <option value="Niger" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Niger" ? "selected" : ""; ?>>Niger</option>
                <option value="Nigeria" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Nigeria" ? "selected" : ""; ?>>Nigeria</option>
                <option value="Niue" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Niue" ? "selected" : ""; ?>>Niue</option>
                <option value="Norfolk Island" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Norfolk Island" ? "selected" : ""; ?>>Norfolk Island</option>
                <option value="Northern Mariana Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Northern Mariana Islands" ? "selected" : ""; ?>>Northern Mariana Islands</option>
                <option value="Norway" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Norway" ? "selected" : ""; ?>>Norway</option>
                <option value="Oman" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Oman" ? "selected" : ""; ?>>Oman</option>
                <option value="Pakistan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Pakistan" ? "selected" : ""; ?>>Pakistan</option>
                <option value="Palau" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Palau" ? "selected" : ""; ?>>Palau</option>
                <option value="Palestinian Territory, Occupied" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Palestinian Territory, Occupied" ? "selected" : ""; ?>>Palestinian Territory, Occupied</option>
                <option value="Panama" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Panama" ? "selected" : ""; ?>>Panama</option>
                <option value="Papua New Guinea" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Papua New Guinea" ? "selected" : ""; ?>>Papua New Guinea</option>
                <option value="Paraguay" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Paraguay" ? "selected" : ""; ?>>Paraguay</option>
                <option value="Peru" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Peru" ? "selected" : ""; ?>>Peru</option>
                <option value="Philippines" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Philippines" ? "selected" : ""; ?>>Philippines</option>
                <option value="Pitcairn" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Pitcairn" ? "selected" : ""; ?>>Pitcairn</option>
                <option value="Poland" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Poland" ? "selected" : ""; ?>>Poland</option>
                <option value="Portugal" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Portugal" ? "selected" : ""; ?>>Portugal</option>
                <option value="Puerto Rico" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Puerto Rico" ? "selected" : ""; ?>>Puerto Rico</option>
                <option value="Qatar" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Qatar" ? "selected" : ""; ?>>Qatar</option>
                <option value="Reunion" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Reunion" ? "selected" : ""; ?>>Reunion</option>
                <option value="Romania" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Romania" ? "selected" : ""; ?>>Romania</option>
                <option value="Russian Federation" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Russian Federation" ? "selected" : ""; ?>>Russian Federation</option>
                <option value="Rwanda" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Rwanda" ? "selected" : ""; ?>>Rwanda</option>
                <option value="Saint Helena" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Saint Helena" ? "selected" : ""; ?>>Saint Helena</option>
                <option value="Saint Kitts and Nevis" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Saint Kitts and Nevis" ? "selected" : ""; ?>>Saint Kitts and Nevis</option>
                <option value="Saint Lucia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Saint Lucia" ? "selected" : ""; ?>>Saint Lucia</option>
                <option value="Saint Pierre and Miquelon" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Saint Pierre and Miquelon" ? "selected" : ""; ?>>Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Saint Vincent and The Grenadines" ? "selected" : ""; ?>>Saint Vincent and The Grenadines</option>
                <option value="Samoa" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Samoa" ? "selected" : ""; ?>>Samoa</option>
                <option value="San Marino" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "San Marino" ? "selected" : ""; ?>>San Marino</option>
                <option value="Sao Tome and Principe" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Sao Tome and Principe" ? "selected" : ""; ?>>Sao Tome and Principe</option>
                <option value="Saudi Arabia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Saudi Arabia" ? "selected" : ""; ?>>Saudi Arabia</option>
                <option value="Senegal" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Senegal" ? "selected" : ""; ?>>Senegal</option>
                <option value="Serbia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Serbia" ? "selected" : ""; ?>>Serbia</option>
                <option value="Seychelles" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Seychelles" ? "selected" : ""; ?>>Seychelles</option>
                <option value="Sierra Leone" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Sierra Leone" ? "selected" : ""; ?>>Sierra Leone</option>
                <option value="Singapore" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Singapore" ? "selected" : ""; ?>>Singapore</option>
                <option value="Slovakia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Slovakia" ? "selected" : ""; ?>>Slovakia</option>
                <option value="Slovenia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Slovenia" ? "selected" : ""; ?>>Slovenia</option>
                <option value="Solomon Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Solomon Islands" ? "selected" : ""; ?>>Solomon Islands</option>
                <option value="Somalia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Somalia" ? "selected" : ""; ?>>Somalia</option>
                <option value="South Africa" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "South Africa" ? "selected" : ""; ?>>South Africa</option>
                <option value="South Georgia and The South Sandwich Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "South Georgia and The South Sandwich Islands" ? "selected" : ""; ?>>South Georgia and The South Sandwich Islands</option>
                <option value="Spain" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Spain" ? "selected" : ""; ?>>Spain</option>
                <option value="Sri Lanka" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Sri Lanka" ? "selected" : ""; ?>>Sri Lanka</option>
                <option value="Sudan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Sudan" ? "selected" : ""; ?>>Sudan</option>
                <option value="Suriname" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Suriname" ? "selected" : ""; ?>>Suriname</option>
                <option value="Svalbard and Jan Mayen" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Svalbard and Jan Mayen" ? "selected" : ""; ?>>Svalbard and Jan Mayen</option>
                <option value="Swaziland" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Swaziland" ? "selected" : ""; ?>>Swaziland</option>
                <option value="Sweden" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Sweden" ? "selected" : ""; ?>>Sweden</option>
                <option value="Switzerland" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Switzerland" ? "selected" : ""; ?>>Switzerland</option>
                <option value="Syrian Arab Republic" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Syrian Arab Republic" ? "selected" : ""; ?>>Syrian Arab Republic</option>
                <option value="Taiwan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Taiwan" ? "selected" : ""; ?>>Taiwan</option>
                <option value="Tajikistan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Tajikistan" ? "selected" : ""; ?>>Tajikistan</option>
                <option value="Tanzania, United Republic of" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Tanzania, United Republic of" ? "selected" : ""; ?>>Tanzania, United Republic of</option>
                <option value="Thailand" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Thailand" ? "selected" : ""; ?>>Thailand</option>
                <option value="Timor-leste" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Timor-leste" ? "selected" : ""; ?>>Timor-leste</option>
                <option value="Togo" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Togo" ? "selected" : ""; ?>>Togo</option>
                <option value="Tokelau" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Tokelau" ? "selected" : ""; ?>>Tokelau</option>
                <option value="Tonga" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Tonga" ? "selected" : ""; ?>>Tonga</option>
                <option value="Trinidad and Tobago" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Trinidad and Tobago" ? "selected" : ""; ?>>Trinidad and Tobago</option>
                <option value="Tunisia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Tunisia" ? "selected" : ""; ?>>Tunisia</option>
                <option value="Turkey" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Turkey" ? "selected" : ""; ?>>Turkey</option>
                <option value="Turkmenistan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Turkmenistan" ? "selected" : ""; ?>>Turkmenistan</option>
                <option value="Turks and Caicos Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Turks and Caicos Islands" ? "selected" : ""; ?>>Turks and Caicos Islands</option>
                <option value="Tuvalu" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Tuvalu" ? "selected" : ""; ?>>Tuvalu</option>
                <option value="Uganda" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Uganda" ? "selected" : ""; ?>>Uganda</option>
                <option value="Ukraine" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Ukraine" ? "selected" : ""; ?>>Ukraine</option>
                <option value="United Arab Emirates" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "United Arab Emirates" ? "selected" : ""; ?>>United Arab Emirates</option>
                <option value="United Kingdom" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "United Kingdom" ? "selected" : ""; ?>>United Kingdom</option>
                <option value="United States" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "United States" ? "selected" : ""; ?>>United States</option>
                <option value="United States Minor Outlying Islands" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "United States Minor Outlying Islands" ? "selected" : ""; ?>>United States Minor Outlying Islands</option>
                <option value="Uruguay" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Uruguay" ? "selected" : ""; ?>>Uruguay</option>
                <option value="Uzbekistan" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Uzbekistan" ? "selected" : ""; ?>>Uzbekistan</option>
                <option value="Vanuatu" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Vanuatu" ? "selected" : ""; ?>>Vanuatu</option>
                <option value="Venezuela" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Venezuela" ? "selected" : ""; ?>>Venezuela</option>
                <option value="Viet Nam" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Viet Nam" ? "selected" : ""; ?>>Viet Nam</option>
                <option value="Virgin Islands, British" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Virgin Islands, British" ? "selected" : ""; ?>>Virgin Islands, British</option>
                <option value="Virgin Islands, U.S." <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Virgin Islands, U.S." ? "selected" : ""; ?>>Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Wallis and Futuna" ? "selected" : ""; ?>>Wallis and Futuna</option>
                <option value="Western Sahara" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Western Sahara" ? "selected" : ""; ?>>Western Sahara</option>
                <option value="Yemen" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Yemen" ? "selected" : ""; ?>>Yemen</option>
                <option value="Zambia" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Zambia" ? "selected" : ""; ?>>Zambia</option>
                <option value="Zimbabwe" <?php echo isset($cadd_det["country"]) && $cadd_det["country"] === "Zimbabwe" ? "selected" : ""; ?>>Zimbabwe</option>
            </select>    
            
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

            <!-- <textarea style="height:40" placeholder="Country" class="form-control input-md" name="padd3" maxlength="200" required=""><?php // echo isset($padd_det['country']) ? $padd_det['country'] : ''; ?></textarea> -->
            <select id="country" name="padd3" class="form-control">
                <option value="">Select Country</option>
                <option value="Afghanistan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Afghanistan" ? "selected" : ""; ?>>Afghanistan</option>
                <option value="Aland Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Aland Islands" ? "selected" : ""; ?>>Aland Islands</option>
                <option value="Albania" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Albania" ? "selected" : ""; ?>>Albania</option>
                <option value="Algeria" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Algeria" ? "selected" : ""; ?>>Algeria</option>
                <option value="American Samoa" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "American Samoa" ? "selected" : ""; ?>>American Samoa</option>
                <option value="Andorra" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Andorra" ? "selected" : ""; ?>>Andorra</option>
                <option value="Angola" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Angola" ? "selected" : ""; ?>>Angola</option>
                <option value="Anguilla" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Anguilla" ? "selected" : ""; ?>>Anguilla</option>
                <option value="Antarctica" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Antarctica" ? "selected" : ""; ?>>Antarctica</option>
                <option value="Antigua and Barbuda" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Antigua and Barbuda" ? "selected" : ""; ?>>Antigua and Barbuda</option>
                <option value="Argentina" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Argentina" ? "selected" : ""; ?>>Argentina</option>
                <option value="Armenia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Armenia" ? "selected" : ""; ?>>Armenia</option>
                <option value="Aruba" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Aruba" ? "selected" : ""; ?>>Aruba</option>
                <option value="Australia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Australia" ? "selected" : ""; ?>>Australia</option>
                <option value="Austria" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Austria" ? "selected" : ""; ?>>Austria</option>
                <option value="Azerbaijan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Azerbaijan" ? "selected" : ""; ?>>Azerbaijan</option>
                <option value="Bahamas" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bahamas" ? "selected" : ""; ?>>Bahamas</option>
                <option value="Bahrain" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bahrain" ? "selected" : ""; ?>>Bahrain</option>
                <option value="Bangladesh" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bangladesh" ? "selected" : ""; ?>>Bangladesh</option>
                <option value="Barbados" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Barbados" ? "selected" : ""; ?>>Barbados</option>
                <option value="Belarus" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Belarus" ? "selected" : ""; ?>>Belarus</option>
                <option value="Belgium" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Belgium" ? "selected" : ""; ?>>Belgium</option>
                <option value="Belize" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Belize" ? "selected" : ""; ?>>Belize</option>
                <option value="Benin" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Benin" ? "selected" : ""; ?>>Benin</option>
                <option value="Bermuda" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bermuda" ? "selected" : ""; ?>>Bermuda</option>
                <option value="Bhutan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bhutan" ? "selected" : ""; ?>>Bhutan</option>
                <option value="Bolivia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bolivia" ? "selected" : ""; ?>>Bolivia</option>
                <option value="Bosnia and Herzegovina" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bosnia and Herzegovina" ? "selected" : ""; ?>>Bosnia and Herzegovina</option>
                <option value="Botswana" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Botswana" ? "selected" : ""; ?>>Botswana</option>
                <option value="Bouvet Island" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bouvet Island" ? "selected" : ""; ?>>Bouvet Island</option>
                <option value="Brazil" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Brazil" ? "selected" : ""; ?>>Brazil</option>
                <option value="British Indian Ocean Territory" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "British Indian Ocean Territory" ? "selected" : ""; ?>>British Indian Ocean Territory</option>
                <option value="Brunei Darussalam" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Brunei Darussalam" ? "selected" : ""; ?>>Brunei Darussalam</option>
                <option value="Bulgaria" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Bulgaria" ? "selected" : ""; ?>>Bulgaria</option>
                <option value="Burkina Faso" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Burkina Faso" ? "selected" : ""; ?>>Burkina Faso</option>
                <option value="Burundi" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Burundi" ? "selected" : ""; ?>>Burundi</option>
                <option value="Cambodia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cambodia" ? "selected" : ""; ?>>Cambodia</option>
                <option value="Cameroon" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cameroon" ? "selected" : ""; ?>>Cameroon</option>
                <option value="Canada" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Canada" ? "selected" : ""; ?>>Canada</option>
                <option value="Cape Verde" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cape Verde" ? "selected" : ""; ?>>Cape Verde</option>
                <option value="Cayman Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cayman Islands" ? "selected" : ""; ?>>Cayman Islands</option>
                <option value="Central African Republic" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Central African Republic" ? "selected" : ""; ?>>Central African Republic</option>
                <option value="Chad" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Chad" ? "selected" : ""; ?>>Chad</option>
                <option value="Chile" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Chile" ? "selected" : ""; ?>>Chile</option>
                <option value="China" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "China" ? "selected" : ""; ?>>China</option>
                <option value="Christmas Island" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Christmas Island" ? "selected" : ""; ?>>Christmas Island</option>
                <option value="Cocos (Keeling) Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cocos (Keeling) Islands" ? "selected" : ""; ?>>Cocos (Keeling) Islands</option>
                <option value="Colombia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Colombia" ? "selected" : ""; ?>>Colombia</option>
                <option value="Comoros" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Comoros" ? "selected" : ""; ?>>Comoros</option>
                <option value="Congo" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Congo" ? "selected" : ""; ?>>Congo</option>
                <option value="Congo, The Democratic Republic of The" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Congo, The Democratic Republic of The" ? "selected" : ""; ?>>Congo, The Democratic Republic of The</option>
                <option value="Cook Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cook Islands" ? "selected" : ""; ?>>Cook Islands</option>
                <option value="Costa Rica" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Costa Rica" ? "selected" : ""; ?>>Costa Rica</option>
                <option value="Cote D'ivoire" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cote D'ivoire" ? "selected" : ""; ?>>Cote D'ivoire</option>
                <option value="Croatia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Croatia" ? "selected" : ""; ?>>Croatia</option>
                <option value="Cuba" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cuba" ? "selected" : ""; ?>>Cuba</option>
                <option value="Cyprus" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Cyprus" ? "selected" : ""; ?>>Cyprus</option>
                <option value="Czech Republic" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Czech Republic" ? "selected" : ""; ?>>Czech Republic</option>
                <option value="Denmark" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Denmark" ? "selected" : ""; ?>>Denmark</option>
                <option value="Djibouti" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Djibouti" ? "selected" : ""; ?>>Djibouti</option>
                <option value="Dominica" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Dominica" ? "selected" : ""; ?>>Dominica</option>
                <option value="Dominican Republic" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Dominican Republic" ? "selected" : ""; ?>>Dominican Republic</option>
                <option value="Ecuador" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Ecuador" ? "selected" : ""; ?>>Ecuador</option>
                <option value="Egypt" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Egypt" ? "selected" : ""; ?>>Egypt</option>
                <option value="El Salvador" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "El Salvador" ? "selected" : ""; ?>>El Salvador</option>
                <option value="Equatorial Guinea" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Equatorial Guinea" ? "selected" : ""; ?>>Equatorial Guinea</option>
                <option value="Eritrea" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Eritrea" ? "selected" : ""; ?>>Eritrea</option>
                <option value="Estonia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Estonia" ? "selected" : ""; ?>>Estonia</option>
                <option value="Ethiopia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Ethiopia" ? "selected" : ""; ?>>Ethiopia</option>
                <option value="Falkland Islands (Malvinas)" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Falkland Islands (Malvinas)" ? "selected" : ""; ?>>Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Faroe Islands" ? "selected" : ""; ?>>Faroe Islands</option>
                <option value="Fiji" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Fiji" ? "selected" : ""; ?>>Fiji</option>
                <option value="Finland" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Finland" ? "selected" : ""; ?>>Finland</option>
                <option value="France" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "France" ? "selected" : ""; ?>>France</option>
                <option value="French Guiana" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "French Guiana" ? "selected" : ""; ?>>French Guiana</option>
                <option value="French Polynesia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "French Polynesia" ? "selected" : ""; ?>>French Polynesia</option>
                <option value="French Southern Territories" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "French Southern Territories" ? "selected" : ""; ?>>French Southern Territories</option>
                <option value="Gabon" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Gabon" ? "selected" : ""; ?>>Gabon</option>
                <option value="Gambia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Gambia" ? "selected" : ""; ?>>Gambia</option>
                <option value="Georgia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Georgia" ? "selected" : ""; ?>>Georgia</option>
                <option value="Germany" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Germany" ? "selected" : ""; ?>>Germany</option>
                <option value="Ghana" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Ghana" ? "selected" : ""; ?>>Ghana</option>
                <option value="Gibraltar" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Gibraltar" ? "selected" : ""; ?>>Gibraltar</option>
                <option value="Greece" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Greece" ? "selected" : ""; ?>>Greece</option>
                <option value="Greenland" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Greenland" ? "selected" : ""; ?>>Greenland</option>
                <option value="Grenada" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Grenada" ? "selected" : ""; ?>>Grenada</option>
                <option value="Guadeloupe" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Guadeloupe" ? "selected" : ""; ?>>Guadeloupe</option>
                <option value="Guam" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Guam" ? "selected" : ""; ?>>Guam</option>
                <option value="Guatemala" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Guatemala" ? "selected" : ""; ?>>Guatemala</option>
                <option value="Guernsey" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Guernsey" ? "selected" : ""; ?>>Guernsey</option>
                <option value="Guinea" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Guinea" ? "selected" : ""; ?>>Guinea</option>
                <option value="Guinea-bissau" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Guinea-bissau" ? "selected" : ""; ?>>Guinea-bissau</option>
                <option value="Guyana" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Guyana" ? "selected" : ""; ?>>Guyana</option>
                <option value="Haiti" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Haiti" ? "selected" : ""; ?>>Haiti</option>
                <option value="Heard Island and Mcdonald Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Heard Island and Mcdonald Islands" ? "selected" : ""; ?>>Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Holy See (Vatican City State)" ? "selected" : ""; ?>>Holy See (Vatican City State)</option>
                <option value="Honduras" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Honduras" ? "selected" : ""; ?>>Honduras</option>
                <option value="Hong Kong" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Hong Kong" ? "selected" : ""; ?>>Hong Kong</option>
                <option value="Hungary" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Hungary" ? "selected" : ""; ?>>Hungary</option>
                <option value="Iceland" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Iceland" ? "selected" : ""; ?>>Iceland</option>
                <option value="India" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "India" ? "selected" : ""; ?>>India</option>
                <option value="Indonesia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Indonesia" ? "selected" : ""; ?>>Indonesia</option>
                <option value="Iran, Islamic Republic of" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Iran, Islamic Republic of" ? "selected" : ""; ?>>Iran, Islamic Republic of</option>
                <option value="Iraq" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Iraq" ? "selected" : ""; ?>>Iraq</option>
                <option value="Ireland" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Ireland" ? "selected" : ""; ?>>Ireland</option>
                <option value="Isle of Man" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Isle of Man" ? "selected" : ""; ?>>Isle of Man</option>
                <option value="Israel" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Israel" ? "selected" : ""; ?>>Israel</option>
                <option value="Italy" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Italy" ? "selected" : ""; ?>>Italy</option>
                <option value="Jamaica" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Jamaica" ? "selected" : ""; ?>>Jamaica</option>
                <option value="Japan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Japan" ? "selected" : ""; ?>>Japan</option>
                <option value="Jersey" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Jersey" ? "selected" : ""; ?>>Jersey</option>
                <option value="Jordan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Jordan" ? "selected" : ""; ?>>Jordan</option>
                <option value="Kazakhstan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Kazakhstan" ? "selected" : ""; ?>>Kazakhstan</option>
                <option value="Kenya" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Kenya" ? "selected" : ""; ?>>Kenya</option>
                <option value="Kiribati" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Kiribati" ? "selected" : ""; ?>>Kiribati</option>
                <option value="Korea, Democratic People's Republic of" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Korea, Democratic People's Republic of" ? "selected" : ""; ?>>Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Korea, Republic of" ? "selected" : ""; ?>>Korea, Republic of</option>
                <option value="Kuwait" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Kuwait" ? "selected" : ""; ?>>Kuwait</option>
                <option value="Kyrgyzstan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Kyrgyzstan" ? "selected" : ""; ?>>Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Lao People's Democratic Republic" ? "selected" : ""; ?>>Lao People's Democratic Republic</option>
                <option value="Latvia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Latvia" ? "selected" : ""; ?>>Latvia</option>
                <option value="Lebanon" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Lebanon" ? "selected" : ""; ?>>Lebanon</option>
                <option value="Lesotho" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Lesotho" ? "selected" : ""; ?>>Lesotho</option>
                <option value="Liberia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Liberia" ? "selected" : ""; ?>>Liberia</option>
                <option value="Libyan Arab Jamahiriya" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Libyan Arab Jamahiriya" ? "selected" : ""; ?>>Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Liechtenstein" ? "selected" : ""; ?>>Liechtenstein</option>
                <option value="Lithuania" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Lithuania" ? "selected" : ""; ?>>Lithuania</option>
                <option value="Luxembourg" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Luxembourg" ? "selected" : ""; ?>>Luxembourg</option>
                <option value="Macao" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Macao" ? "selected" : ""; ?>>Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Macedonia, The Former Yugoslav Republic of" ? "selected" : ""; ?>>Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Madagascar" ? "selected" : ""; ?>>Madagascar</option>
                <option value="Malawi" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Malawi" ? "selected" : ""; ?>>Malawi</option>
                <option value="Malaysia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Malaysia" ? "selected" : ""; ?>>Malaysia</option>
                <option value="Maldives" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Maldives" ? "selected" : ""; ?>>Maldives</option>
                <option value="Mali" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Mali" ? "selected" : ""; ?>>Mali</option>
                <option value="Malta" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Malta" ? "selected" : ""; ?>>Malta</option>
                <option value="Marshall Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Marshall Islands" ? "selected" : ""; ?>>Marshall Islands</option>
                <option value="Martinique" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Martinique" ? "selected" : ""; ?>>Martinique</option>
                <option value="Mauritania" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Mauritania" ? "selected" : ""; ?>>Mauritania</option>
                <option value="Mauritius" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Mauritius" ? "selected" : ""; ?>>Mauritius</option>
                <option value="Mayotte" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Mayotte" ? "selected" : ""; ?>>Mayotte</option>
                <option value="Mexico" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Mexico" ? "selected" : ""; ?>>Mexico</option>
                <option value="Micronesia, Federated States of" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Micronesia, Federated States of" ? "selected" : ""; ?>>Micronesia, Federated States of</option>
                <option value="Moldova, Republic of" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Moldova, Republic of" ? "selected" : ""; ?>>Moldova, Republic of</option>
                <option value="Monaco" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Monaco" ? "selected" : ""; ?>>Monaco</option>
                <option value="Mongolia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Mongolia" ? "selected" : ""; ?>>Mongolia</option>
                <option value="Montenegro" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Montenegro" ? "selected" : ""; ?>>Montenegro</option>
                <option value="Montserrat" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Montserrat" ? "selected" : ""; ?>>Montserrat</option>
                <option value="Morocco" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Morocco" ? "selected" : ""; ?>>Morocco</option>
                <option value="Mozambique" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Mozambique" ? "selected" : ""; ?>>Mozambique</option>
                <option value="Myanmar" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Myanmar" ? "selected" : ""; ?>>Myanmar</option>
                <option value="Namibia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Namibia" ? "selected" : ""; ?>>Namibia</option>
                <option value="Nauru" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Nauru" ? "selected" : ""; ?>>Nauru</option>
                <option value="Nepal" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Nepal" ? "selected" : ""; ?>>Nepal</option>
                <option value="Netherlands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Netherlands" ? "selected" : ""; ?>>Netherlands</option>
                <option value="Netherlands Antilles" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Netherlands Antilles" ? "selected" : ""; ?>>Netherlands Antilles</option>
                <option value="New Caledonia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "New Caledonia" ? "selected" : ""; ?>>New Caledonia</option>
                <option value="New Zealand" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "New Zealand" ? "selected" : ""; ?>>New Zealand</option>
                <option value="Nicaragua" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Nicaragua" ? "selected" : ""; ?>>Nicaragua</option>
                <option value="Niger" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Niger" ? "selected" : ""; ?>>Niger</option>
                <option value="Nigeria" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Nigeria" ? "selected" : ""; ?>>Nigeria</option>
                <option value="Niue" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Niue" ? "selected" : ""; ?>>Niue</option>
                <option value="Norfolk Island" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Norfolk Island" ? "selected" : ""; ?>>Norfolk Island</option>
                <option value="Northern Mariana Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Northern Mariana Islands" ? "selected" : ""; ?>>Northern Mariana Islands</option>
                <option value="Norway" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Norway" ? "selected" : ""; ?>>Norway</option>
                <option value="Oman" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Oman" ? "selected" : ""; ?>>Oman</option>
                <option value="Pakistan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Pakistan" ? "selected" : ""; ?>>Pakistan</option>
                <option value="Palau" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Palau" ? "selected" : ""; ?>>Palau</option>
                <option value="Palestinian Territory, Occupied" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Palestinian Territory, Occupied" ? "selected" : ""; ?>>Palestinian Territory, Occupied</option>
                <option value="Panama" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Panama" ? "selected" : ""; ?>>Panama</option>
                <option value="Papua New Guinea" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Papua New Guinea" ? "selected" : ""; ?>>Papua New Guinea</option>
                <option value="Paraguay" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Paraguay" ? "selected" : ""; ?>>Paraguay</option>
                <option value="Peru" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Peru" ? "selected" : ""; ?>>Peru</option>
                <option value="Philippines" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Philippines" ? "selected" : ""; ?>>Philippines</option>
                <option value="Pitcairn" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Pitcairn" ? "selected" : ""; ?>>Pitcairn</option>
                <option value="Poland" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Poland" ? "selected" : ""; ?>>Poland</option>
                <option value="Portugal" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Portugal" ? "selected" : ""; ?>>Portugal</option>
                <option value="Puerto Rico" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Puerto Rico" ? "selected" : ""; ?>>Puerto Rico</option>
                <option value="Qatar" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Qatar" ? "selected" : ""; ?>>Qatar</option>
                <option value="Reunion" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Reunion" ? "selected" : ""; ?>>Reunion</option>
                <option value="Romania" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Romania" ? "selected" : ""; ?>>Romania</option>
                <option value="Russian Federation" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Russian Federation" ? "selected" : ""; ?>>Russian Federation</option>
                <option value="Rwanda" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Rwanda" ? "selected" : ""; ?>>Rwanda</option>
                <option value="Saint Helena" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Saint Helena" ? "selected" : ""; ?>>Saint Helena</option>
                <option value="Saint Kitts and Nevis" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Saint Kitts and Nevis" ? "selected" : ""; ?>>Saint Kitts and Nevis</option>
                <option value="Saint Lucia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Saint Lucia" ? "selected" : ""; ?>>Saint Lucia</option>
                <option value="Saint Pierre and Miquelon" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Saint Pierre and Miquelon" ? "selected" : ""; ?>>Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Saint Vincent and The Grenadines" ? "selected" : ""; ?>>Saint Vincent and The Grenadines</option>
                <option value="Samoa" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Samoa" ? "selected" : ""; ?>>Samoa</option>
                <option value="San Marino" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "San Marino" ? "selected" : ""; ?>>San Marino</option>
                <option value="Sao Tome and Principe" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Sao Tome and Principe" ? "selected" : ""; ?>>Sao Tome and Principe</option>
                <option value="Saudi Arabia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Saudi Arabia" ? "selected" : ""; ?>>Saudi Arabia</option>
                <option value="Senegal" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Senegal" ? "selected" : ""; ?>>Senegal</option>
                <option value="Serbia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Serbia" ? "selected" : ""; ?>>Serbia</option>
                <option value="Seychelles" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Seychelles" ? "selected" : ""; ?>>Seychelles</option>
                <option value="Sierra Leone" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Sierra Leone" ? "selected" : ""; ?>>Sierra Leone</option>
                <option value="Singapore" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Singapore" ? "selected" : ""; ?>>Singapore</option>
                <option value="Slovakia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Slovakia" ? "selected" : ""; ?>>Slovakia</option>
                <option value="Slovenia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Slovenia" ? "selected" : ""; ?>>Slovenia</option>
                <option value="Solomon Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Solomon Islands" ? "selected" : ""; ?>>Solomon Islands</option>
                <option value="Somalia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Somalia" ? "selected" : ""; ?>>Somalia</option>
                <option value="South Africa" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "South Africa" ? "selected" : ""; ?>>South Africa</option>
                <option value="South Georgia and The South Sandwich Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "South Georgia and The South Sandwich Islands" ? "selected" : ""; ?>>South Georgia and The South Sandwich Islands</option>
                <option value="Spain" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Spain" ? "selected" : ""; ?>>Spain</option>
                <option value="Sri Lanka" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Sri Lanka" ? "selected" : ""; ?>>Sri Lanka</option>
                <option value="Sudan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Sudan" ? "selected" : ""; ?>>Sudan</option>
                <option value="Suriname" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Suriname" ? "selected" : ""; ?>>Suriname</option>
                <option value="Svalbard and Jan Mayen" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Svalbard and Jan Mayen" ? "selected" : ""; ?>>Svalbard and Jan Mayen</option>
                <option value="Swaziland" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Swaziland" ? "selected" : ""; ?>>Swaziland</option>
                <option value="Sweden" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Sweden" ? "selected" : ""; ?>>Sweden</option>
                <option value="Switzerland" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Switzerland" ? "selected" : ""; ?>>Switzerland</option>
                <option value="Syrian Arab Republic" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Syrian Arab Republic" ? "selected" : ""; ?>>Syrian Arab Republic</option>
                <option value="Taiwan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Taiwan" ? "selected" : ""; ?>>Taiwan</option>
                <option value="Tajikistan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Tajikistan" ? "selected" : ""; ?>>Tajikistan</option>
                <option value="Tanzania, United Republic of" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Tanzania, United Republic of" ? "selected" : ""; ?>>Tanzania, United Republic of</option>
                <option value="Thailand" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Thailand" ? "selected" : ""; ?>>Thailand</option>
                <option value="Timor-leste" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Timor-leste" ? "selected" : ""; ?>>Timor-leste</option>
                <option value="Togo" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Togo" ? "selected" : ""; ?>>Togo</option>
                <option value="Tokelau" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Tokelau" ? "selected" : ""; ?>>Tokelau</option>
                <option value="Tonga" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Tonga" ? "selected" : ""; ?>>Tonga</option>
                <option value="Trinidad and Tobago" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Trinidad and Tobago" ? "selected" : ""; ?>>Trinidad and Tobago</option>
                <option value="Tunisia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Tunisia" ? "selected" : ""; ?>>Tunisia</option>
                <option value="Turkey" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Turkey" ? "selected" : ""; ?>>Turkey</option>
                <option value="Turkmenistan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Turkmenistan" ? "selected" : ""; ?>>Turkmenistan</option>
                <option value="Turks and Caicos Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Turks and Caicos Islands" ? "selected" : ""; ?>>Turks and Caicos Islands</option>
                <option value="Tuvalu" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Tuvalu" ? "selected" : ""; ?>>Tuvalu</option>
                <option value="Uganda" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Uganda" ? "selected" : ""; ?>>Uganda</option>
                <option value="Ukraine" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Ukraine" ? "selected" : ""; ?>>Ukraine</option>
                <option value="United Arab Emirates" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "United Arab Emirates" ? "selected" : ""; ?>>United Arab Emirates</option>
                <option value="United Kingdom" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "United Kingdom" ? "selected" : ""; ?>>United Kingdom</option>
                <option value="United States" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "United States" ? "selected" : ""; ?>>United States</option>
                <option value="United States Minor Outlying Islands" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "United States Minor Outlying Islands" ? "selected" : ""; ?>>United States Minor Outlying Islands</option>
                <option value="Uruguay" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Uruguay" ? "selected" : ""; ?>>Uruguay</option>
                <option value="Uzbekistan" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Uzbekistan" ? "selected" : ""; ?>>Uzbekistan</option>
                <option value="Vanuatu" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Vanuatu" ? "selected" : ""; ?>>Vanuatu</option>
                <option value="Venezuela" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Venezuela" ? "selected" : ""; ?>>Venezuela</option>
                <option value="Viet Nam" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Viet Nam" ? "selected" : ""; ?>>Viet Nam</option>
                <option value="Virgin Islands, British" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Virgin Islands, British" ? "selected" : ""; ?>>Virgin Islands, British</option>
                <option value="Virgin Islands, U.S." <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Virgin Islands, U.S." ? "selected" : ""; ?>>Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Wallis and Futuna" ? "selected" : ""; ?>>Wallis and Futuna</option>
                <option value="Western Sahara" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Western Sahara" ? "selected" : ""; ?>>Western Sahara</option>
                <option value="Yemen" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Yemen" ? "selected" : ""; ?>>Yemen</option>
                <option value="Zambia" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Zambia" ? "selected" : ""; ?>>Zambia</option>
                <option value="Zimbabwe" <?php echo isset($padd_det["country"]) && $padd_det["country"] === "Zimbabwe" ? "selected" : ""; ?>>Zimbabwe</option>

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
                <form class="form-horizontal" method="post" action="edit.php">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="mobile">Mobile *</label>
                        <div class="col-md-4">
                            <input id="mobile" name="mobile" type="text" placeholder="Mobile" class="form-control input-md" required maxlength="20" value="<?php echo isset($contact_det['mobile']) ? $contact_det['mobile'] : ''; ?>">
                        </div>
                        <label class="col-md-2 control-label" for="email">Email</label>
                        <div class="col-md-4">
                            <input id="email" name="email" type="text" placeholder="email" readonly value="<?php echo $_SESSION['email']; ?>" class="form-control input-md" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="mobile_2">Alternate Mobile</label>
                        <div class="col-md-4">
                            <input id="mobile_2" name="mobile_2" type="text" placeholder="Alternate Mobile" class="form-control input-md" maxlength="20" value="<?php echo isset($contact_det['mobile_2']) ? $contact_det['mobile_2'] : ''; ?>">
                        </div>
                        <label class="col-md-2 control-label" for="email_2">Alternate Email</label>
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

                    <div class="form-group">
                        <div class="col-md-12">
                            <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
                            <span class="pull-right" style="margin-right: 20px;">Page 1/9</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="passModal" class="modal fade" role="dialog">
<form action="../fac_forgotpwd/main2.php" method="post">
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