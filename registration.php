<?php
error_reporting( E_ALL );
ini_set('display_errors', 0);
require_once("php/user.php");
ob_start();

//get user data
$user=new User();
$arr=array();
$id=0;
if(isset($_SESSION['cur_id']) && !empty($_SESSION['cur_id'])) {

  $id=$_SESSION['cur_id'];
  $arr=$user->getUserData($id);
}
else{
	header("Location:index.html");
}
if($arr==null)
{
 $arr[0]="";
 $arr[1]="";
}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Registration Form</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <!--     Fonts and icons     -->
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/gsdk-bootstrap-wizard.css" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/css/demo.css" rel="stylesheet" />

</head>

<body>
  <div class="image-container set-full-height" style="">
    <!--   Big container   -->
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

          <!--      Wizard container        -->
          <div class="wizard-container" id="">

            <div class="card wizard-card" data-color="azzure" id="wizardProfile">
              <form method="post"  id="formreg" action="php\multi_signup.php" name="registration" class="submit-once"> 
                <!--        You can switch ' data-color="azzure" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->
                <div class="wizard-header">
                 <h3>
                  <b>SIGNUP</b> PROCESS <br>
                  <small>Multiple steps to sign up.</small>
                </h3>
              </div>
			        <input type="hidden" name="action" id="action" value="submitForm">
              <div class="wizard-navigation">
               <ul>
                 <li><a href="#profile"  data-toggle="tab">Profile</a></li>
                 <li><a href="#product"  data-toggle="tab">Product</a></li>
                 <li><a href="#participant"  data-toggle="tab">Praticipant</a></li>
                 <li><a href="#billing"  data-toggle="tab">Billing</a></li>
                 <li><a href="#review"  class="soft_review" data-toggle="tab">Review</a></li>

               </ul>

             </div>

             <div class="tab-content">
              <div class="tab-pane" id="profile">
                <div class="row">
					<div class="col-sm-12">
						<h4 class="info-text">Registration-Step 1</h4>
					</div>
					<div class="col-sm-5 col-sm-offset-1 softenite_mobile">
					   <div class="form-group">
							<label>First Name</label>
							<input type="text" name="first_name" class="form-control"  value="<?php echo $arr[0]?>">
					  </div>
					</div>
					
					<div class="col-sm-5 softenite_mobile">
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="last_name" class="form-control"  value="<?php echo $arr[1]?>">
						</div>
					</div>
				</div><!--./row-->
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1 softenite_mobile">
						<div class="form-group">
							<label>Address</label>
							<textarea name="address" class="form-control"></textarea>
						</div>
						</div>					
				</div><!--./row-->
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1 softenite_mobile">
						<div class="form-group">
							<label>City</label>
							<input type="text" name="city" class="form-control">
						</div>
					</div>
					<div class="col-sm-5 softenite_mobile">
						<div class="form-group">
							<label>Zip Code</label>
							<input type="text" name="zipcode" maxlength="5" onkeypress="return isNumberKey(event)" class="form-control">
						</div>
					</div>
				</div><!--./row-->
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1 softenite_mobile">
						<div class="form-group">
							<label>State</label>
							<select name="state" id="state" class="form-control" required>
								<option value="Afghanistan"> Afghanistan </option>
								<option value="Albania"> Albania </option>
								<option value="Algeria"> Algeria </option>
								<option value="American Samoa"> American Samoa </option>
								<option value="Andorra"> Andorra </option>
								<option value="Angola"> Angola </option>
								<option value="Anguilla"> Anguilla </option>
								<option value="Antarctica"> Antarctica </option>
								<option value="...">...</option>
								</select>
						</div>
					</div>
					<div class="col-sm-5 softenite_mobile">
						<div class="form-group">
							<label>Mobile Number</label>
							<input type="text" name="mobile_no" maxlength="10" onkeypress="return isNumberKey(event)" class="form-control">
						</div>
					</div>
				</div><!--./row-->
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1 softenite_mobile">
						<div class="form-group">
							<label>Birth Date</label>
							<input type="date" name="birthdate" id="birthdate" class="form-control">
						</div>
					</div>
					<div class="col-sm-5 softenite_mobile">
						<div class="form-group">
							<label>Gender</label>
							<select name="gender" class="form-control">
							  <option value="Male"> Male </option>
							  <option value="Female"> Female </option>
							</select>
						</div>
					</div>
				</div><!--./row-->
            </div><!--end profile-->
			<div class="tab-pane" id="product">
			  <div class="row">
				<div class="col-sm-12">
				  <h4 class="info-text">Product and Coverage-Step 2</h4>
				</div>
				<div class="col-sm-4 col-sm-offset-1 softenite_mobile">
					<div class="form-group">
						<label>Enrollee Type</label>
						<select name="enrollee_type" id="enrollee_type" class="form-control" required>
							<option value="Single" selected="selected"> Single </option>
							<option value="Family"> Family </option>
						</select>
					</div>
				</div>
				
			</div><!--./row-->
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1 softenite_mobile">
					<div class="form-group">
						<label>Pricing Plan</label><br>
						<input type="text" name="lb_pricing_plan" value="plan1" class="form-control"  readonly="readonly">
					</div>
				</div>
				<div class="col-sm-3 softenite_mobile">
					<div class="form-group">
						<label>Cost</label><br>
						<input type="text" name="lb_plan_cost" value="5000" id="lb_plan_cost" value="100.0" class="form-control"  readonly="readonly">
					</div>
				</div>
				<div class="col-sm-3 softenite_mobile">
					<div class="form-group">
						<label>Type</label><br>
						<input type="text" value="monthly" name="lb_plan_type" class="form-control"  readonly="readonly">
					</div>
				</div>
				</div><!--./row-->
			</div><!--../end product tab-->
			
