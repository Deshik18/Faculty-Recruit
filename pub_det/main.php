
<?php
session_start();
include '../config.php';

$sum_pub = $best_pub = $book = $chapter = $patent = array(); // Initialize as empty arrays
$scholar_link;
$sql = "SELECT sum_pub, best_pub, book, chap, patent, scholar_link FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($sum_pub_json, $best_pub_json, $book_json, $chapter_json, $patent_json, $scholar_link);
$stmt->fetch();
$stmt->close();

$sum_pub = json_decode($sum_pub_json);
$best_pub = json_decode($best_pub_json);
$book = json_decode($book_json);
$chapter = json_decode($chapter_json);
$patent = json_decode($patent_json);

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
var tr="";
var counter_jour=1;
// var counter_confer=1;
var counter_book=1;
var counter_book_chapter=1;
var counter_patent=1;
  $(document).ready(function(){

    $("#add_more_jour").click(function(){
        create_tr();
        create_serial('jour');
        create_input('author[]', 'Author', 'author'+counter_jour,'jour', counter_jour, 'jour');
        create_input('title[]', 'Title', 'title'+counter_jour,'jour', counter_jour, 'jour');
        create_input('journal[]', 'Journal', 'journal'+counter_jour,'jour', counter_jour, 'jour');
        create_input('year[]', 'Year, Vol., Page', 'year'+counter_jour,'jour', counter_jour, 'jour');
        create_input('impact[]', 'Impact Factor','impact'+counter_jour, 'jour', counter_jour, 'jour');
        create_input('doi[]', 'DOI','doi'+counter_jour, 'jour', counter_jour, 'jour');
        create_input('status[]', 'Status', 'status'+counter_jour,'jour', counter_jour,'jour',true, true);
        counter_jour++;
        return false;
    });

    // $("#add_more_confer").click(function(){
    //     create_tr();
    //     create_serial('confer');
    //     create_input('cname[]', 'Conference','cname'+counter_confer, 'confer',counter_confer, 'confer');
    //     create_input('ctitle[]', 'Title', 'ctitle'+counter_confer,'confer',counter_confer, 'confer');
    //     create_input('cyear[]', 'Year', 'cyear'+counter_confer,'confer',counter_confer, 'confer',true);
    //     counter_confer++;
    //     return false;
    // });

    $("#add_more_book").click(function(){
        create_tr();
        create_serial('book');
        create_input('bauthor[]', 'Book','bauthor'+counter_book, 'book',counter_book, 'book');
        create_input('btitle[]', 'Title of the Book', 'btitle'+counter_book,'book',counter_book, 'book');
        create_input('byear[]', 'Year', 'byear'+counter_book,'book',counter_book, 'book');
        create_input('bisbn[]', 'ISBN', 'bisbn'+counter_book,'book',counter_book, 'book',true);
        counter_book++;
        return false;
    });


    $("#add_more_book_chapter").click(function(){
        create_tr();
        create_serial('book_chapter');
        create_input('bc_author[]', 'Book Chapter','bc_author'+counter_book_chapter, 'book_chapter',counter_book_chapter, 'book_chapter');
        create_input('bc_title[]', 'Title', 'bc_title'+counter_book_chapter,'book_chapter',counter_book_chapter, 'book_chapter');
        create_input('bc_year[]', 'Year', 'bc_year'+counter_book_chapter,'book_chapter',counter_book_chapter, 'book_chapter');
        create_input('bc_isbn[]', 'ISBN', 'bc_isbn'+counter_book_chapter,'book_chapter',counter_book_chapter, 'book_chapter',true);
        counter_book_chapter++;
        return false;
    });


    $("#add_more_patent").click(function(){
        create_tr();
        create_serial('patent');
        create_input('pauthor[]', 'Inventor(s)','pauthor'+counter_patent, 'patent',counter_patent, 'patent');
        // create_input('p_year[]', 'Year of the patent','p_year'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('ptitle[]', 'Title of Patent', 'ptitle'+counter_patent,'patent',counter_patent, 'patent');
        create_input('p_country[]', 'Country of patent','p_country'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('p_number[]', 'Patent Number','p_number'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('pyear_filed[]', 'DD/MM/YYYY','pyear_filed'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('pyear_published[]', 'DD/MM/YYYY','pyear_published'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('pyear_issued[]', 'DD/MM/YYYY','pyear_issued'+counter_patent, 'patent',counter_patent, 'patent',true);
        counter_patent++;
        return false;
    });
  });
  function create_select()
  {
    
  }
  function create_tr()
  {
    tr=document.createElement("tr");
  }
  function create_serial(tbody_id)
  {
    //console.log(tbody_id);
    var td=document.createElement("td");
    // var x=0;
     var x = document.getElementById(tbody_id).rows.length;
    // if(document.getElementById(tbody_id).rows)
    // {
    // }
    td.innerHTML=x;
     tr.appendChild(td);
  }
  function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, select=false)
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
      sel.innerHTML+="<option value='published'>Published</option>";
      sel.innerHTML+="<option value='accepted'>Accepted</option>";
      // sel.innerHTML+="<option value='in_preparation'>In-Preparation</option>";
      var td=document.createElement("td");
      td.appendChild(sel);
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
    tr.setAttribute("id", "row"+counter);
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
                <input id="summary_journal_inter" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_journal_inter', $sum_pub)) ? $sum_pub['$summary_journal_inter'] : ''; ?>" name="summary_journal_inter" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_journal">Number of National Journal Papers</span>  
                <div class="col-md-1">
                <input id="summary_journal" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_journal',$sum_pub)) ? $sum_pub['summary_journal'] : ' '; ?>" name="summary_journal" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_conf_inter">Number of International Conference Papers</span>  
                <div class="col-md-1">
                <input id="summary_conf_inter" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_conf_inter',$sum_pub)) ? $sum_pub['summary_conf_inter'] : ' '; ?>" name="summary_conf_inter" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_conf_national">Number of National Conference Papers</span>  
                <div class="col-md-1">
                <input id="summary_conf_national" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_conf_national',$sum_pub)) ? $sum_pub['summary_conf_national'] : ' '; ?>" name="summary_conf_national" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="patent_publish">Number of Patent(s) [Filed, Published, Granted] </span>  
                <div class="col-md-1">
                <input id="patent_publish" value="<?php echo (is_array($sum_pub) && array_key_exists('patent_book',$sum_pub)) ? $sum_pub['patent_book'] : ' '; ?>" name="patent_publish" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_book">Number of Book(s) </span>  
                <div class="col-md-1">
                <input id="summary_book" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_book',$sum_pub)) ? $sum_pub['summary_book'] : ' '; ?>" name="summary_book" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_book_chapter">Number of Book Chapter(s)</span>  
                <div class="col-md-1">
                <input id="summary_book_chapter" value="<?php echo (is_array($sum_pub) && array_key_exists('summary_book_chapter',$sum_pub)) ? $sum_pub['summary_book_chapter'] : ' '; ?>" name="summary_book_chapter" type="number" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>


              </div>
              </div>
              </div>
              </div>   

           
           <h4 style="text-align:center; font-weight: bold; color: #6739bb;">6. List of 10 Best Publications (Journal/Conference)</h4>

           <div class="container-fluid table-responsive">
              <div class="row">
                

               <div class="panel panel-success">
                <div class="panel-heading">List of 10 Best Publications (Journal/Conference) &nbsp;&nbsp;&nbsp;
                  <button class="btn btn-sm btn-danger" id="add_more_jour">Add Details</button>
                </div>
                <table class="table table-bordered">
                  <tbody id="jour">
                    
                    <tr height="30px">
                      <th class="col-md-1"> S. No.</th>
                      <th class="col-md-2"> Author(s)</th>
                      <th class="col-md-2"> Title</th>
                      <th class="col-md-2"> Name of Journal/Conference</th>
                      <th class="col-md-1"> Year, Vol., Page</th>
                      <th class="col-md-1"> Impact Factor</th>
                      <th class="col-md-1"> DOI</th>
                      <th class="col-md-2"> Status</th>
                    </tr>

                    <?php
                    // Iterate through additional qualification data and populate the fields
                    if (!empty($best_pub)) {
                        foreach ($best_pub as $index => $qualification) {
                            ?>
                            <tr height="60px">
                                <td class="col-md-2">
                                    <input id="author<?= $index + 1 ?>" name="author[]" type="text" placeholder="Author(s)" class="form-control input-md" autofocus=""
                                          value="<?= $qualification['author'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <input id="title<?= $index + 1 ?>" name="title[]" type="text" placeholder="Title" class="form-control input-md" autofocus=""
                                          value="<?= $qualification['title'] ?? '' ?>">
                                </td>
                                <td class="col-md-2">
                                    <input id="journal<?= $index + 1 ?>" name="journal[]" type="text" placeholder="Name of Journal/Conference" class="form-control input-md"
                                          autofocus="" value="<?= $qualification['journal'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input id="year<?= $index + 1 ?>" name="year[]" type="text" placeholder="Year, Vol., Page" class="form-control input-md" autofocus=""
                                          value="<?= $qualification['year'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input id="impact<?= $index + 1 ?>" name="impact[]" type="text" placeholder="Impact Factor" class="form-control input-md" autofocus=""
                                          value="<?= $qualification['impact'] ?? '' ?>">
                                </td>
                                <td class="col-md-1">
                                    <input id="doi<?= $index + 1 ?>" name="doi[]" type="text" placeholder="DOI" class "form-control input-md" autofocus=""
                                          value="<?= $qualification['doi'] ?? '' ?>">
                                </td>
                                <td class="col-md-3">
                                    <input id="status<?= $index + 1 ?>" name="status[]" type="text" placeholder="Status" class="form-control input-md" autofocus=""
                                          value="<?= $qualification['status'] ?? '' ?>">
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
 
                <!-- Conference input-->
                
          <!-- <div class="container-fluid table-responsive">
              <div class="row">

                <div class="panel panel-success">
                 <div class="panel-heading">(B) Conference (List of 10 Best Publications)&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-sm btn-danger" id="add_more_confer">Add Details</button>
                </div>
                 <table class="table table-bordered">
                     <tbody id="confer">
                     
                     <tr height="30px">
                       <th class="col-md-2"> S. No. </th>
                       <th class="col-md-3"> Name of the Conference</th>
                       <th class="col-md-5"> Title of Paper </th>
                       <th class="col-md-2"> Year </th>
                     </tr>


                                        </tbody>
                 </table>
            </div>

              
            </div> 
          </div> -->

           <!-- Patent Text -->

             <div class="container-fluid table-responsive">

             <h4 style="text-align:center; font-weight: bold; color: #6739bb;">7. List of  Patent(s), Book(s), Book Chapter(s)</h4>
             <div class="row">

           <div class="panel panel-success">
            <div class="panel-heading">(A) Patent(s)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_patent">Add Details</button>  </div>
            <table class="table table-bordered">
              <tbody id="patent">
                
                <tr height="30px">
                  <th class="col-md-1"> S. No.</th>
                  <th class="col-md-1"> Inventor(s) </th>
                  <!-- <th class="col-md-2"> Year of Patent </th> -->
                  <th class="col-md-2"> Title of Patent </th>
                  <th class="col-md-1"> Country of Patent </th>
                  <th class="col-md-1"> Patent Number</th>
                  <th class="col-md-1"> Date of Filing</th>
                  <th class="col-md-1"> Date of Published</th>
                  <th class="col-md-1"> Status Filed/Published/Granted</th>
                  <!-- <th class="col-md-1"> Date of Filed/Published (If not granted, mention "Awaited")</th> -->
                </tr>

                <!-- Printing saved values for the "Patent" section -->
                <?php if (!empty($patent)) { ?>
                  <?php foreach ($patent as $index => $patent_item) { ?>
                    <tr height="60px">
                      <td class="col-md-1"></td>
                      <td class="col-md-1">
                        <input id="pauthor<?= $index + 1 ?>" type="text" name="pauthor[]" placeholder="Inventor(s)" class="form-control input-md" value="<?php echo $patent_item['inventor'] ?? ''; ?>">
                      </td>
                      <!-- Include additional fields if needed for the "Patent" section -->
                      <td class="col-md-2">
                        <input id="ptitle<?= $index + 1 ?>" type="text" name="ptitle[]" placeholder="Title of Patent" class="form-control input-md" value="<?php echo $patent_item['title'] ?? ''; ?>">
                      </td>
                      <td class="col-md-1">
                        <input id="p_country<?= $index + 1 ?>" type="text" name="p_country[]" placeholder="Country of Patent" class="form-control input-md" value="<?php echo $patent_item['country'] ?? ''; ?>">
                      </td>
                      <td class="col-md-1">
                        <input id="p_number<?= $index + 1 ?>" type="text" name="p_number[]" placeholder="Patent Number" class="form-control input-md" value="<?php echo $patent_item['number'] ?? ''; ?>">
                      </td>
                      <td class="col-md-1">
                        <input id="pyear_filed<?= $index + 1 ?>" type="text" name="pyear_filed[]" placeholder="Date of Filing" class="form-control input-md" value="<?php echo $patent_item['year_filed'] ?? ''; ?>">
                      </td>
                      <td class="col-md-1">
                        <input id="pyear_published<?= $index + 1 ?>" type="text" name="pyear_published[]" placeholder="Date of Published" class="form-control input-md" value="<?php echo $patent_item['year_published'] ?? ''; ?>">
                      </td>
                      <td class="col-md-1">
                        <input id="pyear_issued<?= $index + 1 ?>" type="text" name="pyear_issued[]" placeholder="Status Filed/Published/Granted" class="form-control input-md" value="<?php echo $patent_item['year_issued'] ?? ''; ?>">
                      </td>
                      <!-- Include additional fields if needed for the "Patent" section -->
                      <td class="col-md-2">
                        <button class="btn btn-sm btn-danger" onclick="removeRow(this)">Remove</button>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } ?>

                </tbody>
            </table>
          </div>
             
           </div>

            
           </div>

            <!-- Book Text -->

             <div class="container-fluid table-responsive">
              <div class="row">

             <div class="panel panel-success">
             <div class="panel-heading">(B) Book(s) &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_book">Add Details</button></div>

             <table class="table table-bordered">
              <tbody id="book">
                 
                 <tr height="30px">
                   <th class="col-md-1"> S. No.</th>
                   <th class="col-md-2"> Author(s)</th>
                   <th class="col-md-2"> Title of the Book </th>
                   <th class="col-md-2"> Year of Publication </th>
                   <th class="col-md-2"> ISBN</th>
                   <!-- <th class="col-md-2"> Status</th> -->
                 </tr>

                <?php if (!empty($book)) { ?>
                  <?php foreach ($book as $index => $book_item) { ?>
                    <tr height="60px">
                      <td class="col-md-1"></td>
                      <td class="col-md-2">
                        <input id="bauthor<?= $index + 1 ?>" type="text" name="bauthor[]" placeholder="Author(s)" class="form-control input-md" value="<?php echo $book_item['bauthor'] ?? ''; ?>">
                      </td>
                      <td class="col-md-2">
                        <input id="btitle<?= $index + 1 ?>" type="text" name="btitle[]" placeholder="Title of the Book" class="form-control input-md" value="<?php echo $book_item['btitle'] ?? ''; ?>">
                      </td>
                      <td class="col-md-2">
                        <input id="byear<?= $index + 1 ?>" type="text" name="byear[]" placeholder="Year of Publication" class="form-control input-md" value="<?php echo $book_item['byear'] ?? ''; ?>">
                      </td>
                      <td class="col-md-2">
                        <input id="bisbn<?= $index + 1 ?>" type="text" name="bisbn[]" placeholder="ISBN" class="form-control input-md" value="<?php echo $book_item['bisbn'] ?? ''; ?>">
                      </td>
                      <td class="col-md-2">
                        <button class="btn btn-sm btn-danger" onclick="removeRow(this)">Remove</button>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } ?>

              </tbody>
             </table>
            </div>
              
            
            </div>

             
            </div>


            <br>
            <br>

            <!-- Book chapter Text -->

             <div class="container-fluid table-responsive">
              <div class="row">

             <div class="panel panel-success">
             <div class="panel-heading">(C) Book Chapter(s)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_book_chapter">Add Details</button></div>

             <table class="table table-bordered">
              <tbody id="book_chapter">
                 
                 <tr height="30px">
                   <th class="col-md-1"> S. No.</th>
                   <th class="col-md-2"> Author(s)</th>
                   <th class="col-md-2"> Title of the Book Chapter(s) </th>
                   <th class="col-md-2"> Year of Publication </th>
                   <th class="col-md-2"> ISBN</th>
                   <!-- <th class="col-md-2"> Status</th> -->
                 </tr>
                  <?php if (!empty($chapter)) { ?>
                    <?php foreach ($chapter as $index => $chapter_item) { ?>
                      <tr height="60px">
                        <td class="col-md-1"></td>
                        <td class="col-md-2">
                          <input id="bc_author<?= $index + 1 ?>" type="text" name="bc_author[]" placeholder="Author(s)" class="form-control input-md" value="<?php echo $chapter_item['author'] ?? ''; ?>">
                        </td>
                        <!-- Include additional fields if needed for the "Book Chapter" section -->
                        <td class="col-md-2">
                          <input id="bc_title<?= $index + 1 ?>" type="text" name="bc_title[]" placeholder="Title of the Book Chapter(s)" class="form-control input-md" value="<?php echo $chapter_item['title'] ?? ''; ?>">
                        </td>
                        <td class="col-md-2">
                          <input id="bc_year<?= $index + 1 ?>" type="text" name="bc_year[]" placeholder="Year of Publication" class="form-control input-md" value="<?php echo $chapter_item['year'] ?? ''; ?>">
                        </td>
                        <td class="col-md-2">
                          <input id="bc_isbn<?= $index + 1 ?>" type="text" name="bc_isbn[]" placeholder="ISBN" class="form-control input-md" value="<?php echo $chapter_item['isbn'] ?? ''; ?>">
                        </td>
                        <td class="col-md-2">
                          <button class="btn btn-sm btn-danger" onclick="removeRow(this)">Remove</button>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } ?>


              </tbody>
             </table>
            </div>
              
            
            </div>

             
            </div>


            <br>
            <br>
            

 

            <h4 style="text-align:center; font-weight: bold; color: #6739bb;">8. Google Scholar Link *</h4>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-success">
            <div class="panel-heading">URL</div>
            <div class="panel-body">
              <span class="col-md-2 control-label" for="google_link">Google Scholar Link </span>  
              <div class="col-md-10">
              <input id="google_link" value="In quidem distinctio." name="google_link" type="text" placeholder="Google Scholar Link" class="form-control input-md" required="">
              </div>

              

            </div>
            </div>
            </div>
            </div>


            <!-- Button -->
<div class="form-group">

  <div class="col-md-1">
    <a href="../emp_det/main.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
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