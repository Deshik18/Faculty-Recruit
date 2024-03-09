<?php
require_once('TCPDF-MAIN/tcpdf.php');
include 'config.php';
session_start();

$email = $_SESSION['email']; // Assuming the email is stored in the session variable

$sql = "SELECT fn_ln_cast, application_details, per_det FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($fn_ln_cast, $applicationDetails, $perDetails);

    if ($stmt->fetch()) {
        $fnArray = json_decode($fn_ln_cast, true);
        $detailsArray = json_decode($applicationDetails, true);
        $perDetailsArray = json_decode($perDetails, true);
    }
    $stmt->close();
}

$selectQuery = "SELECT * FROM faculty_details WHERE email = ?";
$stmtSelect = $conn->prepare($selectQuery);
if ($stmtSelect) {
    $stmtSelect->bind_param("s", $email);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $facultyDetails = $result->fetch_assoc();
    $stmtSelect->close();
} else {
    echo "Error in prepared statement: " . $conn->error;
}

$selected_department = strtoupper($detailsArray['dept']);
$name_email_cat = strtoupper($fnArray['first_name'] . '_' . $fnArray['last_name'] . '_' . $email . '_' . $fnArray['cast']);
$uploadsDir = $detailsArray['adv_num'] . '/' . $selected_department . '/' . $detailsArray['post'] . '/' . $fnArray['cast'] . '/' . $detailsArray['ref_num'] . '_' . $name_email_cat . '_supportingdocs/';

$photoExtensions = ['jpg', 'jpeg', 'png', 'gif'];

foreach ($photoExtensions as $extension) {
    $photoPath = $uploadsDir . 'Photo.' . $extension;
    if (file_exists($photoPath)) {
        break;
    }
}

$perDet = json_decode($facultyDetails['per_det'], true) ?? [];
$caddDet = json_decode($facultyDetails['cadd_det'], true) ?? [];
$paddDet = json_decode($facultyDetails['padd_det'], true) ?? [];
$contact_det = json_decode($facultyDetails['contact_det'], true) ?? [];
$phd_details = json_decode($facultyDetails['phd_det'], true) ?? [];
$pg_details = json_decode($facultyDetails['pg_det'], true) ?? [];
$ug_details = json_decode($facultyDetails['ug_det'], true) ?? [];
$sch_details = json_decode($facultyDetails['sch_det'], true) ?? [];
$additional_qualifications = json_decode($facultyDetails['additional_qualifications'], true) ?? [];
$pres_emp_det = json_decode($facultyDetails['pre_emp_det'], true) ?? [];
$emp_hist = json_decode($facultyDetails['his_det'], true) ?? [];
$te_exp = json_decode($facultyDetails['te_det'], true) ?? [];
$r_exp = json_decode($facultyDetails['r_det'], true) ?? [];
$ind_exp = json_decode($facultyDetails['ind_det'], true) ?? [];
$area_det = json_decode($facultyDetails['area_det'], true) ?? [];
$patent = json_decode($facultyDetails['patent'], true);
$sum_pub = json_decode($facultyDetails['sum_pub'], true);
$best_pub = json_decode($facultyDetails['best_pub'], true);
$book = json_decode($facultyDetails['book'], true);
$chapter = json_decode($facultyDetails['chap'], true);
$membership_societies = json_decode($facultyDetails['membership'], true) ?? [];
$professional_training = json_decode($facultyDetails['prof_trg'], true) ?? [];
$awards_recognition = json_decode($facultyDetails['awards'], true) ?? [];
$phd_thesis_supervision = json_decode($facultyDetails['phd_thesis'], true) ?? [];
$sponsoredProjects = json_decode($facultyDetails['s_proj'], true) ?? [];
$consultancyProjects = json_decode($facultyDetails['consultancy'], true) ?? [];