<div class="tab-pane" id="participant">
  <div class="row">
    <div class="col-sm-12">
      <h4 class="info-text">Participant-Step 3</h4>
    </div>

    <div class="col-sm-5 col-sm-offset-1 softenite_mobile">
		<div class="form-group">
			<label>Member</label><br>
			<select name="member" id="member" class="form-control" required>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
		</div>
  </div>
  <div class="clearfix"></div>
  <div id="dash">
    <div class="col-sm-5 col-sm-offset-1 softenite_mobile">
      <h6><strong>Member Details: <span class="softenite">1</span></strong></h6>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-5 col-sm-offset-1 softenite_mobile">
		 <div class="form-group">
			<label>First Name</label>
			<input type="text" name="fam_first_name[]" class="form-control">
		</div>
	</div>
	<div class="col-sm-5 softenite_mobile">
		 <div class="form-group">
		  <label>Last Name</label>
		  <input type="text" name="fam_last_name[]" class="form-control">
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-5 col-sm-offset-1 softenite_mobile">
		 <div class="form-group">
		  <label>Date of Birth</label><br>
		  <input type="date" name="fam_birthdate[]" class="form-control" required>

		</div>
	</div>
	<div class="col-sm-5 softenite_mobile">
		 <div class="form-group">
		  <label>Gender</label><br>
		  <select name="fam_gender[]" class="form-control" required>
			<option value="Male"> Male </option>
			<option value="Female"> Female </option>

		  </select>
		</div>
	</div>
<div class="clearfix"></div>
	<div class="col-sm-5 softenite_mobile col-sm-offset-1">
	 <div class="form-group">
	  <label>State of Residence</label>
	  <select name="fam_state[]" class="form-control" required>
		<option value="Afghanistan"> Afghanistan </option>
		<option value="Albania"> Albania </option>
		<option value="Algeria"> Algeria </option>
		<option value="American Samoa"> American Samoa </option>
		<option value="Andorra"> Andorra </option>
		<option value="Angola"> Angola </option>
		<option value="Anguilla"> Anguilla </option>
		<option value="Antarctica"> Antarctica </option>
		<option value="...">...</option>
	  </select>
	</div>

	</div><!--./country-->
