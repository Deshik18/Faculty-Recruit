
<?php
include '../config.php';
include '../check_session.php';

$sum_pub = $best_pub = $book = $chapter = $patent = array(); // Initialize as empty arrays
$scholar_link;
$sql = "SELECT sum_pub, best_pub, book, chap, patent, scholar_link FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($sum_pub_json, $best_pub_json, $book_json, $chapter_json, $patent_json, $scholar_link);
$stmt->fetch();
$stmt->close();

$patent = json_decode($patent_json, true);
$sum_pub = json_decode($sum_pub_json, true);
$best_pub = json_decode($best_pub_json, true);
$book = json_decode($book_json, true);
$chapter = json_decode($chapter_json, true);

?>
<!-- saved from url=(0054)https://ofa.iiti.ac.in/facrec_che_2023_july_02/publish -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Publication Details</title>
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

	
<style type="text/css">
	body { background-color: lightgray; padding-top:0px!important;}

</style></head>

<body>
<div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
        	<div class="col-md-8 col-md-offset-2">

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> -->

        		<h3 style="text-align:center;color:#414002!important;font-weight: bold;font-size: 2.3em; margin-top: 3px; font-family: &#39;Noto Sans&#39;, sans-serif;">भारतीय प्रौद्योगिकी संस्थान इंदौर</h3>
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: &#39;Oswald&#39;, sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Indore</h3>
    			

        	</div>
        	

    	   
        </div>
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
   </div> 
			<h3 style="color: rgb(225, 4, 37); margin-bottom: 20px; font-weight: bold; text-align: center; font-family: &quot;Noto Serif&quot;, serif; opacity: 0.98929;" class="blink_me">Application for Faculty Position</h3>

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
                $('#dob').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            });
</script>

<script type="text/javascript">
var tr = "";
var counter_jour = 1;
var counter_book = 1;
var counter_book_chapter = 1;
var counter_patent = 1;
$(document).ready(function () {
    $("#add_more_jour").click(function () {
        create_tr();
        create_serial('jour');
        create_input('author[]', 'Author', 'author' + counter_jour, 'jour', counter_jour, 'jour');
        create_input('title[]', 'Title', 'title' + counter_jour, 'jour', counter_jour, 'jour');
        create_input('journal[]', 'Journal', 'journal' + counter_jour, 'jour', counter_jour, 'jour');
        create_input('year[]', 'Year, Vol., Page', 'year' + counter_jour, 'jour', counter_jour, 'jour');
        create_input('impact[]', 'Impact Factor', 'impact' + counter_jour, 'jour', counter_jour, 'jour');
        create_input('doi[]', 'DOI', 'doi' + counter_jour, 'jour', counter_jour, 'jour');
        create_input('status[]', 'Status', 'status' + counter_jour, 'jour', counter_jour, 'jour', true, true);
        counter_jour++;
        return false;
    });

    $("#add_more_book").click(function () {
        create_tr();
        create_serial('book');
        create_input('bauthor[]', 'Book', 'bauthor' + counter_book, 'book', counter_book, 'book');
        create_input('btitle[]', 'Title of the Book', 'btitle' + counter_book, 'book', counter_book, 'book');
        create_input('byear[]', 'Year', 'byear' + counter_book, 'book', counter_book, 'book', false, false, false, false, true);
        create_input('bisbn[]', 'ISBN', 'bisbn' + counter_book, 'book', counter_book, 'book', true);
        counter_book++;
        return false;
    });

    $("#add_more_book_chapter").click(function () {
        create_tr();
        create_serial('book_chapter');
        create_input('bc_author[]', 'Book Chapter', 'bc_author' + counter_book_chapter, 'book_chapter', counter_book_chapter, 'book_chapter');
        create_input('bc_title[]', 'Title', 'bc_title' + counter_book_chapter, 'book_chapter', counter_book_chapter, 'book_chapter');
        create_input('bc_year[]', 'Year', 'bc_year' + counter_book_chapter, 'book_chapter', counter_book_chapter, 'book_chapter', false, false, false, false, true);
        create_input('bc_isbn[]', 'ISBN', 'bc_isbn' + counter_book_chapter, 'book_chapter', counter_book_chapter, 'book_chapter', true);
        counter_book_chapter++;
        return false;
    });

    $("#add_more_patent").click(function () {
        create_tr();
        create_serial('patent');
        create_input('pauthor[]', 'Inventor(s)', 'pauthor' + counter_patent, 'patent', counter_patent, 'patent');
        create_input('ptitle[]', 'Title of Patent', 'ptitle' + counter_patent, 'patent', counter_patent, 'patent');
        create_input('p_country[]', 'Country of Patent', 'p_country' + counter_patent, 'patent', counter_patent, 'patent', false, false, false, true);
        create_input('p_number[]', 'Patent Number', 'p_number' + counter_patent, 'patent', counter_patent, 'patent');
        create_input('pyear_filed[]', 'DD/MM/YYYY', 'pyear_filed' + counter_patent, 'patent', counter_patent, 'patent', false, false, true);
        create_input('pyear_published[]', 'DD/MM/YYYY', 'pyear_published' + counter_patent, 'patent', counter_patent, 'patent', false, false, true);
        create_input('pyear_issued[]', 'Status', 'pyear_issued' + counter_patent, 'patent', counter_patent, 'patent', true, true);
        counter_patent++;
        return false;
    });
});

