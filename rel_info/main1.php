<?php
// retrieve.php
include '../config.php';
include '../check_session.php';

// Get the email from the session
$sessionEmail = $_SESSION['email'];

// Retrieve data from the faculty_details table
$sql = "SELECT research_statement, teaching_statement, rel_info, prof_service, journal_publications, conference_publications
        FROM faculty_details
        WHERE email = '$sessionEmail'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $researchStatement = nl2br($row['research_statement']);
    $teachingStatement = nl2br($row['teaching_statement']);
    $relInfo = nl2br($row['rel_info']);
    $profService = nl2br($row['prof_service']);
    $journalPublications = nl2br($row['journal_publications']);
    $conferencePublications = nl2br($row['conference_publications']);
}
?>
<?php
// process.php
include '../config.php';

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

echo $uploadsDir;

// Check if the conference_publications.pdf file exists in the uploads directory
$conferencePublicationsDoc = '';
if (file_exists($uploadsDir . 'conference_publications.pdf')) {
    $conferencePublicationsDoc = 'conference_publications.pdf';
}

$researchDoc = '';
if (file_exists($uploadsDir . 'future_research_plan.pdf')) {
    $researchDoc = 'future_research_plan.pdf';
}

$journalPublicationsDoc = '';
if (file_exists($uploadsDir . 'journal_publications.pdf')) {
    $journalPublicationsDoc = 'journal_publications.pdf';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Rel Info</title>
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
        body { background-color: lightgray; padding-top:0px!important;}
    </style>
    <style>.cke{visibility:hidden;}</style>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>


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

    <h3 style="color: rgb(225, 4, 37); margin-bottom: 20px; font-weight: bold; text-align: center; font-family: 'Noto Serif', serif; opacity: 0.166994;" class="blink_me">Application for Faculty Position</h3>

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
                                <a href="../fac_login/main.html" class="btn btn-sm btn-success pull-right">Logout</a>
                            </div>
                        </div>
                    </legend>

                    <form class="form-horizontal" action="process.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="ci_csrf_token" value="">

                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">14. Significant research contribution and future plans *</div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Significant research contribution and future plans" class="form-control input-md" name="research_statement" maxlength="3500"><?php echo empty($researchStatement) ? '' : $researchStatement; ?></textarea>
                                    <input type="file" name="research_doc" class="form-control input-md" value="<?php echo $researchDoc; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">15. Significant teaching contribution and future plans *</div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Significant teaching contribution and future plans" class="form-control input-md" name="teaching_statement" maxlength="3500"><?php echo empty($teachingStatement) ? '' : $teachingStatement; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Panel 16 -->
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading" id="panel-heading-other">16. Any other relevant information. <small class="pull-right">(not more than 500 words)</small></div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Any other relevant information" class="form-control input-md" name="rel_in" id="other_info"><?php echo empty($relInfo) ? '' : $relInfo; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Panel 17 -->
                        <div class="col-md-12">
                            <div class="panel panel-success ">
                                <div class="panel-heading" id="panel-heading-service">17. Professional Service : Editorship/Reviewership <small class="pull-right">(not more than 500 words)</small></div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Professional Service : Editorship/Reviewership" class="form-control input-md" name="prof_serv" id="prof_service"><?php echo empty($profService) ? '' : $profService; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Panel 18 -->
                        <div class="col-md-12">
                            <div class="panel panel-success ">
                                <div class="panel-heading" id="panel-heading-journal">18. Detailed List of Journal Publications <br>(Including Sr. No., Author's Names, Paper Title, Volume, Issue, Year, Page Nos., Impact Factor (if any), DOI, Status[Published/Accepted] )</div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Detailed List of Journal Publications" class="form-control input-md" name="jour_details" id="journal_details"><?php echo empty($journalPublications) ? '' : $journalPublications; ?></textarea>
                                    <input type="file" name="jour_publications_doc" class="form-control input-md" value="<?php echo $journalPublicationsDoc; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            `<div class="panel panel-success">
                                <div class="panel-heading" id="panel-heading-conference">19. Detailed List of Conference Publications<br>(Including Sr. No., Author's Names, Paper Title, Name of the conference, Year, Page Nos., DOI [If any] )</div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Detailed List of Conference Publications" class="form-control input-md" name="conf_details" id="conf_details"><?php echo empty($conferencePublications) ? '' : $conferencePublications; ?></textarea>
                                    <input type="file" name="conf_publications_doc" class="form-control input-md" value="<?php echo $conferencePublicationsDoc; ?>">
                                </div>
                            </div>
                        </div>
`

                        <!-- Other Panels -->
                        <!-- (Add similar structures for other panels like "rel_info", "prof_service", etc. with file inputs for uploading documents) -->

                        <div class="form-group">
                            <div class="col-md-1">
                                <a href="../acad_exp/main.php" class="btn btn-primary pull-left">&lt;</a>
                            </div>

                            <div class="col-md-6">
                                <span class="pull-right" style="margin-right: 20px;">Page 7/9</span>
                            </div>

                            <div class="col-md-11">
                                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right" style="margin-left: 75%;">SAVE & NEXT</button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>
