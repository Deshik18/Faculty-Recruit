<?php
include 'config.php';
session_start();

if (!isset($_SESSION['adv_num']) || !isset($_SESSION['dept']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the email from the session
    $sessionEmail = $_SESSION['email'];

    // Fetch values from the database
    $sql = "SELECT application_details, per_det FROM faculty_details WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $sessionEmail);
        $stmt->execute();
        $stmt->bind_result($applicationDetails, $perDetails);

        if ($stmt->fetch()) {
            $detailsArray = json_decode($applicationDetails, true);

            // Update session variables
            $_SESSION['adv_num'] = $detailsArray['adv_num'];
            $_SESSION['dept'] = $detailsArray['dept'];

            $perDetailsArray = json_decode($perDetails, true);

            $_SESSION['fname'] = $perDetailsArray['fname'];
            $_SESSION['lname'] = $perDetailsArray['lname'];
        }

        $stmt->close();
    }
}

// Assuming $_SESSION['email'] contains the email of the faculty member
$email = $_SESSION['email'];

// Use a prepared statement to avoid SQL injection
$updateQuery = "UPDATE faculty_details SET submitted = '2' WHERE email = ?";
$stmtUpdate = $conn->prepare($updateQuery);
$stmtUpdate->bind_param("s", $email);

if ($stmtUpdate->execute()) {
    // Query executed successfully

    // Now, let's fetch the faculty details
    $selectQuery = "SELECT * FROM faculty_details WHERE email = ?";
    $stmtSelect = $conn->prepare($selectQuery);

    if ($stmtSelect) {
        $stmtSelect->bind_param("s", $email);
        $stmtSelect->execute();

        // Get the result
        $result = $stmtSelect->get_result();

        // Fetch data as an associative array
        $facultyDetails = $result->fetch_assoc();

        // Close the statement
        $stmtSelect->close();
    } else {
        // Handle the case where the statement preparation failed
        echo "Error in prepared statement: " . $conn->error;
    }
} else {
    // Query failed
    echo 'Error updating submitted status: ' . $stmtUpdate->error;
}

$stmtUpdate->close();
$conn->close();
?>

<!-- saved from url=(0076)https://ofa.iiti.ac.in/facrec_che_2023_july_02/finalpage/preview_application -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title></title>
	<style type="text/css">
	@page { margin:0.5in 0.5in 0.5in 0.5in; }

	    .receipt {
	        margin:0 auto 1in auto;
	        /*font-family:"verdana",monospace;*/
	        border:solid #000;
	        padding:0 0.25in;
	        width:10in;
	        min-height:2.5in;
	        height: auto;
	        /*page-break-inside:avoid;
	        page-break-before:auto;
	        page-break-after:auto;*/
	        /*word-wrap: break-word;*/
	    }
	    .receipt div, .receipt p, .receipt span {
	        /*page-break-before:avoid;
	        page-break-after:avoid;*/
	    }

	    .receipt div {
	        margin:0;
	        margin-bottom:0.1in;
	        padding:0;
	        /*word-wrap: break-word;*/
	    	/*background-color: green;*/


	    }

	    .receipt span {
	        display:inline-block;
	        line-height:2;
	    }

	    .receipt p, .receipt span {
	        margin:0; padding:0;


	    }

	    .title {
	        font-family:Arial,sans-serif;
	        font-size:1.5em;
	        color: #a40a0b;
	        font-weight:bold;
	        width:100%;
	    }

	    .label {
	        font-weight:bold;
	        color: #a40a0b;
	        background-color: #f1f1d1;
	        margin-bottom: 10px!important;
	        padding-left: 5px!important;
	        padding-right: 5px!important;
	        border-radius: 5px;
	        font-size: 1.1em;
	    }

	    .date, .payee, .phone, .signature {
	        border-bottom:solid thin #444;
	    }

	    .payee, .signature { width:2in; }

	    .phone, .date  { width:1.25in; }

	    .amount, .payer {
	        font-style:italic;
	        text-decoration:underline;
	    }
	    .tab{
	    	border-collapse: collapse;
	    	width: 100%;
	    	/*word-break: break-all;
	    	word-wrap: break-word;*/

	    	/*background-color: green;*/
	    	/*word-wrap: break-word!important;*/

	    	/*white-space: pre-line!important;*/
	    	/*overflow:auto!important;*/
	    }
	    .tab td{
	    	border:1px solid #CCC !important;
	    	padding-left: 10px;
	    	/*background-color:#DDFFFF;*/

	    	word-wrap: break-word!important;
	    	/*white-space: pre-line!important;*/
	    	/*overflow:auto!important;*/
	    	/*background-color: red;*/

	    }
	    .receipt_left{
	    	float: left;
	    	width:5.5in;
	    	/*word-wrap: break-word;*/
	    }
	    .receipt_right{
	    	float: right;
	    	width:1.5in;
	    	/*word-wrap: break-word;*/
	    }

	    .receipt_left1{
	    	float: left;
	    	width:4.5in;
	    	/*word-wrap: break-word;*/
	    }
	    .receipt_right1{
	    	float: right;
	    	width:4.5in;
	    	/*word-wrap: break-word;*/
	    }

	    .receipt_right img
	    {
	    	height: 1in;
	    	width: 0.8in;
	    	padding: 2px;
	    	border: 1px solid #CCC;
	    }

	    .receipt_center{
	    	/*float: left;*/
	    	width:auto;
	    	height: 120px;
	    	/*word-wrap: break-word;*/
	    }

		th
		{
			text-align: left;
		}

		.tr_title
		{
			color: #0a5398;
		}
	</style>
