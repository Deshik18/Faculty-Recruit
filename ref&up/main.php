
<?php
session_start();
include '../config.php';
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



<!-- publication file upload           -->

<form class="form-horizontal" action="process.php" method="post" enctype="multipart/form-data">


   <!-- Reprints of 5 Best Research Papers  -->

  <h4 style="text-align:center; font-weight: bold; color: #6739bb;">20. Reprints of 5 Best Research Papers *</h4>
   <div class="row">

                        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading">Upload 5 Best Research Papers in a single PDF &lt; 6MB 
             <a href="" class="btn-sm btn-info " target="_blank">View Uploaded File </a>
              <br>
              <br>
             
           </div>
              <div class="panel-body">
                <div class="col-md-5">
                <p class="update_crerti">Update 5 best papers</p>
                </div>
                <div class="col-md-7">
                 <input id="full_5_paper" name="userfile7" type="file" class="form-control input-md">
               </div>
            </div>
          </div>
        </div>

                
  </div>

 
 
<!-- certificate file code start -->
<h4 style="text-align:center; font-weight: bold; color: #6739bb;">21. Check List of the documents attached with the online application *</h4>

<div class="row">
  <div class="col-md-12">
  <div class="panel panel-success">
  <div class="panel-heading">Check List of the documents attached with the online application (Documents should be uploaded in PDF format only):
    <br>
    <small style="color: red;">Uploaded PDF files will not be displayed as part of the printed form.</small>
  </div>
    <div class="panel-body">
      <div class="row">
  
        <!-- <form action="https://ofa.iiti.ac.in/facrec_che_2023_july_02/submission_complete/upload" method="post" enctype="multipart/form-data"> -->
        <input type="hidden" name="ci_csrf_token" value="">
     
     <!-- phd certificate  -->
      <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">PHD Certificate <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_phd_1698405423912106.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
        <div class="panel-body">
          <p class="update_crerti">Update PHD Certificate</p>
           <input id="phd" name="userfile" type="file" class="form-control input-md">
      </div>
    </div>
  </div>

        
         

     <!-- Master certificate  -->


                  <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading">PG Documents <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_pg_1698405423820465.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
            <div class="panel-body">
              <p class="update_crerti">Update All semester/year-Marksheets and degree certificate</p>
               <input id="post_gr" name="userfile1" type="file" class="form-control input-md">
          </div>
        </div>
      </div>

            
              

 
 <!-- Bachelor certificate  -->


      <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">UG Documents <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_ug_1698405423227278.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
        <div class="panel-body">
          <p class="update_crerti">Update All semester/year-Marksheets and degree certificate  </p>
           <input id="under_gr" name="userfile2" type="file" class="form-control input-md">
      </div>
    </div>
  </div>

             


      <!-- 12th certificate  -->


                     <div class="col-md-4">
         <div class="panel panel-info">
           <div class="panel-heading">12th/HSC/Diploma Documents <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_higher_sec_1698405423360541.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
             <div class="panel-body">
               <p class="update_crerti">Update 12th/HSC/Diploma/Marksheet(s) and passing certificate</p>
                <input id="higher_sec" name="userfile3" type="file" class="form-control input-md">
           </div>
         </div>
       </div>

                  



   <!-- 10th certificate  -->


            <div class="col-md-4">
      <div class="panel panel-info">
        <div class="panel-heading">10th/SSC Documents <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_ssc_1698405423413720.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
          <div class="panel-body">
            <p class="update_crerti">Update 12th/HSC/Diploma/Marksheet(s) and passing certificate</p>
             <input id="high_school" name="userfile4" type="file" class="form-control input-md">
        </div>
      </div>
    </div>

            


    <!-- Pay Slip -->

            <div class="col-md-4">
      <div class="panel panel-info">
        <div class="panel-heading">Pay Slip <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_pay_slip_1698405423635089.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
          <div class="panel-body">
            <p class="update_crerti">Update Pay Slip</p>
             <input id="pay_slip" name="userfile9" type="file" class="form-control input-md">
        </div>
      </div>
    </div>

            

<!-- Under Taking NOC -->

<!-- Pay Slip -->

<div class="col-md-6">
  <div class="panel panel-info">
    <div class="panel-heading">NOC or Undertaking <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_noc_under_1698405423167663.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
      <div class="panel-body">
        <p class="update_crerti">Undertaking-in case, NOC is not available at the time of application but will be provided at the time of interview</p>
         <input id="noc_under" name="userfile10" type="file" class="form-control input-md">
    </div>
  </div>
