<?php
require_once('user.php');
ob_start();

//code for multi form
$status = false;
$respmsg = 'Something went wrong';

if(isset($_POST['action']) && $_POST['action'] == 'submitForm')
{

    $user=new User();
    if(isset($_POST['first_name'])  && isset($_POST['last_name']))
    {
        //personal detail
        $first_name= isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name= isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $address= isset($_POST['address']) ? $_POST['address'] : '';
		$city= isset($_POST['city']) ? $_POST['city'] : '';
        $state= isset($_POST['state']) ? $_POST['state'] : '';
        $zipcode= isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
        $mobile_no= isset($_POST['mobile_no']) ? $_POST['mobile_no'] : '';
        $birthdate= isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
        $gender= isset($_POST['gender']) ? $_POST['gender'] : '';
            

        if($first_name != '' && $last_name != '' && $address != '' && $city != ''&& $zipcode != '' && $mobile_no!='')
        {
            /* insert personal detail */
            $user->insertPersonalInfo($first_name,$last_name,$address,$city,$state,$zipcode,$mobile_no,$birthdate,$gender);
        }
        else
        {
        	echo json_encode(array('status'=>$status,'message'=>$respmsg));exit;
        }
    }

    //Do this for all variable isset(varible name)
    if(isset($_POST['card_no']) && isset($_POST['card_holder']) && isset($_POST['card_month']) && isset($_POST['card_year']) && isset($_POST['card_cvv']))
    {
        //card info
        $card_no= isset($_POST['card_no']) ? $_POST['card_no'] : '';
        $card_holder= isset($_POST['card_holder']) ? $_POST['card_holder'] : '';
        $card_month= isset($_POST['card_month']) ? $_POST['card_month'] : '';
        $card_year= isset($_POST['card_year']) ? $_POST['card_year'] : '';
        $card_cvv= isset($_POST['card_cvv']) ? $_POST['card_cvv'] : '';

        if($card_no != '' && $card_month != '' && $card_year != '' && $card_cvv != ''&& $card_holder != '')
        {
            $card_expiry = $card_month."/".$card_year;
            
            //insert billing info
            $user->insertBillingInfo($card_no,$card_holder,$card_expiry,$card_cvv);
            
        }
        else
        {
        	echo json_encode(array('status'=>$status,'message'=>$respmsg));exit;
        }
    }

    if(isset($_POST['enrollee_type']))
    {
        //product detail
        $enrollee_type= isset($_POST['enrollee_type']) ?  $_POST['enrollee_type'] : '';
        $pricing_plan= isset($_POST['lb_pricing_plan']) ?  $_POST['lb_pricing_plan'] : '';
        $plan_cost= isset($_POST['lb_plan_cost']) ?  $_POST['lb_plan_cost'] : '';
        $plan_type= isset($_POST['lb_plan_type']) ?  $_POST['lb_plan_type'] : '';

        //insert plan info
        $user->insertPlanInfo($enrollee_type,$pricing_plan,$plan_cost,$plan_type);

        /* check for enrollment type  */
        if($enrollee_type=="Family"){
            //participant details
            $fam_first_name= isset($_POST['fam_first_name']) ?  $_POST['fam_first_name'] : '';
            $fam_last_name= isset($_POST['fam_last_name']) ?  $_POST['fam_last_name'] : '';
            $fam_birthdate= isset($_POST['fam_birthdate']) ?  $_POST['fam_birthdate'] : '';
            $fam_gender= isset($_POST['fam_gender']) ?  $_POST['fam_gender'] : '';
            $fam_state= isset($_POST['fam_state']) ?  $_POST['fam_state'] : '';
            
            //insert family info
            $user->insertParticipantInfo($fam_first_name,$fam_last_name,$fam_birthdate,$fam_gender,$fam_state);
        }
    }

    /* check for succesfull operations */
    if($user->isSuccess())
    {
        /* unset current user id */
        $_SESSION['cur_id']="";
        unset($_SESSION['cur_id']);

        $status = true;
        $respmsg = 'Registration successful';
    }

    echo json_encode(array('status'=>$status,'message'=>$respmsg));exit;
}else{
	echo json_encode(array('status'=>$status,'message'=>'Please fill mandatory details.'));exit;
}
?>