</head>
      
<body style="font-family:Arial,sans-serif;">
	
	<div class="receipt">
		<div class="receipt_center">
		<img src="IITIndorelogo.jpg" style="height: 85px; float: left;">
		<p style="text-align: center; font-size: 1.7em;">Indian Institute of Technology Patna</p>
		<p style="text-align: center; margin-top: 10px; background-color: #175395; line-height: 25px; color: #FFF; font-weight: bold;">Application for the Faculty Position</p>
		</div>
		<hr>
        <div class="title"></div>
<div class="receipt_left">
    <?php
    $application_details = json_decode($facultyDetails['application_details'], true) ?? [];
    ?>
    <p style="width:10in;">Advertisement Number : <?php echo $_SESSION['adv_num']; ?></p>
    <p>Date of Application : <?php echo $facultyDetails['doa'] ?? ''; ?></p>
    <p>Post Applied for : <?php echo $application_details['post'] ?? ''; ?></p>
    <p>Department : <?php echo $application_details['dept'] ?? ''; ?></p>
    <p>Application Number : <?php echo $application_details['ref_num'] ?? ''; ?></p>
</div>
<?php
$selectedDepartment = strtoupper($_SESSION['dept']);
$nameEmailCat = strtoupper($_SESSION['fname'] . '_' . $_SESSION['lname'] . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
$uploadsDir = $_SESSION['adv_num'] . '/' . $selectedDepartment . '/' . $nameEmailCat . '/';

$PhotoImagePath = $uploadsDir . 'Photo.jpg';
?>
<div class="receipt_right" style="margin-top: -30px;">
    <img src="<?php echo $PhotoImagePath;?>">
</div>
<div style="clear:both"></div>
<div>
    <span class="label">1. Personal Details</span>
    <table class="tab">
        <tbody>
            <tr style="background-color:#f1f1f1;">
                <td><strong class="tr_title">First Name</strong></td>
                <td><strong class="tr_title">Middle Name</strong></td>
                <td><strong class="tr_title">Last Name</strong></td>
            </tr>
            <?php
            $perDet = json_decode($facultyDetails['per_det'], true) ?? [];
            ?>
            <tr>
                <td><?php echo $perDet['fname'] ?? ''; ?></td>
                <td><?php echo $perDet['mname'] ?? ''; ?></td>
                <td><?php echo $perDet['lname'] ?? ''; ?></td>
            </tr>
        </tbody>
    </table>
    <br>

    <table class="tab">
        <tbody>
            <tr style="background-color:#f1f1f1;">
                <td><strong class="tr_title">Date of Birth</strong></td>
                <td><strong class="tr_title">Gender</strong></td>
                <td><strong class="tr_title">Marital Status</strong></td>
                <td><strong class="tr_title">Category</strong></td>
                <td><strong class="tr_title">Nationality</strong></td>
                <td><strong class="tr_title">ID Proof</strong></td>
            </tr>
            <tr>
                <td><?php echo $perDet['dob'] ?? ''; ?></td>
                <td><?php echo $perDet['gender'] ?? ''; ?></td>
                <td><?php echo $perDet['mstatus'] ?? ''; ?></td>
                <td><?php echo $perDet['cast'] ?? ''; ?></td>
                <td><?php echo $perDet['nationality'] ?? ''; ?></td>
                <td><?php echo $perDet['id_proof'] ?? ''; ?></td>
            </tr>
            <tr>
                <td><strong>Father's Name</strong></td>
                <td colspan="6"><?php echo $perDet['father_name'] ?? ''; ?></td>
            </tr>
        </tbody>
    </table>
    <br>

    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td width="50%"><strong class="tr_title">Current Address </strong></td>
            <td width="50%"><strong class="tr_title">Permanent Address </strong></td>
        </tr>

        <?php
        $caddDet = json_decode($facultyDetails['cadd_det'], true) ?? [];
        $paddDet = json_decode($facultyDetails['padd_det'], true) ?? [];
        $contact_det = json_decode($facultyDetails['contact_det'], true) ?? [];
        ?>
        <tr>
            <td><?php echo $caddDet['street'] ?? ''; ?></td>
            <td><?php echo $paddDet['street'] ?? ''; ?></td>
        </tr>
        <tr>
            <td><?php echo $caddDet['city'] ?? ''; ?></td>
            <td><?php echo $paddDet['city'] ?? ''; ?></td>
        </tr>
        <tr>
            <td><?php echo $caddDet['state'] ?? ''; ?></td>
            <td><?php echo $paddDet['state'] ?? ''; ?></td>
        </tr>
        <tr>
            <td><?php echo $caddDet['country'] ?? ''; ?></td>
            <td><?php echo $paddDet['country'] ?? ''; ?></td>
        </tr>
        <tr>
            <td><?php echo $caddDet['zip'] ?? ''; ?></td>
            <td><?php echo $paddDet['zip'] ?? ''; ?></td>
        </tr>
    </tbody>
    </table>
    <br>

    <span class="label"></span>
    <table class="tab">
    <tbody>
        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Mobile</strong></td>
            <td><?php echo $contact_det['mobile'] ?? ''; ?></td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Alternate Mobile</strong></td>
            <td><?php echo $contact_det['mobile_2'] ?? ''; ?></td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Landline Phone No.</strong></td>
            <td><?php echo $contact_det['landline'] ?? ''; ?></td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">E-mail</strong></td>
            <td><?php echo $email ?? ''; ?></td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Alternate E-mail</strong></td>
            <td><?php echo $contact_det['email_2'] ?? ''; ?></td>
        </tr>
    </tbody>
    </table>
    <br>



	<span class="label">2. Educational Qualifications</span>
	<table class="tab">
<?php
    $phd_details = json_decode($facultyDetails['phd_det'], true) ?? [];
  $pg_details = json_decode($facultyDetails['pg_det'], true) ?? [];
  $ug_details = json_decode($facultyDetails['ug_det'], true) ?? [];
  $sch_details = json_decode($facultyDetails['sch_det'], true) ?? [];
$additional_qualifications = json_decode($facultyDetails['additional_qualifications'], true) ?? [];
?>
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="6" class="tr_title"><strong>(A) Ph. D. Details</strong></td>
		</tr>
		
		<tr>
			<td width="30%"><strong>University/<br>Institute</strong></td>
			<td width="12%"><strong>Department</strong></td>
			<td width="17%"><strong>Name of Ph. D. <br>Supervisor</strong></td>
			<td width="10%"><strong>Year of <br>Joining</strong></td>
			<td width="15%"><strong>Date of <br>successful <br>thesis Defence</strong></td>
			<td width="15%"><strong>Date of <br>Award</strong></td>
		</tr>
		
		    <tr>
                <td><?php echo $phd_details['college'] ?? ''; ?></td>
                <td><?php echo $phd_details['stream'] ?? ''; ?></td>
                <td><?php echo $phd_details['supervisor'] ?? ''; ?></td>
                <td><?php echo $phd_details['yoj'] ?? ''; ?></td>
                <td><?php echo $phd_details['dod'] ?? ''; ?></td>
                <td><?php echo $phd_details['doa'] ?? ''; ?></td>
            </tr>

            <tr>
                <td><strong>Title of Ph. D. Thesis</strong></td>
                <td colspan="5"><?php echo $phd_details['title'] ?? ''; ?></td>
            </tr>
		
			</tbody></table>
	<br>

	<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(B) Academic Details - PG</strong></td>
        </tr>

        <tr>
            <td width="10%"><strong>Degree</strong></td>
            <td width="25%"><strong>University/<br>Institute</strong></td>
            <td width="20%"><strong>Subjects</strong></td>
            <td width="10%"><strong>Year of <br>Joining</strong></td>
            <td width="12%"><strong>Year of <br>Graduation</strong></td>
            <td width="10%"><strong>Duration <br>(in years)</strong></td>
            <td width="30%"><strong>Percentage/CGPA </strong></td>
            <td width="30%"><strong>Division/Class </strong></td>
        </tr>

        <tr>
            <td><?php echo $pg_details['degree'] ?? ''; ?></td>
            <td><?php echo $pg_details['college'] ?? ''; ?></td>
            <td><?php echo $pg_details['subjects'] ?? ''; ?></td>
            <td><?php echo $pg_details['yoj'] ?? ''; ?></td>
            <td><?php echo $pg_details['yog'] ?? ''; ?></td>
            <td><?php echo $pg_details['duration'] ?? ''; ?></td>
            <td><?php echo $pg_details['percentage'] ?? ''; ?></td>
            <td><?php echo $pg_details['rank'] ?? ''; ?></td>
        </tr>
    </tbody>
    </table>

	<br>

	<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(C) Academic Details - UG</strong></td>
        </tr>

        <tr>
            <td width="10%"><strong>Degree</strong></td>
            <td width="25%"><strong>University/<br>Institute</strong></td>
            <td width="20%"><strong>Subjects</strong></td>
            <td width="10%"><strong>Year of <br>Joining</strong></td>
            <td width="12%"><strong>Year of <br>Graduation</strong></td>
            <td width="10%"><strong>Duration <br>(in years)</strong></td>
            <td width="30%"><strong>Percentage/CGPA </strong></td>
            <td width="30%"><strong>Division/Class </strong></td>
        </tr>

        <tr>
            <td><?php echo $ug_details['degree'] ?? ''; ?></td>
            <td><?php echo $ug_details['college'] ?? ''; ?></td>
            <td><?php echo $ug_details['subjects'] ?? ''; ?></td>
            <td><?php echo $ug_details['yoj'] ?? ''; ?></td>
            <td><?php echo $ug_details['yog'] ?? ''; ?></td>
            <td><?php echo $ug_details['duration'] ?? ''; ?></td>
            <td><?php echo $ug_details['percentage'] ?? ''; ?></td>
            <td><?php echo $ug_details['rank'] ?? ''; ?></td>
        </tr>
    </tbody>
    </table>
    <br>

    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(D) Academic Details - School</strong></td>
        </tr>

        <tr>
            <td width="20%"><strong>10th/12th/HSC/Diploma</strong></td>
            <td width="20%"><strong>School</strong></td>
            <td width="15%"><strong>Year of Passing</strong></td>
            <td width="15%"><strong>Percentage/CGPA</strong></td>
            <td width="15%"><strong>Division/Class</strong></td>
        </tr>

            <tr>
                <td width="20%"><?php echo $sch_details['hsc_ssc'][0] ?? ''; ?></td>
                <td width="20%"><?php echo $sch_details['school'][0] ?? ''; ?></td>
                <td width="15%"><?php echo $sch_details['passing_year'][0] ?? ''; ?></td>
                <td width="15%"><?php echo $sch_details['percentage'][0] ?? ''; ?></td>
                <td width="15%"><?php echo $sch_details['rank'][0] ?? ''; ?></td>
            </tr>
            <tr>
                <td width="20%"><?php echo $sch_details['hsc_ssc'][1] ?? ''; ?></td>
                <td width="20%"><?php echo $sch_details['school'][1] ?? ''; ?></td>
                <td width="15%"><?php echo $sch_details['passing_year'][1] ?? ''; ?></td>
                <td width="15%"><?php echo $sch_details['percentage'][1] ?? ''; ?></td>
                <td width="15%"><?php echo $sch_details['rank'][1] ?? ''; ?></td>
            </tr>

    </tbody>
</table>


    </tbody>
</table>

    <br>

    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(E) Additional Educational Qualifications (If any)</strong></td>
        </tr>

        <tr>
            <td width="10%"><strong>Degree</strong></td>
            <td width="25%"><strong>University/<br>Institute</strong></td>
            <td width="20%"><strong>Subjects</strong></td>
            <td width="10%"><strong>Year of <br>Joining</strong></td>
            <td width="12%"><strong>Year of <br>Graduation</strong></td>
            <td width="10%"><strong>Duration <br>(in years)</strong></td>
            <td width="30%"><strong>Percentage/CGPA </strong></td>
            <td width="30%"><strong>Division/Class </strong></td>
        </tr>

        <?php foreach ($additional_qualifications as $qualification) : ?>
            <tr>
                <td><?php echo $qualification['degree'] ?? ''; ?></td>
                <td><?php echo $qualification['college'] ?? ''; ?></td>
                <td><?php echo $qualification['stream'] ?? ''; ?></td>
                <td><?php echo $qualification['yoj'] ?? ''; ?></td>
                <td><?php echo $qualification['yog'] ?? ''; ?></td>
                <td><?php echo $qualification['duration'] ?? ''; ?></td>
                <td><?php echo $qualification['percentage'] ?? ''; ?></td>
                <td><?php echo $qualification['division'] ?? ''; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

	<br>

	<span class="label">3. Employment Details </span>
    <?php
    $pres_emp_det = json_decode($facultyDetails['pres_emp_det'], true) ?? [];
    $emp_hist = json_decode($facultyDetails['his_det'], true) ?? [];
    $te_exp = json_decode($facultyDetails['teach_exp'], true) ?? [];
    $r_exp = json_decode($facultyDetails['r_det'], true) ?? [];
    $ind_exp = json_decode($facultyDetails['ind_det'], true) ?? [];
    $area_det = json_decode($facultyDetails['area_det'], true) ?? [];
    ?>

	<table class="tab">

		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="5" class="tr_title"><strong>(A) Present Employment</strong></td>
		</tr>
		

		<tr>
			<td width="20"><strong>Position </strong></td>
			<td width="30"><strong>Organization/Institution</strong></td>
			<td width="15"><strong>Date of <br>Joining</strong></td>
			<td width="15"><strong>Date of <br>Leaving </strong></td>
			<td width="15"><strong>Duration <br>(in years)</strong></td>
		</tr>
				<tr>
			<td><?php echo $pres_emp_det['position'] ?? ''; ?></td>
			<td><?php echo $pres_emp_det['employer'] ?? ''; ?></td>
			<td><?php echo $pres_emp_det['status'] ?? ''; ?></td>
			<td><?php echo $pres_emp_det['doj'] ?? ''; ?></td>
			<td><?php echo $pres_emp_det['dol'] ?? ''; ?></td>
		</tr>
			</tbody></table>
	<br>

	<span class="label"> </span>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="5" class="tr_title"><strong>(B) Employment History (After PhD )</strong></td>
        </tr>

        <tr>
            <td width="20"><strong>Position </strong></td>
            <td width="30"><strong>Organization/Institution</strong></td>
            <td width="15"><strong>Date of <br>Joining</strong></td>
            <td width="15"><strong>Date of <br>Leaving </strong></td>
            <td width="15"><strong>Duration <br>(in years)</strong></td>
        </tr>

        <?php if(!empty($emp_hist)){
            foreach ($emp_hist as $index => $qualification) { ?>
            <tr height="60px">
                <td><?php echo $qualification['position']; ?></td>
                <td><?php echo $qualification['org']; ?></td>
                <td><?php echo $qualification['doj']; ?></td>
                <td><?php echo $qualification['dol']; ?></td>
                <td><?php echo $qualification['duration']; ?></td>
            </tr>
        <?php }
        } ?>

        <tr>
            <td colspan="5"> <strong style="color:red;"></strong></td>
        </tr>
    </tbody>
</table>



					
	<!-- (C) Teaching Experience (After PhD) -->
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(C) Teaching Experience (After PhD)</strong></td>
        </tr>

        <tr>
            <!-- <td><strong>S. No.</strong></td> -->
            <td width="25%"><strong>Position</strong></td>
            <td width="30%"><strong>Employer</strong></td>
            <td width="30%"><strong>Course Taught</strong></td>
            <td width="30%"><strong>UG/PG</strong></td>
            <td width="30%"><strong>No. of Students</strong></td>
            <td width="10%"><strong>Date of <br>Joining</strong></td>
            <td width="10%"><strong>Date of <br>Leaving</strong></td>
            <td width="10%"><strong>Duration</strong></td>
        </tr>

        <?php if(!empty($te_exp)){
            foreach ($te_exp as $index => $experience) { ?>
            <tr height="60px">
                <td><?php echo $experience['position']; ?></td>
                <td><?php echo $experience['employer']; ?></td>
                <td><?php echo $experience['course']; ?></td>
                <td><?php echo $experience['ug_pg']; ?></td>
                <td><?php echo $experience['no_stu']; ?></td>
                <td><?php echo $experience['doj']; ?></td>
                <td><?php echo $experience['dol']; ?></td>
                <td><?php echo $experience['duration']; ?></td>
            </tr>
        <?php } 
        } ?>
    </tbody>
</table>
<br>


	<!-- (D) Research Experience -->
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1">
            <td colspan="6" class="tr_title"><strong>(D) Research Experience </strong></td>
        </tr>

        <tr>
            <td width="20%"><strong>Position</strong></td>
            <td width="20%"><strong>Institute</strong></td>
            <td width="20%"><strong>Supervisor</strong></td>
            <td width="10%"><strong>Date of <br>Joining</strong></td>
            <td width="10%"><strong>Date of <br>Leaving</strong></td>
            <td width="10%"><strong>Duration</strong></td>
        </tr>

        <?php if(!empty($r_exp)){
            foreach ($r_exp as $index => $experience) { ?>
            <tr height="60px">
                <td><?php echo $experience['position']; ?></td>
                <td><?php echo $experience['institute']; ?></td>
                <td><?php echo $experience['supervisor']; ?></td>
                <td><?php echo $experience['doj']; ?></td>
                <td><?php echo $experience['dol']; ?></td>
                <td><?php echo $experience['duration']; ?></td>
            </tr>
        <?php }
        } ?>
    </tbody>
</table>
<br>

<!-- (E) Industrial Experience -->
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1">
            <td colspan="5"><strong class="tr_title">(E) Industrial Experience </strong></td>
        </tr>

        <tr>
            <td width="20%"><strong>Organization</strong></td>
            <td width="20%"><strong>Work Profile</strong></td>
            <td width="10%"><strong>Date of <br>Joining</strong></td>
            <td width="10%"><strong>Date of <br>Leaving</strong></td>
            <td width="10%"><strong>Duration</strong></td>
        </tr>

        <?php if(!empty($ind_exp)){
            foreach ($ind_exp as $index => $experience) { ?>
            <tr height="60px">
                <td><?php echo $experience['org']; ?></td>
                <td><?php echo $experience['work']; ?></td>
                <td><?php echo $experience['doj']; ?></td>
                <td><?php echo $experience['dol']; ?></td>
                <td><?php echo $experience['period']; ?></td>
            </tr>
        <?php } 
        } ?>
    </tbody>
</table>
<br>


	<span class="label">4.  Area(s) of Specialization and Current Area(s) of Research</span>
	<table class="tab">
			<!-- <tr style="background-color:#f1f1f1"> 
				<td><strong class="tr_title">4. Area(s) of Specialization & Current Area(s) of Research</strong></td>
			</tr> -->
						<tbody><tr>
				<td width="25%" style="background-color: #f1f1f1;"><strong class="tr_title">Area(s) of Specialization</strong></td>
				<td><?php echo $area_det['area_spl'] ?? '';?></td>
			</tr>

			<tr>
				<td width="25%" style="background-color: #f1f1f1;"><strong class="tr_title">Current Area(s) of Research</strong></td>
				<td><?php echo $area_det['area_rese'] ?? '';?></td>
			</tr>

			
		</tbody></table>
		<br>
		

		<span class="label">5. Summary of Publications</span>
        <?php
        $patent = json_decode($facultyDetails['patent'], true);
        $sum_pub = json_decode($facultyDetails['sum_pub'], true);
        $best_pub = json_decode($facultyDetails['best_pub'], true);
        $book = json_decode($facultyDetails['book'], true);
        $chapter = json_decode($facultyDetails['chap'], true);
        ?>
		<table class="tab">
    <tbody>
        <tr>
            <td width="50%"><strong>Number of International Journal Papers </strong></td>
            <td><?php echo $sum_pub['summary_journal_inter'] ?? ''; ?></td>
        </tr>

        <tr>
            <td width="50%"><strong>Number of National Journal Papers </strong></td>
            <td><?php echo $sum_pub['summary_journal'] ?? ''; ?></td>
        </tr>

        <tr>
            <td><strong> Number of International Conference Papers </strong></td>
            <td><?php echo $sum_pub['summary_conf_inter'] ?? ''; ?></td>
        </tr>

        <tr>
            <td><strong> Number of National Conference Papers </strong></td>
            <td><?php echo $sum_pub['summary_conf_national'] ?? ''; ?></td>
        </tr>

			<tr>
				<td><strong> Number of Patent(s) </strong></td>
				<td><?php echo $sum_pub['patent_publish'] ?? '';?></td>
			</tr>

			<tr>
				<td><strong> Number of Book(s) </strong></td>
				<td><?php echo $sum_pub['summary_book'] ?? '';?></td>
			</tr>

			<tr>
				<td><strong>Number of Book Chapter(s) </strong></td>
				<td><?php echo $sum_pub['summary_book_chapter'] ?? '';?></td>
			</tr>
			
			
					</tbody></table>
		<br>


		<span class="label">6. List of 10 Best Research Publications (Journal/Conference)</span>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8"><strong class="tr_title">(A) Journals(s)</strong></td>
        </tr>
        <tr>
            <td width="5%"><strong>S. No.</strong></td>
            <td width="25%"><strong>Author(s) </strong></td>
            <td width="30%"><strong>Title</strong></td>
            <td width="25%"><strong>Name of Journal</strong></td>
            <td width="10%"><strong>Year, Vol., Page</strong></td>
            <td width="5%"><strong>Impact Factor</strong></td>
            <td width="1%"><strong>DOI</strong></td>
            <td width="5%"><strong>Status</strong></td>
        </tr>

        <?php
        // Assuming $best_pub is an array containing best publications
        if (!empty($best_pub['journal'])) {
            foreach ($best_pub['journal'] as $index => $publication) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $publication['authors'] ?? 'NULL'; ?></td>
                    <td><?php echo $publication['title'] ?? 'NULL'; ?></td>
                    <td><?php echo $publication['journal_name'] ?? 'NULL'; ?></td>
                    <td><?php echo $publication['year_vol_page'] ?? 'NULL'; ?></td>
                    <td><?php echo $publication['impact_factor'] ?? 'NULL'; ?></td>
                    <td><?php echo $publication['doi'] ?? 'NULL'; ?></td>
                    <td><?php echo $publication['status'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>


		<span class="label">7. List of Patent(s), Book(s), Book Chapter(s)</span>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8"><strong class="tr_title">(A) Patent(s)</strong></td>
        </tr>
        <tr>
            <td width="5%"><strong>S. No.</strong></td>
            <td width="20%"><strong>Inventor(s) </strong></td>
            <td width="20%"><strong>Title of Patent</strong></td>
            <td width="15%"><strong>Country of<br> Patent</strong></td>
            <td width="10%"><strong>Patent <br>Number</strong></td>
            <td width="10%"><strong>Date of <br>Filing</strong></td>
            <td width="10%"><strong>Date of <br>Published</strong></td>
            <td width="10%"><strong>Status<br>Filed/Published</strong></td>
        </tr>

        <?php
        if (!empty($patent)) {
            foreach ($patent as $index => $patentDetails) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $patentDetails['inventor'] ?? 'NULL'; ?></td>
                    <td><?php echo $patentDetails['title'] ?? 'NULL'; ?></td>
                    <td><?php echo $patentDetails['country'] ?? 'NULL'; ?></td>
                    <td><?php echo $patentDetails['number'] ?? 'NULL'; ?></td>
                    <td><?php echo $patentDetails['year_filed'] ?? 'NULL'; ?></td>
                    <td><?php echo $patentDetails['year_published'] ?? 'NULL'; ?></td>
                    <td><?php echo $patentDetails['year_issued'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>
	

<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="5"><strong class="tr_title">(B) Book(s)</strong></td>
        </tr>
        <tr>
            <td width="5%"><strong>S. No.</strong></td>
            <td width="30%"><strong>Author(s) </strong></td>
            <td width="40%"><strong>Title of the Book</strong></td>
            <td width="20%"><strong>Year of Publication</strong></td>
            <td width="10%"><strong>ISBN</strong></td>
        </tr>

        <?php
        if (!empty($book)) {
            foreach ($book as $index => $bookDetails) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $bookDetails['bauthor'] ?? 'NULL'; ?></td>
                    <td><?php echo $bookDetails['btitle'] ?? 'NULL'; ?></td>
                    <td><?php echo $bookDetails['byear'] ?? 'NULL'; ?></td>
                    <td><?php echo $bookDetails['bisbn'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>


<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="5"><strong class="tr_title">(C) Book Chapter(s)</strong></td>
        </tr>
        <tr>
            <td width="5%"><strong>S. No.</strong></td>
            <td width="30%"><strong>Author(s) </strong></td>
            <td width="40%"><strong>Title of the Book Chapter</strong></td>
            <td width="20%"><strong>Year of Publication</strong></td>
            <td width="10%"><strong>ISBN</strong></td>
        </tr>

        <?php
        if (!empty($chapter)) {
            foreach ($chapter as $index => $chapterDetails) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $chapterDetails['author'] ?? 'NULL'; ?></td>
                    <td><?php echo $chapterDetails['title'] ?? 'NULL'; ?></td>
                    <td><?php echo $chapterDetails['year'] ?? 'NULL'; ?></td>
                    <td><?php echo $chapterDetails['isbn'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>


	<span class="label">8. Google Scholar Link </span>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="6"><strong class="tr_title">URL</strong></td>
		</tr>
		<tr>
			<td width="12%"><?php echo $facultyDetails['scholar_link'] ?? ' ';?></td>
		</tr>
		
	</tbody></table>
	<br>

	<span class="label">9. Membership of Professional Societies </span>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="3"><strong class="tr_title">Details</strong></td>
		</tr>
		
		<tr>
			<td width="3%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Name of the Professional Society</strong></td>
			<td width="20%"><strong>Membership Status (Lifetime/Annual)</strong></td>
		</tr>
        
        <?php
        $membership_societies = json_decode($facultyDetails['membership'], true) ?? [];
        if (!empty($membership_societies)) {
            foreach ($membership_societies as $index => $membership) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $membership['name'] ?? ''; ?></td>
                    <td><?php echo $membership['status'] ?? ''; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>

<span class="label">10. Professional Training </span>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="5"><strong class="tr_title">Details</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Type of Training Received</strong></td>
			<td width="20%"><strong>Organisation</strong></td>
			<td width="10%"><strong>Year</strong></td>
			<td width="10%"><strong>Duration</strong></td>
		</tr>
        <?php
        $membership_societies = json_decode($facultyDetails['prof_trg'], true) ?? [];
        if (!empty($membership_societies)) {
            foreach ($membership_societies as $index => $training) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $training['name'] ?? 'NULL'; ?></td>
                    <td><?php echo $training['organization'] ?? 'NULL'; ?></td>
                    <td><?php echo $training['year'] ?? 'NULL'; ?></td>
                    <td><?php echo $training['duration'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
			</tbody></table>
	<br>

	
	<span class="label">11. Award(s) and Recognition(s) </span>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="4"><strong class="tr_title">Details</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Name of Award</strong></td>
			<td width="20%"><strong>Awarded By</strong></td>
			<td width="10%"><strong>Year</strong></td>
		</tr>
        <?php
        $awards_recognition = json_decode($facultyDetails['awards'], true);
        if (!empty($awards_recognition)) {
            foreach ($awards_recognition as $index => $award) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $award['nature'] ?? 'NULL'; ?></td>
                    <td><?php echo $award['awarded_by'] ?? 'NULL'; ?></td>
                    <td><?php echo $award['year'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>


	<span class="label">12. Research Supervision</span>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="6"><strong class="tr_title">(A) PhD Thesis Supervision</strong></td>
		</tr>
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="25%"><strong>Name of Student/Research Scholar</strong></td>
			<td width="30%"><strong>Title of Thesis</strong></td>
			<td width="10%"><strong>Role</strong></td>
			<td width="10%"><strong>Ongoing/Completed</strong></td>
			<td width="10%"><strong>Ongoing Since/ Year of Completion</strong></td>
		</tr>
        <?php
        $phd_thesis_supervision = json_decode($facultyDetails['phd_thesis'], true) ?? [];
        if (!empty($phd_thesis_supervision)) {
            foreach ($phd_thesis_supervision as $index => $thesis) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $thesis['scholar'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['thesis'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['role'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['status'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['year'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>

	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="6"><strong class="tr_title">(B) M.Tech/M.E./Master's Thesis Supervision</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="25%"><strong>Name of Student/Research Scholar</strong></td>
			<td width="30%"><strong>Title of Thesis</strong></td>
			<td width="10%"><strong>Role</strong></td>
			<td width="10%"><strong>Ongoing/Completed</strong></td>
			<td width="10%"><strong>Ongoing Since/ Year of Completion</strong></td>
		</tr>
		
        <?php
        $masters_thesis_supervision = json_decode($facultyDetails['mtech_thesis'], true) ?? [];
        if (!empty($masters_thesis_supervision)) {
            foreach ($masters_thesis_supervision as $index => $thesis) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $thesis['scholar'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['thesis'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['role'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['status'] ?? 'NULL'; ?></td>
                    <td><?php echo $thesis['year'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>

	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="6"><strong class="tr_title">(C) B.Tech/B.E./Bachelor's Project Supervision</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="25%"><strong>Name of Student</strong></td>
			<td width="30%"><strong>Title of Project</strong></td>
			<td width="10%"><strong>Role</strong></td>
			<td width="10%"><strong>Ongoing/Completed</strong></td>
			<td width="10%"><strong>Ongoing Since/ Year of Completion</strong></td>
		</tr>
		
        <?php
        $bachelors_project_supervision = json_decode($facultyDetails['btech_thesis'], true);
        if (!empty($bachelors_project_supervision)) {
            foreach ($bachelors_project_supervision as $index => $project) {
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $project['scholar'] ?? 'NULL'; ?></td>
                    <td><?php echo $project['thesis'] ?? 'NULL'; ?></td>
                    <td><?php echo $project['role'] ?? 'NULL'; ?></td>
                    <td><?php echo $project['status'] ?? 'NULL'; ?></td>
                    <td><?php echo $project['year'] ?? 'NULL'; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br>
<?php
// Retrieve Sponsored Projects data from the database
$sponsoredProjects = json_decode($facultyDetails['s_proj'], true) ?? [];

// Retrieve Consultancy Projects data from the database
$consultancyProjects = json_decode($facultyDetails['consultancy'], true) ?? [];
?>
	<span class="label">13. Sponsored Projects/ Consultancy Details </span>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="7"><strong class="tr_title">(A) Sponsored Projects</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Sponsoring Agency</strong></td>
			<td width="20%"><strong>Title of Project</strong></td>
			<td width="10%"><strong>Sanctioned Amount</strong></td>
			<td width="10%"><strong>Period</strong></td>
			<td width="10%"><strong>Role</strong></td>
			<td width="10%"><strong>Status</strong></td>
		</tr>
        <?php if(!empty($sponsoredProjects)){
            foreach ($sponsoredProjects as $index => $project) : ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $project['agency']; ?></td>
                <td><?php echo $project['title']; ?></td>
                <td><?php echo $project['amount']; ?></td>
                <td><?php echo $project['period']; ?></td>
                <td><?php echo $project['role']; ?></td>
                <td><?php echo $project['status']; ?></td>
            </tr>
        <?php endforeach; }?>

    </tbody>
</table>
<br>

	
	
		<span class="label">14. Significant research contribution and future plans</span>
	<table class="tab">
		<tbody><tr>
			<td style="text-align:justify;"><p><?php echo $facultyDetails['research_statement'] ?? '';?></p>
</td>
		</tr>

	</tbody></table>
	<br>

	<span class="label">15. Significant teaching contribution and future plans</span>

	<table class="tab">
		
		<tbody><tr>
			<td style="text-align:justify;"><p><?php echo $facultyDetails['teaching_statement'] ?? '';?></p>
</td>
		</tr>
	</tbody></table>
	<br>

	<span class="label">16. Any other relevant information</span>
	
	<table class="tab">
		<tbody><tr>
			<td><p><?php echo $facultyDetails['rel_info'] ?? '';?></p>
</td>
		</tr>
	</tbody></table>
	<br>

	<span class="label">17. Professional Service as Reviewer/Editor etc.</span>
	<table class="tab">
		<tbody><tr>
			<td><p><?php echo $facultyDetails['prof_service'] ?? '';?></p>
</td>
		</tr>
	</tbody></table>
	<br>

	<span class="label">18. Detailed List of Journal Publications<br>(Including Sr. No., Author's Names, Paper Title, Volume, Issue, Year, Page Nos., Impact Factor (if any), DOI, Status [Published/Accepted])</span>
	<table class="tab">
		<tbody><tr>
			<td><p><?php echo $facultyDetails['journal_publications'] ?? '';?></p>
</td>
		</tr>
	</tbody></table>
	<br>

	<span class="label">19. Detailed List of Conference Publications<br>(Including Sr. No.,  Author's Names, Paper Title, Name of the conference, Year, Page Nos., DOI [If any])</span>
	<table class="tab">
		<tbody><tr>
			<td><p><?php echo $facultyDetails['conference_publications'] ?? '';?></p>
</td>
		</tr>
	</tbody></table>
	<br>

	<span class="label">20. Reprints of 5 Best Research Papers-Attached </span>
	
	<br>
	<br>

	<span class="label">21. Check List of the documents attached with the online application </span><br>

	<?php

// Function to check if a file exists
function checkFileExists($filePath) {
    return file_exists($filePath);
}

// Function to display the file name if it exists
function displayFileNameIfExists($uploadsDir, $fileName) {
    $filePath = $uploadsDir . $fileName;
    if (checkFileExists($filePath)) {
        echo "$fileName<br>";
    }
}

// Directory and file names
$selectedDepartment = strtoupper($_SESSION['dept']);
$nameEmailCat = strtoupper($_SESSION['fname'] . '_' . $_SESSION['lname'] . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
$uploadsDir = $_SESSION['adv_num'] . '/' . $selectedDepartment . '/' . $nameEmailCat . '/';
$fileNames = [
    'PHD_Certificate.pdf',
    'PG_Certificate.pdf',
    'UG_Certificate.pdf',
    '12th_HSC_Diploma.pdf',
    '10th_SSC_Certificate.pdf',
    '10_Years_Post_PHD_Experience_Certificate.pdf',
    'Any_Other_Document.pdf'
];

// Display the names of files that exist
foreach ($fileNames as $fileName) {
    displayFileNameIfExists($uploadsDir, $fileName);
}
?>


	<span class="label">22. Referees</span>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="6"><strong class="tr_title">Details of Referees</strong></td>
		</tr>

		<tr>
			<!-- <td><strong>S. No.</strong></td> -->
			<td width="20%"><strong>Name</strong></td>
			<td width="20%"><strong>Position</strong></td>
			<td width="15%"><strong>Association with Referee</strong></td>
			<td width="15%"><strong>Institution/<br>Organization</strong></td>
			<td width="15%"><strong>E-mail</strong></td>
			<td width="15%"><strong>Contact No.</strong></td>
		</tr>
        <?php 
        $referees = json_decode($facultyDetails['refrees'], true) ?? [];
        if (!empty($referees)) {
            foreach ($referees as $index => $referee) : ?>
                <tr>
                    <!-- You can add a serial number if needed -->
                    <td><?php echo $referee['name'] ?? ''; ?></td>
                    <td><?php echo $referee['position'] ?? ''; ?></td>
                    <td><?php echo $referee['association'] ?? ''; ?></td>
                    <td><?php echo $referee['institution'] ?? ''; ?></td>
                    <td><?php echo $referee['email'] ?? ''; ?></td>
                    <td><?php echo $referee['contact'] ?? ''; ?></td>
                </tr>
            <?php endforeach;
        } ?>
    </tbody>
</table>
<br>

<?php
    // Assuming $uploadsDir is defined as mentioned in your code
    $signatureImagePath = $uploadsDir . 'Signature.jpg';
    ?>

	
	<span class="label">23. Final Declaration</span>

	<table class="tab">
		
		<tbody><tr><td>                I hereby declare that I have carefully read and understood the instructions and particulars mentioned in the advertisment and this application form. I further declare that all the entries along with the attachments uploaded in this form are true to the best of my knowledge and belief</td>
	</tr></tbody></table>
	<br>
	
		<img src="<?php echo $signatureImagePath; ?>" style="height:50; "><br>
	Signature of Applicant

	</div>

    <div id="non_print_area">
		<button onclick="window.print();">Print Application</button> <br>
	</div>
	</div>



	
<style>
@media print
{    
    #non_print_area
    {
        display: none !important;
    }
}
</style>

</body></html>