</div>

       
        <!-- 10 years post phd exp certificate  -->

                           <div class="col-md-5">
           <div class="panel panel-info">
             <div class="panel-heading">Post phd Experience Certificate/All Experience Certificates/ Last Pay slip/ 
              <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_post_phd_1698405423514222.pdf" class="btn-sm btn-info " target="_blank">View Uploaded File </a>
              <br>

             </div>
               <div class="panel-body">
                 <p class="update_crerti">Update Certificate</p>
                  <input id="post_phd_10" name="userfile8" type="file" class="form-control input-md">
             </div>
           </div>
         </div>

                 


       

     <!-- Misc certificate  -->


                  <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">Upload any other relevant document in a single PDF (For example award certificate, experience certificate etc) . If there are multiple documents, combine all the documents in a single PDF) &lt;1MB. 
           <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_misc_1698405423429846.html" class="btn-sm btn-info " target="_blank">View Uploaded File </a>
         </div>
            <div class="panel-body">
              <div class="col-md-5">
              <p class="update_crerti">Upload any other document</p>
              </div>
              <div class="col-md-7">
               <input id="misc_certi" name="userfile6" type="file" class="form-control input-md">
             </div>
          </div>
        </div>
      </div>

              





        <div class="col-md-2"> 
        <!-- <input type="submit" value="Upload" name="upload_submit" class="btn btn-danger" required="" /> -->
        <!-- <br /><br /> -->
        </div>
      <!-- </form> -->
      </div> 

      
    
   </div>
  </div>
<!-- </div> -->

</div>
</div>



<!-- Signature certificate  -->

<div class="row">
   <div class="col-md-4">
   <div class="panel panel-danger">
     <div class="panel-heading">Upload your Signature in JPG only 
      <!-- <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/712_Marisol_Mosciski_1698350300/712_sign_1698405423388852.csv" class="btn-sm btn-info " target="_blank">View Uploaded File </a> -->
    </div>
       <div class="panel-body">
         <!-- <p class="update_crerti">Update your signature</p> -->
         <img src="./Referees &amp; Upload(8)_files/712_sign_1698405423388852.csv" style="height: 52px; width: 100px; margin-top: -10px;">
          <input id="signature" name="userfile5" type="file" class="form-control input-md">
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
         <div class="panel-heading">Fill the Details</div>
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
                 
                 
               

                 <tr height="60px">
                   <td class="col-md-2">  
                       <input id="ref_name1" name="ref_name[]" type="text" value="Mathilde Bernhard" placeholder="Name" class="form-control input-md" required="" autofocus=""> 
                   </td>

                   <td class="col-md-2"> 
                       <input id="position1" name="position[]" type="text" value="Repudiandae eius voluptas accusamus ipsa sed possimus impedit." placeholder="Position" class="form-control input-md" required=""> 
                     </td>

                   <td class="col-md-2"> 
                     <select id="association_referee1" name="association_referee[]" class="form-control input-md" required="">

                       <option value="">Select</option>
                       <option selected="selected" value="Thesis Supervisor">Thesis Supervisor</option>
                       <option value="Postdoc Supervisor">Postdoc Supervisor</option>
                       <option value="Research Collaborator">Research Collaborator</option>
                       <option value="Other">Other</option>
                     </select>
                     </td>

                 
                    <td class="col-md-2"> 
                     <input id="org1" name="org[]" type="text" value="Modi pariatur voluptate mollitia dolorem repellat dicta unde perferendis molestiae." placeholder="Institution/Organization" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="email1" name="email[]" type="email" value="your.email+fakedata74403@gmail.com" placeholder="E-mail" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="phone1" name="phone[]" type="text" value="265-078-2480" placeholder="Contact No." class="form-control input-md" maxlength="20" required=""> 
                   </td>

                   
                 </tr>
                 
               

                 <tr height="60px">
                   <td class="col-md-2">  
                       <input id="ref_name2" name="ref_name[]" type="text" value="Glen Wuckert" placeholder="Name" class="form-control input-md" required="" autofocus=""> 
                   </td>

                   <td class="col-md-2"> 
                       <input id="position2" name="position[]" type="text" value="Officiis velit officiis aut vero." placeholder="Position" class="form-control input-md" required=""> 
                     </td>

                   <td class="col-md-2"> 
                     <select id="association_referee2" name="association_referee[]" class="form-control input-md" required="">

                       <option value="">Select</option>
                       <option value="Thesis Supervisor">Thesis Supervisor</option>
                       <option selected="selected" value="Postdoc Supervisor">Postdoc Supervisor</option>
                       <option value="Research Collaborator">Research Collaborator</option>
                       <option value="Other">Other</option>
                     </select>
                     </td>

                 
                    <td class="col-md-2"> 
                     <input id="org2" name="org[]" type="text" value="Qui consequatur totam ipsam molestias soluta natus maxime sapiente." placeholder="Institution/Organization" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="email2" name="email[]" type="email" value="your.email+fakedata88537@gmail.com" placeholder="E-mail" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="phone2" name="phone[]" type="text" value="389-548-6432" placeholder="Contact No." class="form-control input-md" maxlength="20" required=""> 
                   </td>

                   
                 </tr>
                 
               

                 <tr height="60px">
                   <td class="col-md-2">  
                       <input id="ref_name3" name="ref_name[]" type="text" value="Dane Kiehn" placeholder="Name" class="form-control input-md" required="" autofocus=""> 
                   </td>

                   <td class="col-md-2"> 
                       <input id="position3" name="position[]" type="text" value="Recusandae esse aut repellendus sunt." placeholder="Position" class="form-control input-md" required=""> 
                     </td>

                   <td class="col-md-2"> 
                     <select id="association_referee3" name="association_referee[]" class="form-control input-md" required="">

                       <option value="">Select</option>
                       <option value="Thesis Supervisor">Thesis Supervisor</option>
                       <option value="Postdoc Supervisor">Postdoc Supervisor</option>
                       <option value="Research Collaborator">Research Collaborator</option>
                       <option selected="selected" value="Other">Other</option>
                     </select>
                     </td>

                 
                    <td class="col-md-2"> 
                     <input id="org3" name="org[]" type="text" value="Eius magni natus magnam delectus." placeholder="Institution/Organization" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="email3" name="email[]" type="email" value="your.email+fakedata17590@gmail.com" placeholder="E-mail" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="phone3" name="phone[]" type="text" value="029-065-9160" placeholder="Contact No." class="form-control input-md" maxlength="20" required=""> 
                   </td>

                   
                 </tr>
                                  
              
               </tbody>
             </table>

         </div>
       </div>
       </div>
       </div>