function create_tr() {
    tr = document.createElement("tr");
}

function create_serial(tbody_id) {
    var td = document.createElement("td");
    var x = document.getElementById(tbody_id).rows.length;
    if(tbody_id==='jour'){
        x = x+1;
    }
    td.innerHTML = x;
    tr.appendChild(td);
}

function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn = false, select = false, datepicker = false, country_dropdown = false, year_dropdown = false) {
    var td = document.createElement("td");
    if (year_dropdown) {
        // Add year dropdown
        var yearSel = document.createElement("select");
        yearSel.setAttribute("name", "year_dropdown_" + counter);
        yearSel.setAttribute("class", "form-control input-md");
        var currentYear = new Date().getFullYear();
        for (var year = 1950; year <= currentYear; year++) {
            yearSel.innerHTML += "<option value='" + year + "'>" + year + "</option>";
        }
        td.appendChild(yearSel);
    }

    if (country_dropdown) {
        // Add country dropdown
        var countrySel = document.createElement("select");
        countrySel.setAttribute("name", "country_dropdown_" + counter);
        countrySel.setAttribute("class", "form-control input-md");
        countrySel.innerHTML += "<option>Afghanistan</option>";
        countrySel.innerHTML += "<option>Aland Islands</option>";
        countrySel.innerHTML += "<option>Albania</option>";
        countrySel.innerHTML += "<option>Algeria</option>";
        countrySel.innerHTML += "<option>American Samoa</option>";
        countrySel.innerHTML += "<option>Andorra</option>";
        countrySel.innerHTML += "<option>Angola</option>";
        countrySel.innerHTML += "<option>Anguilla</option>";
        countrySel.innerHTML += "<option>Antarctica</option>";
        countrySel.innerHTML += "<option>Antigua and Barbuda</option>";
        countrySel.innerHTML += "<option>Argentina</option>";
        countrySel.innerHTML += "<option>Armenia</option>";
        countrySel.innerHTML += "<option>Aruba</option>";
        countrySel.innerHTML += "<option>Australia</option>";
        countrySel.innerHTML += "<option>Austria</option>";
        countrySel.innerHTML += "<option>Azerbaijan</option>";
        countrySel.innerHTML += "<option>Bahamas</option>";
        countrySel.innerHTML += "<option>Bahrain</option>";
        countrySel.innerHTML += "<option>Bangladesh</option>";
        countrySel.innerHTML += "<option>Barbados</option>";
        countrySel.innerHTML += "<option>Belarus</option>";
        countrySel.innerHTML += "<option>Belgium</option>";
        countrySel.innerHTML += "<option>Belize</option>";
        countrySel.innerHTML += "<option>Benin</option>";
        countrySel.innerHTML += "<option>Bermuda</option>";
        countrySel.innerHTML += "<option>Bhutan</option>";
        countrySel.innerHTML += "<option>Bolivia</option>";
        countrySel.innerHTML += "<option>Bosnia and Herzegovina</option>";
        countrySel.innerHTML += "<option>Botswana</option>";
        countrySel.innerHTML += "<option>Bouvet Island</option>";
        countrySel.innerHTML += "<option>Brazil</option>";
        countrySel.innerHTML += "<option>British Indian Ocean Territory</option>";
        countrySel.innerHTML += "<option>Brunei Darussalam</option>";
        countrySel.innerHTML += "<option>Bulgaria</option>";
        countrySel.innerHTML += "<option>Burkina Faso</option>";
        countrySel.innerHTML += "<option>Burundi</option>";
        countrySel.innerHTML += "<option>Cambodia</option>";
        countrySel.innerHTML += "<option>Cameroon</option>";
        countrySel.innerHTML += "<option>Canada</option>";
        countrySel.innerHTML += "<option>Cape Verde</option>";
        countrySel.innerHTML += "<option>Cayman Islands</option>";
        countrySel.innerHTML += "<option>Central African Republic</option>";
        countrySel.innerHTML += "<option>Chad</option>";
        countrySel.innerHTML += "<option>Chile</option>";
        countrySel.innerHTML += "<option>China</option>";
        countrySel.innerHTML += "<option>Christmas Island</option>";
        countrySel.innerHTML += "<option>Cocos (Keeling) Islands</option>";
        countrySel.innerHTML += "<option>Colombia</option>";
        countrySel.innerHTML += "<option>Comoros</option>";
        countrySel.innerHTML += "<option>Congo</option>";
        countrySel.innerHTML += "<option>Congo, The Democratic Republic of The</option>";
        countrySel.innerHTML += "<option>Cook Islands</option>";
        countrySel.innerHTML += "<option>Costa Rica</option>";
        countrySel.innerHTML += "<option>Cote D'ivoire</option>";
        countrySel.innerHTML += "<option>Croatia</option>";
        countrySel.innerHTML += "<option>Cuba</option>";
        countrySel.innerHTML += "<option>Cyprus</option>";
        countrySel.innerHTML += "<option>Czech Republic</option>";
        countrySel.innerHTML += "<option>Denmark</option>";
        countrySel.innerHTML += "<option>Djibouti</option>";
        countrySel.innerHTML += "<option>Dominica</option>";
        countrySel.innerHTML += "<option>Dominican Republic</option>";
        countrySel.innerHTML += "<option>Ecuador</option>";
        countrySel.innerHTML += "<option>Egypt</option>";
        countrySel.innerHTML += "<option>El Salvador</option>";
        countrySel.innerHTML += "<option>Equatorial Guinea</option>";
        countrySel.innerHTML += "<option>Eritrea</option>";
        countrySel.innerHTML += "<option>Estonia</option>";
        countrySel.innerHTML += "<option>Ethiopia</option>";
        countrySel.innerHTML += "<option>Falkland Islands (Malvinas)</option>";
        countrySel.innerHTML += "<option>Faroe Islands</option>";
        countrySel.innerHTML += "<option>Fiji</option>";
        countrySel.innerHTML += "<option>Finland</option>";
        countrySel.innerHTML += "<option>France</option>";
        countrySel.innerHTML += "<option>French Guiana</option>";
        countrySel.innerHTML += "<option>French Polynesia</option>";
        countrySel.innerHTML += "<option>French Southern Territories</option>";
        countrySel.innerHTML += "<option>Gabon</option>";
        countrySel.innerHTML += "<option>Gambia</option>";
        countrySel.innerHTML += "<option>Georgia</option>";
        countrySel.innerHTML += "<option>Germany</option>";
        countrySel.innerHTML += "<option>Ghana</option>";
        countrySel.innerHTML += "<option>Gibraltar</option>";
        countrySel.innerHTML += "<option>Greece</option>";
        countrySel.innerHTML += "<option>Greenland</option>";
        countrySel.innerHTML += "<option>Grenada</option>";
        countrySel.innerHTML += "<option>Guadeloupe</option>";
        countrySel.innerHTML += "<option>Guam</option>";
        countrySel.innerHTML += "<option>Guatemala</option>";
        countrySel.innerHTML += "<option>Guernsey</option>";
        countrySel.innerHTML += "<option>Guinea</option>";
        countrySel.innerHTML += "<option>Guinea-bissau</option>";
        countrySel.innerHTML += "<option>Guyana</option>";
        countrySel.innerHTML += "<option>Haiti</option>";
        countrySel.innerHTML += "<option>Heard Island and Mcdonald Islands</option>";
        countrySel.innerHTML += "<option>Holy See (Vatican City State)</option>";
        countrySel.innerHTML += "<option>Honduras</option>";
        countrySel.innerHTML += "<option>Hong Kong</option>";
        countrySel.innerHTML += "<option>Hungary</option>";
        countrySel.innerHTML += "<option>Iceland</option>";
        countrySel.innerHTML += "<option>India</option>";
        countrySel.innerHTML += "<option>Indonesia</option>";
        countrySel.innerHTML += "<option>Iran, Islamic Republic of</option>";
        countrySel.innerHTML += "<option>Iraq</option>";
        countrySel.innerHTML += "<option>Ireland</option>";
        countrySel.innerHTML += "<option>Isle of Man</option>";
        countrySel.innerHTML += "<option>Israel</option>";
        countrySel.innerHTML += "<option>Italy</option>";
        countrySel.innerHTML += "<option>Jamaica</option>";
        countrySel.innerHTML += "<option>Japan</option>";
        countrySel.innerHTML += "<option>Jersey</option>";
        countrySel.innerHTML += "<option>Jordan</option>";
        countrySel.innerHTML += "<option>Kazakhstan</option>";
        countrySel.innerHTML += "<option>Kenya</option>";
        countrySel.innerHTML += "<option>Kiribati</option>";
        countrySel.innerHTML += "<option>Korea, Democratic People's Republic of</option>";
        countrySel.innerHTML += "<option>Korea, Republic of</option>";
        countrySel.innerHTML += "<option>Kuwait</option>";
        countrySel.innerHTML += "<option>Kyrgyzstan</option>";
        countrySel.innerHTML += "<option>Lao People's Democratic Republic</option>";
        countrySel.innerHTML += "<option>Latvia</option>";
        countrySel.innerHTML += "<option>Lebanon</option>";
        countrySel.innerHTML += "<option>Lesotho</option>";
        countrySel.innerHTML += "<option>Liberia</option>";
        countrySel.innerHTML += "<option>Libyan Arab Jamahiriya</option>";
        countrySel.innerHTML += "<option>Liechtenstein</option>";
        countrySel.innerHTML += "<option>Lithuania</option>";
        countrySel.innerHTML += "<option>Luxembourg</option>";
        countrySel.innerHTML += "<option>Macao</option>";
        countrySel.innerHTML += "<option>Macedonia, The Former Yugoslav Republic of</option>";
        countrySel.innerHTML += "<option>Madagascar</option>";
        countrySel.innerHTML += "<option>Malawi</option>";
        countrySel.innerHTML += "<option>Malaysia</option>";
        countrySel.innerHTML += "<option>Maldives</option>";
        countrySel.innerHTML += "<option>Mali</option>";
        countrySel.innerHTML += "<option>Malta</option>";
        countrySel.innerHTML += "<option>Marshall Islands</option>";
        countrySel.innerHTML += "<option>Martinique</option>";
        countrySel.innerHTML += "<option>Mauritania</option>";
        countrySel.innerHTML += "<option>Mauritius</option>";
        countrySel.innerHTML += "<option>Mayotte</option>";
        countrySel.innerHTML += "<option>Mexico</option>";
        countrySel.innerHTML += "<option>Micronesia, Federated States of</option>";
        countrySel.innerHTML += "<option>Moldova, Republic of</option>";
        countrySel.innerHTML += "<option>Monaco</option>";
        countrySel.innerHTML += "<option>Mongolia</option>";
        countrySel.innerHTML += "<option>Montenegro</option>";
        countrySel.innerHTML += "<option>Montserrat</option>";
        countrySel.innerHTML += "<option>Morocco</option>";
        countrySel.innerHTML += "<option>Mozambique</option>";
        countrySel.innerHTML += "<option>Myanmar</option>";
        countrySel.innerHTML += "<option>Namibia</option>";
        countrySel.innerHTML += "<option>Nauru</option>";
        countrySel.innerHTML += "<option>Nepal</option>";
        countrySel.innerHTML += "<option>Netherlands</option>";
        countrySel.innerHTML += "<option>Netherlands Antilles</option>";
        countrySel.innerHTML += "<option>New Caledonia</option>";
        countrySel.innerHTML += "<option>New Zealand</option>";
        countrySel.innerHTML += "<option>Nicaragua</option>";
        countrySel.innerHTML += "<option>Niger</option>";
        countrySel.innerHTML += "<option>Nigeria</option>";
        countrySel.innerHTML += "<option>Niue</option>";
        countrySel.innerHTML += "<option>Norfolk Island</option>";
        countrySel.innerHTML += "<option>Northern Mariana Islands</option>";
        countrySel.innerHTML += "<option>Norway</option>";
        countrySel.innerHTML += "<option>Oman</option>";
        countrySel.innerHTML += "<option>Pakistan</option>";
        countrySel.innerHTML += "<option>Palau</option>";
        countrySel.innerHTML += "<option>Palestinian Territory, Occupied</option>";
        countrySel.innerHTML += "<option>Panama</option>";
        countrySel.innerHTML += "<option>Papua New Guinea</option>";
        countrySel.innerHTML += "<option>Paraguay</option>";
        countrySel.innerHTML += "<option>Peru</option>";
        countrySel.innerHTML += "<option>Philippines</option>";
        countrySel.innerHTML += "<option>Pitcairn</option>";
        countrySel.innerHTML += "<option>Poland</option>";
        countrySel.innerHTML += "<option>Portugal</option>";
        countrySel.innerHTML += "<option>Puerto Rico</option>";
        countrySel.innerHTML += "<option>Qatar</option>";
        countrySel.innerHTML += "<option>Reunion</option>";
        countrySel.innerHTML += "<option>Romania</option>";
        countrySel.innerHTML += "<option>Russian Federation</option>";
        countrySel.innerHTML += "<option>Rwanda</option>";
        countrySel.innerHTML += "<option>Saint Helena</option>";
        countrySel.innerHTML += "<option>Saint Kitts and Nevis</option>";
        countrySel.innerHTML += "<option>Saint Lucia</option>";
        countrySel.innerHTML += "<option>Saint Pierre and Miquelon</option>";
        countrySel.innerHTML += "<option>Saint Vincent and The Grenadines</option>";
        countrySel.innerHTML += "<option>Samoa</option>";
        countrySel.innerHTML += "<option>San Marino</option>";
        countrySel.innerHTML += "<option>Sao Tome and Principe</option>";
        countrySel.innerHTML += "<option>Saudi Arabia</option>";
        countrySel.innerHTML += "<option>Senegal</option>";
        countrySel.innerHTML += "<option>Serbia</option>";
        countrySel.innerHTML += "<option>Seychelles</option>";
        countrySel.innerHTML += "<option>Sierra Leone</option>";
        countrySel.innerHTML += "<option>Singapore</option>";
        countrySel.innerHTML += "<option>Slovakia</option>";
        countrySel.innerHTML += "<option>Slovenia</option>";
        countrySel.innerHTML += "<option>Solomon Islands</option>";
        countrySel.innerHTML += "<option>Somalia</option>";
        countrySel.innerHTML += "<option>South Africa</option>";
        countrySel.innerHTML += "<option>South Georgia and The South Sandwich Islands</option>";
        countrySel.innerHTML += "<option>Spain</option>";
        countrySel.innerHTML += "<option>Sri Lanka</option>";
        countrySel.innerHTML += "<option>Sudan</option>";
        countrySel.innerHTML += "<option>Suriname</option>";
        countrySel.innerHTML += "<option>Svalbard and Jan Mayen</option>";
        countrySel.innerHTML += "<option>Swaziland</option>";
        countrySel.innerHTML += "<option>Sweden</option>";
        countrySel.innerHTML += "<option>Switzerland</option>";
        countrySel.innerHTML += "<option>Syrian Arab Republic</option>";
        countrySel.innerHTML += "<option>Taiwan</option>";
        countrySel.innerHTML += "<option>Tajikistan</option>";
        countrySel.innerHTML += "<option>Tanzania, United Republic of</option>";
        countrySel.innerHTML += "<option>Thailand</option>";
        countrySel.innerHTML += "<option>Timor-leste</option>";
        countrySel.innerHTML += "<option>Togo</option>";
        countrySel.innerHTML += "<option>Tokelau</option>";
        countrySel.innerHTML += "<option>Tonga</option>";
        countrySel.innerHTML += "<option>Trinidad and Tobago</option>";
        countrySel.innerHTML += "<option>Tunisia</option>";
        countrySel.innerHTML += "<option>Turkey</option>";
        countrySel.innerHTML += "<option>Turkmenistan</option>";
        countrySel.innerHTML += "<option>Turks and Caicos Islands</option>";
        countrySel.innerHTML += "<option>Tuvalu</option>";
        countrySel.innerHTML += "<option>Uganda</option>";
        countrySel.innerHTML += "<option>Ukraine</option>";
        countrySel.innerHTML += "<option>United Arab Emirates</option>";
        countrySel.innerHTML += "<option>United Kingdom</option>";
        countrySel.innerHTML += "<option>United States</option>";
        countrySel.innerHTML += "<option>Uruguay</option>";
        countrySel.innerHTML += "<option>Uzbekistan</option>";
        countrySel.innerHTML += "<option>Vanuatu</option>";
        countrySel.innerHTML += "<option>Venezuela</option>";
        countrySel.innerHTML += "<option>Viet Nam</option>";
        countrySel.innerHTML += "<option>Virgin Islands, British</option>";
        countrySel.innerHTML += "<option>Virgin Islands, U.S.</option>";
        countrySel.innerHTML += "<option>Wallis and Futuna</option>";
        countrySel.innerHTML += "<option>Western Sahara</option>";
        countrySel.innerHTML += "<option>Yemen</option>";
        countrySel.innerHTML += "<option>Zambia</option>";
        countrySel.innerHTML += "<option>Zimbabwe</option>";
        td.appendChild(countrySel);
    }

    if (select == false && country_dropdown==false && year_dropdown==false) {
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", t_name);
        input.setAttribute("id", id);
        input.setAttribute("placeholder", place_value);
        input.setAttribute("class", "form-control input-md");
        input.setAttribute("required", "");

        td.appendChild(input);

        if (datepicker) {
            // Add datepicker functionality using Pikaday
            var picker = new Pikaday({
                field: input,
                format: 'DD/MM/YYYY', // Adjust the date format as needed
                yearRange: [1950, new Date().getFullYear()] // Set the range of selectable years
            });
        }
    }

    if (select == true) {
        var sel = document.createElement("select");
        sel.setAttribute("name", t_name);
        sel.setAttribute("id", id);
        sel.setAttribute("class", "form-control input-md");
        sel.innerHTML += "<option>Select</option>";
        sel.innerHTML += "<option value='Filed'>Filed</option>";
        sel.innerHTML += "<option value='Published'>Published</option>";
        sel.innerHTML += "<option value='Granted'>Granted</option>";

        td.appendChild(sel);
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
}


function remove_row(remove_name, n, tbody_id) {
    var tab = document.getElementById(tbody_id);
    var tr = document.getElementById("row" + n);
    tab.removeChild(tr);
    
    // Update the row numbers
    var rows = tab.getElementsByTagName("tr");
    for (var i = 0; i < rows.length; i++) {
        rows[i].getElementsByTagName("td")[0].textContent = i + 1;
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
    var rows = document.querySelectorAll('#jour tr:not(:first-child)');

    rows.forEach(function (row, index) {
        row.querySelector('td:first-child').textContent = index + 1;
    });
}

function initPikaday(inputId) {
    var inputElement = document.getElementById(inputId);
    if (inputElement) {
        var picker = new Pikaday({
            field: inputElement,
            format: 'DD/MM/YYYY', // Adjust the date format as needed
            yearRange: [1950, new Date().getFullYear()] // Set the range of selectable years
        });
    }
}

</script>

        
<!-- all bootstrap buttons classes -->
<!-- 
  class="btn btn-sm, btn-lg, "
  color - btn-success, btn-primary, btn-default, btn-danger, btn-info, btn-warning
-->

<div class="container">
  
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 well">
            <form class="form-horizontal" action="process.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="ci_csrf_token" value="">
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

             

    
            <!-- Form Name -->
            
              
            <!-- Text input-->
           
            <h4 style="text-align:center; font-weight: bold; color: #6739bb;">5. Summary of Publications *</h4>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-success">
                  <div class="panel-body">
                    <span class="col-md-5 control-label" for="summary_journal_inter">Number of International Journal Papers</span>
                    <div class="col-md-1">
                      <input id="summary_journal_inter" value="<?php echo isset($sum_pub['summary_journal_inter']) ? $sum_pub['summary_journal_inter'] : ''; ?>" name="summary_journal_inter" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                    </div>

                    <span class="col-md-5 control-label" for="summary_journal">Number of National Journal Papers</span>
                    <div class="col-md-1">
                      <input id="summary_journal" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_journal', $sum_pub)) ? $sum_pub['summary_journal'] : ''; ?>" name="summary_journal" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                    </div>

                    <span class="col-md-5 control-label" for="summary_conf_inter">Number of International Conference Papers</span>
                    <div class="col-md-1">
                      <input id="summary_conf_inter" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_conf_inter', $sum_pub)) ? $sum_pub['summary_conf_inter'] : ''; ?>" name="summary_conf_inter" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                    </div>

                    <span class="col-md-5 control-label" for="summary_conf_national">Number of National Conference Papers</span>
                    <div class="col-md-1">
                      <input id="summary_conf_national" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_conf_national', $sum_pub)) ? $sum_pub['summary_conf_national'] : ''; ?>" name="summary_conf_national" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                    </div>

                    <span class="col-md-5 control-label" for="patent_publish">Number of Patent(s) [Filed, Published, Granted] </span>
                    <div class="col-md-1">
                      <input id="patent_publish" value="<?php echo (is_array($sum_pub) && array_key_exists('patent_publish', $sum_pub)) ? $sum_pub['patent_publish'] : ''; ?>" name="patent_publish" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                    </div>

                    <span class="col-md-5 control-label" for="summary_book">Number of Book(s) </span>
                    <div class="col-md-1">
                      <input id="summary_book" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_book', $sum_pub)) ? $sum_pub['summary_book'] : ''; ?>" name="summary_book" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                    </div>

                    <span class="col-md-5 control-label" for="summary_book_chapter">Number of Book Chapter(s)</span>
                    <div class="col-md-1">
                      <input id="summary_book_chapter" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_book_chapter', $sum_pub)) ? $sum_pub['summary_book_chapter'] : ''; ?>" name="summary_book_chapter" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                    </div>
                  </div>
                </div>
              </div>
            </div>
   

           
            <h4 style="text-align:center; font-weight: bold; color: #6739bb;">6. List of 10 Best Publications (Journal/Conference)</h4>

<div class="container-fluid table-responsive">
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                List of 10 Best Publications (Journal/Conference) &nbsp;&nbsp;&nbsp;
                <button class="btn btn-sm btn-danger" id="add_more_jour">Add Details</button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr height="30px">
                        <th class="col-md-1">S. No.</th>
                        <th class="col-md-2">Author(s)</th>
                        <th class="col-md-2">Title</th>
                        <th class="col-md-2">Name of Journal/Conference</th>
                        <th class="col-md-1">Year, Vol., Page</th>
                        <th class="col-md-1">Impact Factor</th>
                        <th class="col-md-1">DOI</th>
                        <th class="col-md-2">Status Filed/Published/Granted</th>
                    </tr>
                </thead>
                <tbody id="jour">
                    <!-- This part is for displaying saved values from the database -->
                    <?php
                    if (!empty($best_pub)) {
                        foreach ($best_pub as $index => $publication) {
                    ?>
                            <tr height="60px">
                                <td class="col-md-1"><?php echo $index + 1; ?></td>
                                <td class="col-md-2">
                                    <input name="author[]" type="text" class="form-control input-md" value="<?= $publication['author'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <input name="title[]" type="text" class="form-control input-md" value="<?= $publication['title'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <input name="journal[]" type="text" class="form-control input-md" value="<?= $publication['journal'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input name="year[]" type="text" class="form-control input-md" value="<?= $publication['year'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input name="impact[]" type="text" class="form-control input-md" value="<?= $publication['impact'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input name="doi[]" type="text" class="form-control input-md" value="<?= $publication['doi'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <select name="status[]" class="form-control input-md">
                                        <option value="Filed" <?= ($publication['status'] ?? '') == 'Filed' ? 'selected' : '' ?>>Filed</option>
                                        <option value="Published" <?= ($publication['status'] ?? '') == 'Published' ? 'selected' : '' ?>>Published</option>
                                        <option value="Granted" <?= ($publication['status'] ?? '') == 'Granted' ? 'selected' : '' ?>>Granted</option>
                                    </select>
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
 

           <!-- Patent Text -->

             <!-- Patent's info -->
<div class="container-fluid table-responsive">
    <h4 style="text-align:center; font-weight: bold; color: #6739bb;">7. List of Patent(s), Book(s), Book Chapter(s)</h4>
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">(A) Patent(s)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_patent">Add Details</button></div>
            <table class="table table-bordered">
                <tbody id="patent">
                    <!-- Header row for Patent(s) -->
                    <tr height="30px">
                        <th class="col-md-1">S. No.</th>
                        <th class="col-md-1">Inventor(s)</th>
                        <th class="col-md-2">Title of Patent</th>
                        <th class="col-md-1">Country of Patent</th>
                        <th class="col-md-1">Patent Number</th>
                        <th class="col-md-1">Date of Filing</th>
                        <th class="col-md-1">Date of Published</th>
                        <th class="col-md-1">Status Filed/Published/Granted</th>
                        <!-- <th class="col-md-1"> Date of Filed/Published (If not granted, mention "Awaited")</th> -->
                    </tr>
                    <?php
                    if (!empty($patent)) {
                        foreach ($patent as $index => $qualification) {
                    ?>
                            <tr height="60px">
                            <td class="col-md-1"><?php echo $index + 1; ?></td>
                                <td class="col-md-1">
                                    <input id="pauthor<?= $index + 1 ?>" name="pauthor[]" type="text" placeholder="Inventor" class="form-control input-md" autofocus="" value="<?= $qualification['inventor'] ?? '' ?>">
                                </td>
                                <!-- Add more fields as needed -->
                                <td class="col-md-2">
                                    <input id="ptitle<?= $index + 1 ?>" name="ptitle[]" type="text" placeholder="Title of Patent" class="form-control input-md" autofocus="" value="<?= $qualification['title'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <select id="p_country<?= $index + 1 ?>" name="p_country[]" class="form-control input-md" autofocus="">
                                        <option value="">Select Country</option>
                                        <?php
                                        $countries = [
                                            'Afghanistan', 'Aland Islands', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antarctica', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Bouvet Island', 'Brazil', 'British Indian Ocean Territory', 'Brunei Darussalam', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Christmas Island', 'Cocos (Keeling) Islands', 'Colombia', 'Comoros', 'Congo', 'Congo, The Democratic Republic of The', 'Cook Islands', 'Costa Rica', 'Cote D\'ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Falkland Islands (Malvinas)', 'Faroe Islands', 'Fiji', 'Finland', 'France', 'French Guiana', 'French Polynesia', 'French Southern Territories', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea', 'Guinea-bissau', 'Guyana', 'Haiti', 'Heard Island and Mcdonald Islands', 'Holy See (Vatican City State)', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran, Islamic Republic of', 'Iraq', 'Ireland', 'Isle of Man', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jersey', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea, Democratic People\'s Republic of', 'Korea, Republic of', 'Kuwait', 'Kyrgyzstan', 'Lao People\'s Democratic Republic', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libyan Arab Jamahiriya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macao', 'Macedonia, The Former Yugoslav Republic of', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia, Federated States of', 'Moldova, Republic of', 'Monaco', 'Mongolia', 'Montenegro', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'Netherlands Antilles', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestinian Territory, Occupied', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion', 'Romania', 'Russian Federation', 'Rwanda', 'Saint Helena', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Pierre and Miquelon', 'Saint Vincent and The Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Georgia and The South Sandwich Islands', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Svalbard and Jan Mayen', 'Swaziland', 'Sweden', 'Switzerland', 'Syrian Arab Republic', 'Taiwan', 'Tajikistan', 'Tanzania, United Republic of', 'Thailand', 'Timor-leste', 'Togo', 'Tokelau', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'United States Minor Outlying Islands', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Viet Nam', 'Virgin Islands, British', 'Virgin Islands, U.S.', 'Wallis and Futuna', 'Western Sahara', 'Yemen', 'Zambia', 'Zimbabwe'
                                        ];
                                        
                                        foreach ($countries as $country) {
                                            $selected = ($qualification['country'] ?? '') == $country ? 'selected' : '';
                                            echo "<option value='{$country}' {$selected}>{$country}</option>\n";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="col-md-1">
                                    <input id="p_number<?= $index + 1 ?>" name="p_number[]" type="text" placeholder="Patent Number" class="form-control input-md" autofocus="" value="<?= $qualification['number'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input id="year_filed<?= $index + 1 ?>" name="pyear_filed[]" type="text" placeholder="Date of Filing" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['year_filed'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input id="year_published<?= $index + 1 ?>" name="pyear_published[]" type="text" placeholder="Date of Published" class="form-control input-md datepicker" autofocus="" value="<?= $qualification['year_published'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                <select id="status<?= $index + 1 ?>" name="pyear_issued[]" class="form-control input-md" autofocus="">
                                    <option value="Filed" <?= ($qualification['year_issued'] ?? '') == 'Filed' ? 'selected' : '' ?>>Filed</option>
                                    <option value="Published" <?= ($qualification['year_issued'] ?? '') == 'Published' ? 'selected' : '' ?>>Published</option>
                                    <option value="Granted" <?= ($qualification['year_issued'] ?? '') == 'Granted' ? 'selected' : '' ?>>Granted</option>
                                </select>
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

<!-- Book's info -->
<div class="container-fluid table-responsive">
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">(B) Book(s)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_book">Add Details</button></div>
            <table class="table table-bordered">
                <tbody id="book">
                    <!-- Header row for Book(s) -->
                    <tr height="30px">
                        <th class="col-md-1">S. No.</th>
                        <th class="col-md-2">Author(s)</th>
                        <th class="col-md-2">Title of the Book</th>
                        <th class="col-md-2">Year of Publication</th>
                        <th class="col-md-2">ISBN</th>
                        <!-- Add more book fields as needed -->
                    </tr>
                    <?php
                    if (!empty($book)) {
                        foreach ($book as $index => $qualification) {
                    ?>
                            <tr height="60px">
                                <td class="col-md-1"><?php echo $index + 1; ?></td>
                                <td class="col-md-2">
                                    <input id="bauthor<?= $index + 1 ?>" name="bauthor[]" type="text" placeholder="Author(s)" class="form-control input-md" autofocus="" value="<?= $qualification['bauthor'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <input id="btitle<?= $index + 1 ?>" name="btitle[]" type="text" placeholder="Title of the Book" class="form-control input-md" autofocus="" value="<?= $qualification['btitle'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <select id="byear<?= $index + 1 ?>" name="byear[]" class="form-control input-md" autofocus="">
                                        <option value="">Select Year</option>
                                        <?php
                                        $currentYear = date("Y");
                                        for ($year = $currentYear; $year >= 1950; $year--) {
                                            $selected = ($qualification['byear'] ?? '') == $year ? 'selected' : '';
                                            echo "<option value='{$year}' {$selected}>{$year}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="col-md-2">
                                    <input id="bisbn<?= $index + 1 ?>" name="bisbn[]" type="text" placeholder="ISBN" class="form-control input-md" autofocus="" value="<?= $qualification['bisbn'] ?? '' ?>">
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

<!-- Book Chapter's info -->
<div class="container-fluid table-responsive">
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">(C) Book Chapter(s)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_book_chapter">Add Details</button></div>
            <table class="table table-bordered">
                <tbody id="book_chapter">
                    <!-- Header row for Book Chapter(s) -->
                    <tr height="30px">
                        <th class="col-md-1">S. No.</th>
                        <th class="col-md-2">Author(s)</th>
                        <th class="col-md-2">Title of the Book Chapter(s)</th>
                        <th class="col-md-2">Year of Publication</th>
                        <th class="col-md-2">ISBN</th>
                        <!-- Add more book chapter fields as needed -->
                    </tr>
                    <?php
                    if (!empty($chapter)) {
                        foreach ($chapter as $index => $qualification) {
                    ?>
                            <tr height="60px">
                                <td class="col-md-1"><?php echo $index + 1; ?></td>
                                <td class="col-md-2">
                                    <input id="bc_author<?= $index + 1 ?>" name="bc_author[]" type="text" placeholder="Author(s)" class="form-control input-md" autofocus="" value="<?= $qualification['author'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <input id="bc_title<?= $index + 1 ?>" name="bc_title[]" type="text" placeholder="Title of the Book Chapter(s)" class="form-control input-md" autofocus="" value="<?= $qualification['title'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <select id="bc_year<?= $index + 1 ?>" name="bc_year[]" class="form-control input-md" autofocus="">
                                        <option value="">Select Year</option>
                                        <?php
                                        $currentYear = date("Y");
                                        for ($year = $currentYear; $year >= 1950; $year--) {
                                            $selected = ($qualification['year'] ?? '') == $year ? 'selected' : '';
                                            echo "<option value='{$year}' {$selected}>{$year}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="col-md-2">
                                    <input id="bc_isbn<?= $index + 1 ?>" name="bc_isbn[]" type="text" placeholder="ISBN" class="form-control input-md" autofocus="" value="<?= $qualification['isbn'] ?? '' ?>">
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


<h4 style="text-align:center; font-weight: bold; color: #6739bb;">8. Google Scholar Link *</h4>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">URL</div>
            <div class="panel-body">
                <span class="col-md-2 control-label" for="google_link">Google Scholar Link </span>  
                <div class="col-md-10">
                    <?php if (empty($scholar_link)): ?>
                        <input id="google_link" value="" name="google_link" type="text" placeholder="Google Scholar Link" class="form-control input-md" required="">
                    <?php else: ?>
                        <input id="google_link" value="<?= $scholar_link ?>" name="google_link" type="text" placeholder="Google Scholar Link" class="form-control input-md" required="">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



            <!-- Button -->
<!-- <div class="form-group">

  <div class="col-md-1">
    <a href="../emp_det/main.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
  </div>

<div class="col-md-11">
  <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE &amp; NEXT</button>
  
</div> -->

<div class="form-group">
  <div class="col-md-1">
    <a href="../emp_det/main.php" class="btn btn-primary pull-left">
      &lt; <!-- HTML entity for the '<' symbol -->
    </a>
  </div>

  <div class="col-md-6">
    <span class="pull-right" style="margin-right: 20px;">Page 4/9</span>
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

<div id="footer"></div>

<script>
    <?php
    if (!empty($patent)) {
        foreach ($patent as $index => $qualification) {
    ?>
            initPikaday("year_filed<?= $index + 1 ?>");
            initPikaday("year_published<?= $index + 1 ?>");
    <?php
        }
    }
    ?>
</script>

<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script></body></html>