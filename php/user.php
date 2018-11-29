<?php
require_once("dbconnect.php");
ob_start();
session_start();
error_reporting( E_ALL );
ini_set('display_errors', 1);

?>
<?php
class User {

    /* member variables */
    private $con;
    private $step1;
    private $step2;
    private $step3;
    private $step4;
    private $enrollee_type;
    private $user_id;
    private $created_at;
    
    /* Member functions */
    function __construct() {
        //$this->con=DB::getDB();
        $this->step1=false;
        $this->step2=false;
        $this->step3=false;
        $this->step4=false;
        $this->con=DB::getcon();
        $this->created_at=date("Y-m-d H:i:s",time());
		if(isset($_SESSION['cur_id']) && !empty($_SESSION['cur_id']))
		{	
			$this->uid=$_SESSION['cur_id'];
		}
    }
    
    /**
     * Checks already registered email
     * @param email address
     * @return true if email available
     */
    function checkEmail($email)
    {
        $email=mysqli_real_escape_string($this->con, $email);

        $sql = "SELECT u_id,first_name FROM user_personal_detail where email='".$email."'";
        
        $result = mysqli_query($this->con, $sql);
        
        $avail=false;

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $avail=false;
            }
        } else {
            $avail=true;
            //echo "0 results";
            //echo mysqli_error($this->con);
        }
        return $avail;

    }
    
    /**
     * inserts new user to the database
     */
    function signUp($first_name,$last_name,$email,$password)
    {
        $first_name=mysqli_real_escape_string($this->con, $first_name);
        $last_name=mysqli_real_escape_string($this->con, $last_name);
        $email=mysqli_real_escape_string($this->con, $email);
        $password=mysqli_real_escape_string($this->con, $password);

        /* encrype user password */
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user_personal_detail(first_name,last_name,email,password,created_at) values('$first_name','$last_name','$email','$hashed_password','$this->created_at')";

        $id=0;

        if(mysqli_query($this->con, $sql))
        {
            $id=mysqli_insert_id($this->con);
            $result=true;
        }
        else
        {
            //echo mysqli_error($this->con);

        }
        return $id; //return last inserted user id

    }

    /** 
     * returns users data from database with given id 
     */
    function getUserData($id)
    {
        $sql="select first_name,last_name from user_personal_detail where u_id=".$id;
        $result = mysqli_query($this->con, $sql);
        
        $arr=array();
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               //echo "Name: " . $row["first_name"]. "<br>";
             $arr[0]=$row["first_name"];
             $arr[1]=$row["last_name"];
         }
     } else {
            //echo "0 results";
     }
     return $arr; //return array of user data
 }

 /**
  * Updates current user personal details.
  */
 function insertPersonalInfo($first_name,$last_name,$address,$city,$state,$zipcode,$mobile_no,$birthdate,$gender)
 {
    //echo "personal";

    mysqli_autocommit($this->con,FALSE);

    $first_name=mysqli_real_escape_string($this->con, $first_name);
    $last_name=mysqli_real_escape_string($this->con, $last_name);
    $address=mysqli_real_escape_string($this->con, $address);
    $city=mysqli_real_escape_string($this->con, $city);
    $state=mysqli_real_escape_string($this->con, $state);
    $mobile_no=mysqli_real_escape_string($this->con, $mobile_no);
    $zipcode=mysqli_real_escape_string($this->con, $zipcode);
    $birthdate=mysqli_real_escape_string($this->con, $birthdate);
    $gender=mysqli_real_escape_string($this->con, $gender);
    
    $modify_date=date("Y-m-d H:i:s",time());

    $sql = "update user_personal_detail set first_name='$first_name',last_name='$last_name',address='$address',city='$city',resident_state='$state',mobile_no='$mobile_no',gender='$gender',birthdate='$birthdate',modified_at='$modify_date',reg_comp=1 where u_id='".$this->uid."'";

    if(mysqli_query($this->con, $sql))
    {
        $this->step1=true;
		//echo "done";
    }
    else
    {
        //echo mysqli_error($this->con);
    }
}

