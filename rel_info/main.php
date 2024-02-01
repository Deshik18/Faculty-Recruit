<?php
// retrieve.php
include '../config.php';
include '../check_session.php';

// Get the email from the session
$sessionEmail = $_SESSION['email'];

// Example: Retrieve data from the faculty_details table
$sql = "SELECT research_statement, teaching_statement, rel_info, prof_service, journal_publications, conference_publications
        FROM faculty_details
        WHERE email = '$sessionEmail'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $researchStatement = $row['research_statement'];
    $teachingStatement = $row['teaching_statement'];
    $relInfo = $row['rel_info'];
    $profService = $row['prof_service'];
    $journalPublications = $row['journal_publications'];
    $conferencePublications = $row['conference_publications'];
} else {
    echo "No data found";
}

$conn->close();
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
    <script type="text/javascript" src="./Rel Info(7)_files/config.js.download"></script>
    <link rel="stylesheet" type="text/css" href="./Rel Info(7)_files/editor.css">
    <script type="text/javascript" src="./Rel Info(7)_files/en.js.download"></script>
    <script type="text/javascript" src="./Rel Info(7)_files/styles.js.download"></script>
    <link rel="stylesheet" type="text/css" href="./Rel Info(7)_files/scayt.css">
    <link rel="stylesheet" type="text/css" href="./Rel Info(7)_files/dialog.css">
    <link rel="stylesheet" type="text/css" href="./Rel Info(7)_files/tableselection.css">
    <link rel="stylesheet" type="text/css" href="./Rel Info(7)_files/dialog(1).css">

    <script type="text/javascript" src="./Rel Info(7)_files/ckeditor.js.download"></script>

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
    <script src="https://cdn.tiny.cloud/1/sff91z3m43jbjf600o1wyrzz0utxilczyt6pjpnlzolmh5ae/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

    <script type="text/javascript" src="./Rel Info(7)_files/ckeditor.js.download"></script>

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
                                <div class="panel-heading">14. Significant research contribution and future plans *<small class="pull-right">(not more than 500 words)</small> <br><small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Patna in a 2-3 years time frame)</small></div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Significant research contribution and future plans" class="form-control input-md" name="research_statement" maxlength="3500"><?php echo empty($researchStatement) ? '' : $researchStatement; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="panel panel-success ">
                                <div class="panel-heading">15. Significant teaching contribution and future plans * <small>(Please list UG/PG courses that you would like to develop and/or teach at IIT Patna)</small> <small class="pull-right"> (not more than 500 words)</small></div>
                                <div class="panel-body">
                                    <textarea style="height: 150px;" placeholder="Significant teaching contribution and future plans" class="form-control input-md" name="teaching_statement"><?php echo empty($teachingStatement) ? '' : $teachingStatement; ?></textarea>
                                </div>
                            </div>
                        </div>

                    <!-- Panel 16 -->
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">16. Any other relevant information. <small class="pull-right">(not more than 500 words)</small></div>
                            <div class="panel-body">
                                <textarea style="height: 150px;" placeholder="Any other relevant information" class="form-control input-md" name="rel_in"><?php echo empty($relInfo) ? '' : $relInfo; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 17 -->
                    <div class="col-md-12">
                        <div class="panel panel-success ">
                            <div class="panel-heading">17. Professional Service : Editorship/Reviewership <small class="pull-right">(not more than 500 words)</small></div>
                            <div class="panel-body">
                                <textarea style="height: 150px;" placeholder="Professional Service : Editorship/Reviewership" class="form-control input-md" name="prof_serv"><?php echo empty($profService) ? '' : $profService; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 18 -->
                    <div class="col-md-12">
                        <div class="panel panel-success ">
                            <div class="panel-heading">18. Detailed List of Journal Publications <br>(Including Sr. No., Author's Names, Paper Title, Volume, Issue, Year, Page Nos., Impact Factor (if any), DOI, Status[Published/Accepted] )</div>
                            <div class="panel-body">
                                <textarea style="height: 150px;" placeholder="Detailed List of Journal Publications" class="form-control input-md" name="jour_details"><?php echo empty($journalPublications) ? '' : $journalPublications; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 19 -->
                    <div class="col-md-12">
                        <div class="panel panel-success ">
                            <div class="panel-heading">19. Detailed List of Conference Publications<br>(Including Sr. No., Author's Names, Paper Title, Name of the conference, Year, Page Nos., DOI [If any] )</div>
                            <div class="panel-body">
                                <textarea style="height: 150px;" placeholder="Detailed List of Conference Publications" class="form-control input-md" name="conf_details"><?php echo empty($conferencePublications) ? '' : $conferencePublications; ?></textarea>
                            </div>
                        </div>
                    </div>


                        <div class="form-group">
                        <div class="col-md-1">
                            <a href="../acad_exp/main.php" class="btn btn-primary pull-left">
                            &lt; <!-- HTML entity for the '<' symbol -->
                            </a>
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

            <div id="footer"></div>

            <script type="text/javascript">
                function blinker() {
                    $('.blink_me').fadeOut(500);
                    $('.blink_me').fadeIn(500);
                }

                setInterval(blinker, 1000);
            </script>
        </div>
    </div>
</body>
</html>