<div class="clearfix"></div>
</div><!--./dash-->

<div class="clearfix"></div>
<div id="dash1" class="soft_dash"></div>
<div class="clearfix"></div>
</div><!--./row-->

</div><!--../end participant tab-->

<div class="tab-pane" id="billing">
  <div class="row">
	   <div class="col-sm-12 softenite_mobile">
		<h4 class="info-text">Payment-Step 3</h4>
	  </div>
  </div><!--./row-->
  <div class="row">
  <div id="cardinfo" class="soft_cardinfo">
	  <h6 class="info-text text-center">Credit card Info</h6>
	  <div class="col-sm-5 softenite_mobile col-sm-offset-1">
		<div class="form-group">
		  
			<label>CARD NUMBER</label>
			<input type="text" id="card_no" onkeypress="return isNumberKey(event)" maxlength="16" name="card_no" placeholder="XXXX-XXXX-XXXX-XXXX" class="form-control">
		  </div>
		</div>
		<div class="col-sm-5 softenite_mobile">
		  <div class="form-group">
			<label>CARD HOLDER NAME</label>
			<input type="text" name="card_holder" class="form-control">
		  </div>
		</div>
		<div class="clearfix"></div>
		<div class="col-sm-2 softenite_mobile col-sm-offset-1">
		  <div class="form-group">
			<label>MONTH</label>
				<select name="card_month" class="form-control">
					<option value="01" selected="selected">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
		  </div>
		</div>
		<div class="col-sm-2 softenite_mobile">
		  <div class="form-group">
			<label>YEAR</label>
				<select name="card_year" class="form-control">
					<option value="2018" selected="selected">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
				</select>
		  </div>
		</div>
		
		<div class="col-sm-2 softenite_mobile col-sm-offset-1">
		  <div class="form-group">
			<label>CVV</label>
			<input type="text" placeholder="XXX" onkeypress="return isNumberKey(event)" maxlength="3" name="card_cvv" class="form-control">

		  </div>
		</div>
		<div class="clearfix"></div>
	  </div><!--./card div-->
	</div><!--./row-->
  </div><!--../end billing tab-->
<div class="tab-pane" id="review">
  <h4 class="info-text">Congratulations</h4>
  <div class="row">

    <div class="col-sm-10 col-sm-offset-1">
      <p class="text-center">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incident ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.

      </p>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-10 col-sm-offset-5 ">
     <div class="form-group softenite_active">
       <input type='button' class='btn btn-fill btn-info btn-wd btn-sm' name='active_now' value='Active Now' /> 
     </div>
   </div>
   <div class="col-sm-10 col-sm-offset-5">
     <div class="form-group softenite_active">
      <input type='button' class='btn btn-fill btn-info btn-wd btn-sm' name='login' value='Login Now' />
    </div>
  </div>

</div>
</div><!--./review-->


<div class="wizard-footer height-wizard">
  <div class="pull-right">
    <input type='button' class='btn btn-next btn-fill btn-info btn-wd btn-sm' name='next' id="next" value='Next' />
    <input type='submit' class='btn btn-finish btn-fill btn-info btn-wd btn-sm' name='finish' id="finish" value='Finish'/>

  </div>

  <div class="pull-left">
    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' id="prev" value='Previous' />
  </div>
  <div class="clearfix"></div>
</div>

</form>
</div><!--./tab content-->
</div> <!-- wizard container -->
</div>
</div><!-- end row -->
</div> <!--  big container -->
</div>