/**
 * Inserts user's family member details in database
 */
function insertParticipantInfo($fam_first_name,$fam_last_name,$fam_birthdate,$fam_gender,$fam_state)
{
	//echo "participant";
	
    mysqli_autocommit($this->con,FALSE);

    for($x = 0; $x < count($fam_first_name); $x++ )
    {
        $fname=mysqli_real_escape_string($this->con,$fam_first_name[$x]);
        $flname=mysqli_real_escape_string($this->con,$fam_last_name[$x]);
        $fbirthdate=mysqli_real_escape_string($this->con,$fam_birthdate[$x]);
        $fgender=mysqli_real_escape_string($this->con,$fam_gender[$x]);
        $fstate=mysqli_real_escape_string($this->con,$fam_state[$x]);
        
        $sql = "INSERT INTO user_family_detail(first_name,last_name,birthdate,gender,resident_state,u_id,created_at) values('$fname','$flname','$fbirthdate','$fgender','$fstate','$this->uid','$this->created_at')";

        if(mysqli_query($this->con, $sql))
        {
            $this->step3=true;
			//echo "done";
        }
        else
        { 
            //echo mysqli_error($this->con);
        }
    }
}

/**
 * Inserts user's plan information in the database.
 */
function insertPlanInfo($enrollee_type,$pricing_plan,$plan_cost,$plan_type)
{
	//echo "plan";
    
    mysqli_autocommit($this->con,FALSE);

    $enrollee_type=mysqli_real_escape_string($this->con,$enrollee_type);
    $pricing_plan=mysqli_real_escape_string($this->con,$pricing_plan);
    $plan_cost=mysqli_real_escape_string($this->con,$plan_cost);
    $plan_type=mysqli_real_escape_string($this->con,$plan_type);
    
    $this->enrolee_type=$enrollee_type;

    $sql = "INSERT INTO user_plan_detail(u_id,enrollee_type,pricing_plan,plan_cost,plan_type,created_at) values('$this->uid','$enrollee_type','$pricing_plan','$plan_cost','$plan_type','$this->created_at')";
    if(mysqli_query($this->con, $sql))
    {
        $this->step2=true;
		//echo "done";
    }
    else
    {
        //echo mysqli_error($this->con);
    }

}

/**
 * Inserts user's billing information into database
 */
function insertBillingInfo($card_no,$card_holder,$card_expiry,$card_cvv)
{

	//echo "billing";
	
    mysqli_autocommit($this->con,FALSE);

    $card_no=mysqli_real_escape_string($this->con,$card_no);
    $card_holder=mysqli_real_escape_string($this->con,$card_holder);
    $card_expiry=mysqli_real_escape_string($this->con,$card_expiry);
    $card_cvv=mysqli_real_escape_string($this->con,$card_cvv);

    $sql = "INSERT INTO user_billing_detail(u_id,card_number,card_holder,card_expiry,card_cvv,created_at) values('$this->uid','$card_no','$card_holder','$card_expiry','$card_cvv','$this->created_at')";

    if(mysqli_query($this->con, $sql))
    {
        $this->step4=true;
		//echo "done";
    }
    else
    {
        //echo mysqli_error($this->con);
    }
}

/**
 * Checks for all the transaction complete
 */
function isSuccess()
{
    if($this->enrolee_type=="Single")
    {
        $this->step3=true;
    }

    if($this->step1&&$this->step2&&$this->step3&&$this->step4)
    {
        /* if all success */
        mysqli_commit($this->con);
           // echo "commit";
        mysqli_close($this->con);
        return true;
    }
    else{
        /* if falied all transactions */
        //echo mysqli_error($this->con);
        mysqli_rollback($this->con);
            //echo "rollback";
        mysqli_close($this->con);
        return false;
    }
}
}
?>