$html = '
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
        .receipt_container {
        display: flex;
        justify-content: space-between;
    }
	    .receipt_left {
            width: 70%; /* Adjust the width as needed */
        }
    
        .receipt_right {
            width: 30%; /* Adjust the width as needed */
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

	    .receipt_right img {
            max-width: 100%; /* Ensure the image fits within its container */
            height: auto;
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
        <div class="title">
		<p style="text-align: center; margin-top: 10px; background-color: #175395; line-height: 25px; color: #FFF; font-weight: bold;">Application for the Faculty Position</p>
		</div>
		<hr>
        </div>
    
    <div class="receipt_left">
        <p style="width:10in;">Advertisement Number : ' . $detailsArray['adv_num'] . '</p>
        <p>Date of Application : ' . ($facultyDetails['doa'] ?? '') . '</p>
        <p>Post Applied for : ' . ($detailsArray['post'] ?? '') . '</p>
        <p>Department : ' . ($detailsArray['dept'] ?? '') . '</p>
        <p>Application Number : ' . ($detailsArray['ref_num'] ?? '') . '</p>
    </div>
    <div class="receipt_right" style="margin-top: -30px;">';
    if (isset($photoPath) && file_exists($photoPath)) {
        $html .= '<img src="' . $photoPath . '">';
    }
    $html .='</div>

    <div>
    <span class="label">1. Personal Details</span><br>
    <table class="tab">
        <tbody>
            <tr style="background-color:#f1f1f1;">
                <td><strong class="tr_title">First Name</strong></td>
                <td><strong class="tr_title">Middle Name</strong></td>
                <td><strong class="tr_title">Last Name</strong></td>
            </tr>
            <?php
            
            ?>
            <tr>';
                $html .= '<td>' . ($perDet['fname'] ?? '') . '</td>';
                $html .= '<td>' . ($perDet['mname'] ?? '') . '</td>';
                $html .= '<td>' . ($perDet['lname'] ?? '') . '</td>';
            $html .= '</tr>
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
                <td>' . ($perDet['dob'] ?? '') . '</td>
                <td>' . ($perDet['gender'] ?? '') . '</td>
                <td>' . ($perDet['mstatus'] ?? '') . '</td>
                <td>' . ($perDet['cast'] ?? '') . '</td>
                <td>' . ($perDet['nationality'] ?? '') . '</td>
                <td>' . ($perDet['id_proof'] ?? '') . '</td>
            </tr>
            <tr>
                <td><strong>Father\'s Name</strong></td>
                <td colspan="6">' . ($perDet['father_name'] ?? '') . '</td>
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
        <tr>
            <td>' . ($caddDet['street'] ?? '') . '</td>
            <td>' . ($paddDet['street'] ?? '') . '</td>
        </tr>
        <tr>
            <td>' . ($caddDet['city'] ?? '') . '</td>
            <td>' . ($paddDet['city'] ?? '') . '</td>
        </tr>
        <tr>
            <td>' . ($caddDet['state'] ?? '') . '</td>
            <td>' . ($paddDet['state'] ?? '') . '</td>
        </tr>
        <tr>
            <td>' . ($caddDet['country'] ?? '') . '</td>
            <td>' . ($paddDet['country'] ?? '') . '</td>
        </tr>
        <tr>
            <td>' . ($caddDet['zip'] ?? '') . '</td>
            <td>' . ($paddDet['zip'] ?? '') . '</td>
        </tr>
    </tbody>
    </table>
    <br>

    <span class="label"></span><br>
    <table class="tab">
    <tbody>
        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Mobile</strong></td>
            <td>' . ($contact_det['mobile'] ?? '') . '</td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Alternate Mobile</strong></td>
            <td>' . ($contact_det['mobile_2'] ?? '') . '</td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Landline Phone No.</strong></td>
            <td>' . ($contact_det['landline'] ?? '') . '</td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">E-mail</strong></td>
            <td>' . ($email ?? '') . '</td>
        </tr>

        <tr>
            <td style="background-color:#f1f1f1;"><strong class="tr_title">Alternate E-mail</strong></td>
            <td>' . ($contact_det['email_2'] ?? '') . '</td>
        </tr>
    </tbody>
    </table>
    <br>
    <br>

	<span class="label">2. Educational Qualifications</span><br>
	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="6" class="tr_title"><strong>(A) Ph. D. Details</strong></td>
		</tr>
		
		<tr>
			<td width="30%"><strong>University/<br>Institute</strong></td>
			<td width="13%"><strong>Department</strong></td>
			<td width="17%"><strong>Name of Ph. D. <br>Supervisor</strong></td>
			<td width="10%"><strong>Year of <br>Joining</strong></td>
			<td width="15%"><strong>Date of <br>successful <br>thesis Defence</strong></td>
			<td width="15%"><strong>Date of <br>Award</strong></td>
		</tr>
		
		<tr>
			<td>' . ($phd_details['college'] ?? '') . '</td>
			<td>' . ($phd_details['stream'] ?? '') . '</td>
			<td>' . ($phd_details['supervisor'] ?? '') . '</td>
			<td>' . ($phd_details['yoj'] ?? '') . '</td>
			<td>' . ($phd_details['dod'] ?? '') . '</td>
			<td>' . ($phd_details['doa'] ?? '') . '</td>
		</tr>

		<tr>
			<td><strong>Title of Ph. D. Thesis</strong></td>
			<td colspan="5">' . ($phd_details['title'] ?? '') . '</td>
		</tr>
		
		</tbody></table>
	<br>
    <br>
	<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(B) Academic Details - PG</strong></td>
        </tr>

        <tr>
            <td width="10%"><strong>Degree</strong></td>
            <td width="25%"><strong>University/<br>Institute</strong></td>
            <td width="18%"><strong>Subjects</strong></td>
            <td width="9%"><strong>Year of <br>Joining</strong></td>
            <td width="9%"><strong>Year of <br>Graduation</strong></td>
            <td width="9%"><strong>Duration <br>(in years)</strong></td>
            <td width="10%"><strong>Percentage/CGPA </strong></td>
            <td width="10%"><strong>Division/Class </strong></td>
        </tr>

        <tr>
            <td>' . ($pg_details['degree'] ?? '') . '</td>
            <td>' . ($pg_details['college'] ?? '') . '</td>
            <td>' . ($pg_details['subjects'] ?? '') . '</td>
            <td>' . ($pg_details['yoj'] ?? '') . '</td>
            <td>' . ($pg_details['yog'] ?? '') . '</td>
            <td>' . ($pg_details['duration'] ?? '') . '</td>
            <td>' . ($pg_details['percentage'] ?? '') . '</td>
            <td>' . ($pg_details['rank'] ?? '') . '</td>
        </tr>
    </tbody>
    </table>

	<br>
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
            <td width="9%"><strong>Year of <br>Joining</strong></td>
            <td width="9%"><strong>Year of <br>Graduation</strong></td>
            <td width="9%"><strong>Duration <br>(in years)</strong></td>
            <td width="9%"><strong>Percentage/CGPA </strong></td>
            <td width="9%"><strong>Division/Class </strong></td>
        </tr>

        <tr>
            <td>' . ($ug_details['degree'] ?? '') . '</td>
            <td>' . ($ug_details['college'] ?? '') . '</td>
            <td>' . ($ug_details['subjects'] ?? '') . '</td>
            <td>' . ($ug_details['yoj'] ?? '') . '</td>
            <td>' . ($ug_details['yog'] ?? '') . '</td>
            <td>' . ($ug_details['duration'] ?? '') . '</td>
            <td>' . ($ug_details['percentage'] ?? '') . '</td>
            <td>' . ($ug_details['rank'] ?? '') . '</td>
        </tr>
    </tbody>
    </table>
    <br>
    <br>

    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(D) Academic Details - School</strong></td>
        </tr>

        <tr>
            <td width="23%"><strong>10th/12th/HSC/Diploma</strong></td>
            <td width="23%"><strong>School</strong></td>
            <td width="18%"><strong>Year of Passing</strong></td>
            <td width="18%"><strong>Percentage/CGPA</strong></td>
            <td width="18%"><strong>Division/Class</strong></td>
        </tr>';

            $html .= '<tr>
                <td width="23%">' . ($sch_details['hsc_ssc'][0] ?? '') . '</td>
                <td width="23%">' . ($sch_details['school'][0] ?? '') . '</td>
                <td width="18%">' . ($sch_details['passing_year'][0] ?? '') . '</td>
                <td width="18%">' . ($sch_details['percentage'][0] ?? '') . '</td>
                <td width="18%">' . ($sch_details['rank'][0] ?? '') . '</td>
            </tr>';

            $html .= '<tr>
                <td width="23%">' . ($sch_details['hsc_ssc'][1] ?? '') . '</td>
                <td width="23%">' . ($sch_details['school'][1] ?? '') . '</td>
                <td width="18%">' . ($sch_details['passing_year'][1] ?? '') . '</td>
                <td width="18%">' . ($sch_details['percentage'][1] ?? '') . '</td>
                <td width="18%">' . ($sch_details['rank'][1] ?? '') . '</td>
            </tr>';

$html .= '    </tbody>
    </table>
    <br>
    <br>

    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(E) Additional Educational Qualifications (If any)</strong></td>
        </tr>

        <tr>
            <td width="10%"><strong>Degree</strong></td>
            <td width="25%"><strong>University/<br>Institute</strong></td>
            <td width="18%"><strong>Subjects</strong></td>
            <td width="9%"><strong>Year of <br>Joining</strong></td>
            <td width="9%"><strong>Year of <br>Graduation</strong></td>
            <td width="9%"><strong>Duration <br>(in years)</strong></td>
            <td width="10%"><strong>Percentage/CGPA </strong></td>
            <td width="10%"><strong>Division/Class </strong></td>
        </tr>';

foreach ($additional_qualifications as $qualification) {
    $html .= '<tr>
        <td>' . ($qualification['degree'] ?? '') . '</td>
        <td>' . ($qualification['college'] ?? '') . '</td>
        <td>' . ($qualification['stream'] ?? '') . '</td>
        <td>' . ($qualification['yoj'] ?? '') . '</td>
        <td>' . ($qualification['yog'] ?? '') . '</td>
        <td>' . ($qualification['duration'] ?? '') . '</td>
        <td>' . ($qualification['percentage'] ?? '') . '</td>
        <td>' . ($qualification['division'] ?? '') . '</td>
    </tr>';
}

$html .= '    </tbody>
    </table>
    <br>
	<br>

    <span class="label">3. Employment Details </span><br>

	<table class="tab">
		<tbody><tr style="background-color:#f1f1f1;">
			<td colspan="5" class="tr_title"><strong>(A) Present Employment</strong></td>
		</tr>

		<tr>
            <td width="24%"><strong>Position </strong></td>
            <td width="40%"><strong>Organization/Institution</strong></td>
            <td width="12%"><strong>Date of <br>Joining</strong></td>
            <td width="12%"><strong>Date of <br>Leaving </strong></td>
            <td width="12%"><strong>Duration <br>(in years)</strong></td>
		</tr>
				<tr>
			<td>' . ($pres_emp_det['position'] ?? '') . '</td>
			<td>' . ($pres_emp_det['employer'] ?? '') . '</td>
			<td>' . ($pres_emp_det['status'] ?? '') . '</td>
			<td>' . ($pres_emp_det['doj'] ?? '') . '</td>
			<td>' . ($pres_emp_det['dol'] ?? '') . '</td>
		</tr>
	</tbody>
    </table>
	<br>
    <br>

    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="5" class="tr_title"><strong>(B) Employment History (After PhD )</strong></td>
        </tr>

        <tr>
            <td width="24%"><strong>Position </strong></td>
            <td width="40%"><strong>Organization/Institution</strong></td>
            <td width="12%"><strong>Date of <br>Joining</strong></td>
            <td width="12%"><strong>Date of <br>Leaving </strong></td>
            <td width="12%"><strong>Duration <br>(in years)</strong></td>
        </tr>';

if(!empty($emp_hist)){
    foreach ($emp_hist as $index => $qualification) {
        $html .= '<tr height="60px">
            <td>' . ($qualification['position'] ?? '') . '</td>
            <td>' . ($qualification['org'] ?? '') . '</td>
            <td>' . ($qualification['doj'] ?? '') . '</td>
            <td>' . ($qualification['dol'] ?? '') . '</td>
            <td>' . ($qualification['duration'] ?? '') . '</td>
        </tr>';
    }
}

$html .= '
        <tr>
            <td colspan="5">More than 3 years teaching experience(Post Phd) <strong style="color:red;">' . ($facultyDetails['teach_exp'] ?? '') . '</strong></td>
        </tr>
    </tbody>
    </table>
	<br>
    <br>

	<!-- (C) Teaching Experience (After PhD) -->
    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong>(C) Teaching Experience (After PhD)</strong></td>
        </tr>

        <tr>
            <!-- <td><strong>S. No.</strong></td> -->
            <td width="13%"><strong>Position</strong></td>
            <td width="21%"><strong>Employer</strong></td>
            <td width="21%"><strong>Course Taught</strong></td>
            <td width="9%"><strong>UG/PG</strong></td>
            <td width="9%"><strong>No. of Students</strong></td>
            <td width="9%"><strong>Date of <br>Joining</strong></td>
            <td width="9%"><strong>Date of <br>Leaving</strong></td>
            <td width="9%"><strong>Duration</strong></td>
        </tr>';

if(!empty($te_exp)){
    foreach ($te_exp as $index => $experience) {
        $html .= '<tr height="60px">
            <td>' . ($experience['position'] ?? '') . '</td>
            <td>' . ($experience['employer'] ?? '') . '</td>
            <td>' . ($experience['course'] ?? '') . '</td>
            <td>' . ($experience['ug_pg'] ?? '') . '</td>
            <td>' . ($experience['no_stu'] ?? '') . '</td>
            <td>' . ($experience['doj'] ?? '') . '</td>
            <td>' . ($experience['dol'] ?? '') . '</td>
            <td>' . ($experience['duration'] ?? '') . '</td>
        </tr>';
    }
}

$html .= '    </tbody>
</table>
<br>
<br>

<!-- (D) Research Experience -->
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1">
            <td colspan="6" class="tr_title"><strong>(D) Research Experience </strong></td>
        </tr>

        <tr>
            <td width="22%"><strong>Position</strong></td>
            <td width="22%"><strong>Institute</strong></td>
            <td width="23%"><strong>Supervisor</strong></td>
            <td width="11%"><strong>Date of <br>Joining</strong></td>
            <td width="11%"><strong>Date of <br>Leaving</strong></td>
            <td width="11%"><strong>Duration</strong></td>
        </tr>';

if(!empty($r_exp)){
    foreach ($r_exp as $index => $experience) {
        $html .= '<tr height="60px">
            <td>' . ($experience['position'] ?? '') . '</td>
            <td>' . ($experience['institute'] ?? '') . '</td>
            <td>' . ($experience['supervisor'] ?? '') . '</td>
            <td>' . ($experience['doj'] ?? '') . '</td>
            <td>' . ($experience['dol'] ?? '') . '</td>
            <td>' . ($experience['duration'] ?? '') . '</td>
        </tr>';
    }
}

$html .= '    </tbody>
</table>
<br>
<br>

<!-- (E) Industrial Experience -->
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1">
            <td colspan="5"><strong class="tr_title">(E) Industrial Experience </strong></td>
        </tr>

        <tr>
            <td width="24%"><strong>Organization</strong></td>
            <td width="24%"><strong>Work Profile</strong></td>
            <td width="24%"><strong>Date of <br>Joining</strong></td>
            <td width="14%"><strong>Date of <br>Leaving</strong></td>
            <td width="14%"><strong>Duration</strong></td>
        </tr>';

if(!empty($ind_exp)){
    foreach ($ind_exp as $index => $experience) {
        $html .= '<tr height="60px">
            <td>' . ($experience['org'] ?? '') . '</td>
            <td>' . ($experience['work'] ?? '') . '</td>
            <td>' . ($experience['doj'] ?? '') . '</td>
            <td>' . ($experience['dol'] ?? '') . '</td>
            <td>' . ($experience['period'] ?? '') . '</td>
        </tr>';
    }
}

$html .= '    </tbody>
</table>
<br>
<br>

    <span class="label">4.  Area(s) of Specialization and Current Area(s) of Research</span><br>
    <table class="tab">
        <tbody>
            <tr style="background-color:#f1f1f1;">
                <td width="25%" style="background-color: #f1f1f1;"><strong class="tr_title">Area(s) of Specialization</strong></td>
                <td width="75%">' . ($area_det['area_spl'] ?? '') . '</td>
            </tr>

            <tr>
                <td width="25%" style="background-color: #f1f1f1;"><strong class="tr_title">Current Area(s) of Research</strong></td>
                <td width="75%">' . ($area_det['area_rese'] ?? '') . '</td>
            </tr>
        </tbody>
    </table>
    <br>
	<br>

	<span class="label">5. Summary of Publications</span><br>
	<table class="tab">
    <tbody>
        <tr>
            <td width="50%"><strong>Number of International Journal Papers </strong></td>
            <td>' . ($sum_pub['summary_journal_inter'] ?? '') . '</td>
        </tr>

        <tr>
            <td width="50%"><strong>Number of National Journal Papers </strong></td>
            <td>' . ($sum_pub['summary_journal'] ?? '') . '</td>
        </tr>

        <tr>
            <td><strong> Number of International Conference Papers </strong></td>
            <td>' . ($sum_pub['summary_conf_inter'] ?? '') . '</td>
        </tr>

        <tr>
            <td><strong> Number of National Conference Papers </strong></td>
            <td>' . ($sum_pub['summary_conf_national'] ?? '') . '</td>
        </tr>

			<tr>
				<td><strong> Number of Patent(s) </strong></td>
				<td>' . ($sum_pub['patent_publish'] ?? '') . '</td>
			</tr>

			<tr>
				<td><strong> Number of Book(s) </strong></td>
				<td>' . ($sum_pub['summary_book'] ?? '') . '</td>
			</tr>

			<tr>
				<td><strong>Number of Book Chapter(s) </strong></td>
				<td>' . ($sum_pub['summary_book_chapter'] ?? '') . '</td>
			</tr>
			
			
					</tbody></table>
		<br>
        <br>

	<span class="label">6. List of 10 Best Research Publications (Journal/Conference)</span><br>
    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="8"><strong class="tr_title">(A) Journals(s)</strong></td>
        </tr>
        <tr>
            <td width="5%"><strong>S. No.</strong></td>
            <td width="25%"><strong>Author(s) </strong></td>
            <td width="30%"><strong>Title</strong></td>
            <td width="15%"><strong>Name of Journal</strong></td>
            <td width="10%"><strong>Year, Vol., Page</strong></td>
            <td width="5%"><strong>Impact Factor</strong></td>
            <td width="5%"><strong>DOI</strong></td>
            <td width="5%"><strong>Status</strong></td>
        </tr>';

if (!empty($best_pub)) {
    foreach ($best_pub as $index => $publication) {
        $html .= '<tr>
            <td>' . ($index + 1) . '</td>
            <td>' . ($publication['author'] ?? 'NULL') . '</td>
            <td>' . ($publication['title'] ?? 'NULL') . '</td>
            <td>' . ($publication['journal'] ?? 'NULL') . '</td>
            <td>' . ($publication['year'] ?? 'NULL') . '</td>
            <td>' . ($publication['impact'] ?? 'NULL') . '</td>
            <td>' . ($publication['doi'] ?? 'NULL') . '</td>
            <td>' . ($publication['status'] ?? 'NULL') . '</td>
        </tr>';
    }
}

$html .= '    </tbody>
    </table>
    <br>
    <br>

	<span class="label">7. List of Patent(s), Book(s), Book Chapter(s)</span><br>
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
            <td width="10%"><strong>Status<br>Filed/Published/Granted</strong></td>
        </tr>';

        if (!empty($patent)) {
            foreach ($patent as $index => $patentDetails) {
                $html .= '
                    <tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . ($patentDetails['inventor'] ?? 'NULL') . '</td>
                        <td>' . ($patentDetails['title'] ?? 'NULL') . '</td>
                        <td>' . ($patentDetails['country'] ?? 'NULL') . '</td>
                        <td>' . ($patentDetails['number'] ?? 'NULL') . '</td>
                        <td>' . ($patentDetails['year_filed'] ?? 'NULL') . '</td>
                        <td>' . ($patentDetails['year_published'] ?? 'NULL') . '</td>
                        <td>' . ($patentDetails['year_issued'] ?? 'NULL') . '</td>
                    </tr>';
            }
        }
    $html .='</tbody>
    </table>
    <br>
    <br>

    <table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="5"><strong class="tr_title">(B) Book(s)</strong></td>
        </tr>
        <tr>
            <td width="5%"><strong>S. No.</strong></td>
            <td width="30%"><strong>Author(s) </strong></td>
            <td width="35%"><strong>Title of the Book</strong></td>
            <td width="20%"><strong>Year of Publication</strong></td>
            <td width="10%"><strong>ISBN</strong></td>
        </tr>';

if (!empty($book)) {
    foreach ($book as $index => $bookDetails) {
        $html .= '
            <tr>
                <td>' . ($index + 1) . '</td>
                <td>' . ($bookDetails['bauthor'] ?? 'NULL') . '</td>
                <td>' . ($bookDetails['btitle'] ?? 'NULL') . '</td>
                <td>' . ($bookDetails['byear'] ?? 'NULL') . '</td>
                <td>' . ($bookDetails['bisbn'] ?? 'NULL') . '</td>
            </tr>';
    }
}

$html .= '
    </tbody>
</table>
<br>
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
        </tr>';

if (!empty($chapter)) {
    foreach ($chapter as $index => $chapterDetails) {
        $html .= '
            <tr>
                <td>' . ($index + 1) . '</td>
                <td>' . ($chapterDetails['author'] ?? 'NULL') . '</td>
                <td>' . ($chapterDetails['title'] ?? 'NULL') . '</td>
                <td>' . ($chapterDetails['year'] ?? 'NULL') . '</td>
                <td>' . ($chapterDetails['isbn'] ?? 'NULL') . '</td>
            </tr>';
    }
}

$html .= '
    </tbody>
</table>
<br>
<br>

<span class="label">8. Google Scholar Link </span><br>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td width="12%"><strong class="tr_title">URL</strong></td>
            <td width="88%">' . ($facultyDetails['scholar_link'] ?? ' ') . '</td>
        </tr>
    </tbody>
</table>
<br>
<br>

<span class="label">9. Membership of Professional Societies </span><br>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="3"><strong class="tr_title">Details</strong></td>
        </tr>
        <tr>
            <td width="10%"><strong>S. No.</strong></td>
            <td width="45%"><strong>Name of the Professional Society</strong></td>
            <td width="45%"><strong>Membership Status (Lifetime/Annual)</strong></td>
        </tr>';

if (!empty($membership_societies)) {
    foreach ($membership_societies as $index => $membership) {
        $html .= '
            <tr>
                <td>' . ($index + 1) . '</td>
                <td>' . ($membership['name'] ?? '') . '</td>
                <td>' . ($membership['status'] ?? '') . '</td>
            </tr>';
    }
}

$html .= '
    </tbody>
</table>
<br>
<br>

<span class="label">10. Professional Training </span><br>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="5"><strong class="tr_title">Details</strong></td>
        </tr>
        
        <tr>
            <td width="10%"><strong>S. No.</strong></td>
            <td width="35%"><strong>Type of Training Received</strong></td>
            <td width="35%"><strong>Organisation</strong></td>
            <td width="10%"><strong>Year</strong></td>
            <td width="10%"><strong>Duration</strong></td>
        </tr>';

if (!empty($professional_training)) {
    foreach ($professional_training as $index => $training) {
        $html .= '
            <tr>
                <td>' . ($index + 1) . '</td>
                <td>' . ($training['name'] ?? 'NULL') . '</td>
                <td>' . ($training['organization'] ?? 'NULL') . '</td>
                <td>' . ($training['year'] ?? 'NULL') . '</td>
                <td>' . ($training['duration'] ?? 'NULL') . '</td>
            </tr>';
    }
}

$html .= '
    </tbody>
</table>
<br>
<br>

<span class="label">11. Award(s) and Recognition(s) </span><br>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="4"><strong class="tr_title">Details</strong></td>
        </tr>
        
        <tr>
            <td width="10%"><strong>S. No.</strong></td>
            <td width="37%"><strong>Name of Award</strong></td>
            <td width="37%"><strong>Awarded By</strong></td>
            <td width="16%"><strong>Year</strong></td>
        </tr>';


if (!empty($awards_recognition)) {
    foreach ($awards_recognition as $index => $award) {
        $html .= '
            <tr>
                <td>' . ($index + 1) . '</td>
                <td>' . ($award['nature'] ?? 'NULL') . '</td>
                <td>' . ($award['organization'] ?? 'NULL') . '</td>
                <td>' . ($award['year'] ?? 'NULL') . '</td>
            </tr>';
    }
}

$html .= '
    </tbody>
</table>
<br>
<br>

<span class="label">12. Research Supervision</span><br>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="6"><strong class="tr_title">(A) PhD Thesis Supervision</strong></td>
        </tr>
        <tr>
            <td width="7%"><strong>S. No.</strong></td>
            <td width="26%"><strong>Name of Student/Research Scholar</strong></td>
            <td width="31%"><strong>Title of Thesis</strong></td>
            <td width="12%"><strong>Role</strong></td>
            <td width="12%"><strong>Ongoing/Completed</strong></td>
            <td width="12%"><strong>Ongoing Since/ Year of Completion</strong></td>
        </tr>';


if (!empty($phd_thesis_supervision)) {
    foreach ($phd_thesis_supervision as $index => $thesis) {
        $html .= '
            <tr>
                <td>' . ($index + 1) . '</td>
                <td>' . ($thesis['scholar'] ?? 'NULL') . '</td>
                <td>' . ($thesis['thesis'] ?? 'NULL') . '</td>
                <td>' . ($thesis['role'] ?? 'NULL') . '</td>
                <td>' . ($thesis['status'] ?? 'NULL') . '</td>
                <td>' . ($thesis['year'] ?? 'NULL') . '</td>
            </tr>';
    }
}

$html .= '
    </tbody>
</table>
<br>
<br>

<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
            <td colspan="6"><strong class="tr_title">(B) M.Tech/M.E./Master\'s Thesis Supervision</strong></td>
        </tr>
        
        <tr>
            <td width="7%"><strong>S. No.</strong></td>
            <td width="26%"><strong>Name of Student/Research Scholar</strong></td>
            <td width="31%"><strong>Title of Thesis</strong></td>
            <td width="12%"><strong>Role</strong></td>
            <td width="12%"><strong>Ongoing/Completed</strong></td>
            <td width="12%"><strong>Ongoing Since/ Year of Completion</strong></td>
        </tr>';
$masters_thesis_supervision = json_decode($facultyDetails['mtech_thesis'], true) ?? [];
if (!empty($masters_thesis_supervision)) {
    foreach ($masters_thesis_supervision as $index => $thesis) {
        $html .= '
            <tr>
                <td>' . ($index + 1) . '</td>
                <td>' . ($thesis['scholar'] ?? 'NULL') . '</td>
                <td>' . ($thesis['thesis'] ?? 'NULL') . '</td>
                <td>' . ($thesis['role'] ?? 'NULL') . '</td>
                <td>' . ($thesis['status'] ?? 'NULL') . '</td>
                <td>' . ($thesis['year'] ?? 'NULL') . '</td>
            </tr>';
    }
}

$html .= '
    </tbody>
</table>
<br>
<br>

<table class="tab">
<tbody>
    <tr style="background-color:#f1f1f1;">
        <td colspan="6"><strong class="tr_title">(C) B.Tech/B.E./Bachelor\'s Project Supervision</strong></td>
    </tr>
    
    <tr>
        <td width="7%"><strong>S. No.</strong></td>
        <td width="26%"><strong>Name of Student</strong></td>
        <td width="31%"><strong>Title of Project</strong></td>
        <td width="12%"><strong>Role</strong></td>
        <td width="12%"><strong>Ongoing/Completed</strong></td>
        <td width="12%"><strong>Ongoing Since/ Year of Completion</strong></td>
    </tr>';

$bachelors_project_supervision = json_decode($facultyDetails['btech_thesis'], true);
if (!empty($bachelors_project_supervision)) {
foreach ($bachelors_project_supervision as $index => $project) {
    $html .= '
        <tr>
            <td>' . ($index + 1) . '</td>
            <td>' . ($project['scholar'] ?? 'NULL') . '</td>
            <td>' . ($project['thesis'] ?? 'NULL') . '</td>
            <td>' . ($project['role'] ?? 'NULL') . '</td>
            <td>' . ($project['status'] ?? 'NULL') . '</td>
            <td>' . ($project['year'] ?? 'NULL') . '</td>
        </tr>';
}
}

$html .= '
</tbody>
</table>
<br>
<br>

<span class="label">13. Sponsored Projects/ Consultancy Details </span><br>
<table class="tab">
<tbody>
    <tr style="background-color:#f1f1f1;">
        <td colspan="7"><strong class="tr_title">(A) Sponsored Projects</strong></td>
    </tr>
    
    <tr>
        <td width="8%"><strong>S. No.</strong></td>
        <td width="22%"><strong>Sponsoring Agency</strong></td>
        <td width="22%"><strong>Title of Project</strong></td>
        <td width="12%"><strong>Sanctioned Amount</strong></td>
        <td width="12%"><strong>Period</strong></td>
        <td width="12%"><strong>Role</strong></td>
        <td width="12%"><strong>Status</strong></td>
    </tr>';
if (!empty($sponsoredProjects)) {
foreach ($sponsoredProjects as $index => $project) {
    $html .= '
        <tr>
            <td>' . ($index + 1) . '</td>
            <td>' . $project['agency'] . '</td>
            <td>' . $project['title'] . '</td>
            <td>' . $project['amount'] . '</td>
            <td>' . $project['period'] . '</td>
            <td>' . $project['role'] . '</td>
            <td>' . $project['status'] . '</td>
        </tr>';
}
}

$html .= '
</tbody>
</table>
<br>
<br>
	
<span class="label">14. Significant research contribution and future plans</span><br>
<table class="tab">
    <tbody>
        <tr>
            <td style="text-align:justify;">
                <p>' . ($facultyDetails['research_statement'] ?? '') . '</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>

<span class="label">15. Significant teaching contribution and future plans</span><br>
<table class="tab">
    <tbody>
        <tr>
            <td style="text-align:justify;">
                <p>' . ($facultyDetails['teaching_statement'] ?? '') . '</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>

<span class="label">16. Any other relevant information</span><br>
<table class="tab">
    <tbody>
        <tr>
            <td>
                <p>' . ($facultyDetails['rel_info'] ?? '') . '</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>

<span class="label">17. Professional Service as Reviewer/Editor etc.</span><br>
<table class="tab">
    <tbody>
        <tr>
            <td>
                <p>' . ($facultyDetails['prof_service'] ?? '') . '</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>

<span class="label">18. Detailed List of Journal Publications<br>(Including Sr. No., Author\'s Names, Paper Title, Volume, Issue, Year, Page Nos., Impact Factor (if any), DOI, Status [Published/Accepted])</span><br>
<table class="tab">
    <tbody>
        <tr>
            <td>
                <p>' . ($facultyDetails['journal_publications'] ?? '') . '</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>

<span class="label">19. Detailed List of Conference Publications<br>(Including Sr. No.,  Author\'s Names, Paper Title, Name of the conference, Year, Page Nos., DOI [If any])</span><br>
<table class="tab">
    <tbody>
        <tr>
            <td>
                <p>' . ($facultyDetails['conference_publications'] ?? '') . '</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>

<span class="label">20. Reprints of 5 Best Research Papers- ';

$researchPaperPath = $uploadsDir . 'Research_Paper.pdf';
$researchPaperExists = checkFileExists($researchPaperPath);

if ($researchPaperExists) {
    $html .= 'Attached';
} else {
    $html .= 'Not Attached';
}

$html .= '</span><br>	
<br>

<span class="label">21. Check List of the documents attached with the online application </span><br>';

// Directory and file names
$fileNames = [
    'PHD_Certificate.pdf',
    'PG_Certificate.pdf',
    'UG_Certificate.pdf',
    '12th_HSC_Diploma.pdf',
    '10th_SSC_Certificate.pdf',
    '10_Years_Post_PHD_Experience_Certificate.pdf',
    'Any_Other_Document.pdf'
];

function checkFileExists($filePath) {
    return file_exists($filePath);
}
// Display clickable links for files that exist
foreach ($fileNames as $fileName) {
    $filePath = $uploadsDir . $fileName;
    if (checkFileExists($filePath)) {
        $html .= "$fileName<br>";
}
}

$html .= '<br><span class="label">22. Referees</span><br>
<table class="tab">
    <tbody>
        <tr style="background-color:#f1f1f1;">
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
        </tr>';
        
// Retrieving referees data
$referees = json_decode($facultyDetails['refrees'], true) ?? [];
if (!empty($referees)) {
    foreach ($referees as $index => $referee) {
        $html .= '<tr>
            <!-- You can add a serial number if needed -->
            <td>' . ($referee['name'] ?? '') . '</td>
            <td>' . ($referee['position'] ?? '') . '</td>
            <td>' . ($referee['association'] ?? '') . '</td>
            <td>' . ($referee['institution'] ?? '') . '</td>
            <td>' . ($referee['email'] ?? '') . '</td>
            <td>' . ($referee['contact'] ?? '') . '</td>
        </tr>';
    }
}

$html .= '</tbody>
</table>
<br>
<br>';

// Signature image path
$signatureImagePath = $uploadsDir . 'Signature.jpg';

$html .= '<span class="label">23. Final Declaration</span><br>
<table class="tab">
    <tbody>
        <tr><td>                
            I hereby declare that I have carefully read and understood the instructions and particulars mentioned in the advertisment and this application form. I further declare that all the entries along with the attachments uploaded in this form are true to the best of my knowledge and belief
        </td></tr>
    </tbody>
</table>
<br>
<img src="' . $signatureImagePath . '" style="height:50;"><br>
Signature of Applicant
</div>
</div>';

// Create a new TCPDF object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Author');
$pdf->SetTitle('Title');
$pdf->SetSubject('Subject');
$pdf->SetKeywords('Keywords');

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage();

$error_reporting = error_reporting();
error_reporting($error_reporting & ~E_WARNING);
$pdf->writeHTML($html, true, false, true, false, '');
// Restore error reporting
error_reporting($error_reporting);

// Output the PDF
$pdf->Output('application.pdf', 'I'); // 'I' stands for "display in browser"

// Save the PDF in the server-side
file_put_contents($uploadsDir . 'application.pdf', $pdf->Output('', 'S'));
?>