</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="assets/js/gsdk-bootstrap-wizard.js"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/jquery.creditCardValidator.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

		 $(document).on('click','.btn.btn-previous.btn-fill.btn-default.btn-wd.btn-sm.billing',function(e){
		 	e.preventDefault();
		 	var conceptName = $('[name="enrollee_type"].form-control').find(":selected").val();	
		 	if(conceptName == 'Single')
              {
               $('a[href="#product"]').click();
              }
		 });

	});
</script>
<script type="text/javascript">
  $(document).ready(function(){

		var current_tab="";

		 $('#formreg').on('keyup keypress', function(e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode === 13) { 
				e.preventDefault();
				return false;
			}
		});

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){

            var currentTab = $(e.target).text(); // get current tab
            var lastTab = $(e.relatedTarget).text(); // get last tab
            var valid = false;
            var href = $(this).attr('href');
            href = href.replace("#","");

            $('#next').removeClass('profile').removeClass('product').removeClass('participant').removeClass('billing').removeClass('review');
            $('#next').addClass(href);
            $('#prev').removeClass('profile').removeClass('product').removeClass('participant').removeClass('billing').removeClass('review');
            $('#prev').addClass(href);
            if(href == 'participant')
            {
              var conceptName = $('[name="enrollee_type"].form-control').find(":selected").val();
              if(conceptName == 'Single')
              {
                    //$('#dash').remove();
                $('#dash').hide();
								$('#next').click();
              }
              else if(conceptName == 'Family')
              {
								$('#dash').show();
              }

            }   
            if(href == 'billing')
						{
								$('#next').hide();
								$('#finish').show();
						}
						if(href=='review')
            {
              $('.wizard-navigation ul li a').each(function(){
                $(this).attr('href','javascript:void(0)');
                $(this).removeAttr('data-toggle');
              });
            }
                  
      });
			
				$('#member').on('change', function() {
					$('.soft_dash').remove();
					$('#dash').after('<div class="clearfix"></div><div id="dash1" class="soft_dash"></div>');
					var n=this.value;
					for(i=1;i<n;i++)
					{
						var soft_class = '#dash'+i;
					var hello = $('#dash').clone();
					$(soft_class).append(hello);  
					$(soft_class +' .softenite').html(' '+ (i+1));
					$(soft_class).after('<div id="dash'+(i+1)+'" class="soft_dash"></div>')  
				}
			});

	 $('#enrollee_type').on('change',function(){
			 var type=$(this).val();
			 if(type =='Single')
			 {
				 	$('#lb_plan_cost').val('5000');
			 }
			 else if(type =='Family')
			 {
				 $('#lb_plan_cost').val('10000');
			 }
	 });
	 
    $('#birthdate').change(function () {
      $('#lb_birthdate').val($(this).val());
      $('#lb_state').val($('#state').val());
		});

		$('#state').change(function () {
      $('#lb_state').val($(this).val());
		});
  });
</script>
<script type="text/javascript">
  function isNumberKey(evt)
  {
   var charCode=(evt.which) ? evt.which:evt.keyCode
   if(charCode>31&&(charCode<48||charCode>57))
    return false;
  return true;
}
</script>
<script type="text/javascript">

  $(document).on('click','#finish',function(){

    $(document).on('submit','#formreg',function(e) {

      e.preventDefault(); // avoid to execute the actual submit of the form.
      
      var form = $(this);
      var url = form.attr('action');

      var submitData = form.serialize();

      $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        data: submitData,
				timeout:5000,
        beforeSend : function(){
          //Show processing or something
        },
        success: function(data){
          if(data){
            if(data.status){
							$('.soft_review').click();
							$('#finish').remove();
							$('#prev').remove();
							$('#finish').remove();
            }
            alert(data.message);
          }else{
            alert('something went wrong, please try again later.');
          }
        },
        error: function(xmlhttprequest, textstatus, message) {
        if(textstatus==="timeout") {
            alert("got timeout");
        } else {
            alert(textstatus);
        }
    }
      });
    });
  });
</script>

</html>
                                                                                                                                          