<!-- Payment file upload           -->



<!-- Referees Details -->


<input type="hidden" name="ci_csrf_token" value="">
    
 
<hr> 
<div class="form-group">
<div class="col-md-10">
  <!-- <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/acde" class="btn btn-primary pull-left">BACK</a> -->
  <a href="../rel_info/main.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
  
  <!-- <button type="submit" name="submit" value="Submit" class="btn btn-success">SAVE</button> -->


</div>

<div class="col-md-2">
  <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE &amp; NEXT</button>
  <!-- <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">Final Submission</button> -->

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
  $(document).ready(function () 
  {
   
    var list1 = document.getElementById('applicant_cate');
     
    list1.options[0] = new Option('Select/Category', '');
    list1.options[1] = new Option('Other Applicants', 'Other Applicants');
    list1.options[2] = new Option('OBC-NC, PwD, EWS and Female Applicants', 'OBC-NC, PwD, EWS and Female Applicants');
    list1.options[3] = new Option('SC, ST and Faculty Applicants from IIT Indore', 'SC, ST and Faculty Applicants from IIT Indore');
   

    $("#applicant_cate option").each(function()
    {

           if($(this).val()==selectoption){
        $(this).attr('selected', 'selected');
      }
      // Add $(this).val() to your list
    });

    getFoodItem();
      $("#payment_amount option").each(function()
    {

           if($(this).val()==selectsubthemeoption){
        $(this).attr('selected', 'selected');
      }
      // Add $(this).val() to your list
    });
  });

  
  function getFoodItem()
  {
 
    var list1 = document.getElementById('applicant_cate');
    var list2 = document.getElementById("payment_amount");
    var list1SelectedValue = list1.options[list1.selectedIndex].value;


    if (list1SelectedValue=='Other Applicants')
    {
         
        // list2.options.length=0;
        // list2.options[0] = new Option('Select Amount', '');
        list2.options[0] = new Option('INR 1000', 'INR 1000');
        
         
    }
    else if (list1SelectedValue=='OBC-NC, PwD, EWS and Female Applicants')
    {
         
        // list2.options.length=0;
        // list2.options[0] = new Option('Select Amount', '');
        list2.options[0] = new Option('INR 500', 'INR 500');
       
         
    }

    else if (list1SelectedValue=='SC, ST and Faculty Applicants from IIT Indore')
    {
         
        // list2.options.length=0;
        // list2.options[0] = new Option('Select Amount', '');
        list2.options[0] = new Option('NIL', 'NIL');
       
         
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