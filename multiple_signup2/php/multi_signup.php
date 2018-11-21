<?php
require_once('user.php');
ob_start();

    //code for multi form
if($_POST['finish'] == '')
{

    $user=new User();
    if($_POST['first_name']  && $_POST['last_name'])
    {
            //personal detail
        $first_name=$_POST['first_name'];
        $middle_name=$_POST['middle_name'];
        $last_name=$_POST['last_name'];
        $email=$_POST['email'];
        $state=$_POST['state'];
        $birthdate=$_POST['birthdate'];
        $gender=$_POST['gender'];
        $password=$_POST['password'];

        if(!empty($first_name)&&!empty($last_name)&&!empty($email)&&!empty($password))
        {
            
                $user->insertPersonalInfo($first_name,$middle_name,$last_name,$birthdate,$state,$gender,$email,$password);
        }
        else
        {

            ?>
            <script>alert('Please fill all personal details.');history.back();</script>
            <?php

        }
    }


    if(isset($_POST['payment']))
    {
        
    }
    if($_POST['bill_first_name'] && $_POST['bill_city'] && $_POST['bill_address'] && $_POST['bill_pincode'] && $_POST['card_no'] && $_POST['card_expiry'] && $_POST['card_cvv'])
    {
            //billing detail
        $bill_first_name=$_POST['bill_first_name'];
        $bill_address=$_POST['bill_address'];
        $bill_city=$_POST['bill_city'];
        $bill_pincode=$_POST['bill_pincode'];
        $bill_country=$_POST['bill_country'];

        
             //card info
            $card_no=$_POST['card_no'];
            $card_holder=$_POST['card_holder'];
            $card_expiry=$_POST['card_expiry'];
            $card_cvv=$_POST['card_cvv'];

        if(!empty($bill_first_name)&&!empty($bill_address)&&!empty($bill_city))
        {
            $user->insertBillingInfo($bill_first_name,$bill_address,$bill_city,$bill_pincode,$bill_country,$card_no,$card_holder,$card_expiry,$card_cvv);
        }
        else
        {

            ?>
            <script>alert('Please fill billing details.');history.back();</script>
            <?php

        }
    }

    if($_POST['enrollee_type'])
    {
            //product detail
        $enrollee_type=$_POST['enrollee_type'];
        $pricing_plan=$_POST['lb_pricing_plan'];
        $plan_cost=$_POST['lb_plan_cost'];
        $plan_type=$_POST['lb_plan_type'];

        $user->insertPlanInfo($enrollee_type,$pricing_plan,$plan_cost,$plan_type);

        if($enrollee_type=="Family"){
                //participant details
            $fam_first_name=$_POST['fam_first_name'];
            $fam_middle_name=$_POST['fam_middle_name'];
            $fam_last_name=$_POST['fam_last_name'];
            $fam_birthdate=$_POST['fam_birthdate'];
            $fam_gender=$_POST['fam_gender'];
            $fam_state=$_POST['fam_state'];
            $user->insertParticipantInfo($fam_first_name,$fam_middle_name,$fam_last_name,$fam_birthdate,$fam_gender,$fam_state);
        }

    }

        //check for all results
    if($user->isSuccess())
    {
        $_SESSION['cur_id']="";
        session_destroy();
        
        return $user->isSuccess();
        ?>
        <script>alert('Registration successful.');window.location.href='../index2.php?res=1';</script>
        <?php

        
    }
    else{
        ?>
        <script>alert('Error in registration.');</script>
        <?php
    }
}
?>