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
    
    /* Member functions */
    function __construct() {
        //$this->con=DB::getDB();
        $this->step1=false;
        $this->step2=false;
        $this->step3=false;
        $this->step4=false;
        $this->con=DB::getcon();
    }
    
    /**
     * Checks already registered email
     * @param email address
     * @return true if email available
     */
    function checkEmail($email)
    {
        $sql = "SELECT u_id, first_name FROM user_personal_detail where email='".$email."'";
        
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
            echo mysqli_error($this->con);
        }
        return $avail;

    }
    
    function signUp($first_name,$email,$phone)
    {
        $created_at=date("Y-m-d H:i:s",time());
        $sql = "INSERT INTO user_personal_detail(first_name,email,phone_no,created_at) values('$first_name','$email','$phone','$created_at')";

        //$id=0;

        if(mysqli_query($this->con, $sql))
        {
            $id=mysqli_insert_id($this->con);
        }
        else
        {
            echo mysqli_error($this->con);

        }
        //mysqli_close($conn);
        return $id;  

    }

    function getUserData($id)
    {
        $sql="select first_name,email from user_personal_detail where u_id=".$id;
        $result = mysqli_query($this->con, $sql);
        
        $arr=array();
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               //echo "Name: " . $row["first_name"]. "<br>";
             $arr[0]=$row["first_name"];
             $arr[1]=$row["email"];
         }
     } else {
            //echo "0 results";
     }
     return $arr;
 }
 function insertPersonalInfo($first_name,$middle_name,$last_name,$birthdate,$state,$gender,$email,$password)
 {
    //check for already registered email
    $uid=$_SESSION['cur_id'];
    mysqli_autocommit($this->con,FALSE);
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "update user_personal_detail set first_name='$first_name',middle_name='$middle_name',last_name='$last_name',resident_state='$state',gender='$gender',birthdate='$birthdate',email='$email',password='$hashed_password' where u_id='".$uid."'";

    if(mysqli_query($this->con, $sql))
    {
        $this->step1=true;
    }
    else
    {
        echo mysqli_error($this->con);
    }
}
function insertParticipantInfo($fam_first_name,$fam_middle_name,$fam_last_name,$fam_birthdate,$fam_gender,$fam_state)
{
    mysqli_autocommit($this->con,FALSE);
    $uid=$_SESSION['cur_id'];
    
    for($x = 0; $x < count($fam_first_name); $x++ )
    {
        $fname=$fam_first_name[$x];
        $fmname=$fam_middle_name[$x];
        $flname=$fam_last_name[$x];
        $fbirthdate=$fam_birthdate[$x];
        $fgender=$fam_gender[$x];
        $fstate=$fam_state[$x];
        $sql = "INSERT INTO user_family_detail(first_name,middle_name,last_name,birthdate,gender,resident_state,u_id) values('$fname','$fmname','$flname','$fbirthdate','$fgender','$fstate','$uid')";

        if(mysqli_query($this->con, $sql))
        {
                //$n=$n+1;
                //echo $n;
            $this->step3=true;
        }
        else
        { 
            echo mysqli_error($this->con);

        }
    }
}
function insertPlanInfo($enrollee_type,$pricing_plan,$plan_cost,$plan_type)
{

    $this->enrolee_type=$enrollee_type;

    mysqli_autocommit($this->con,FALSE);
    $uid=$_SESSION['cur_id'];

    $sql = "INSERT INTO user_plan_detail(u_id,enrollee_type,pricing_plan,plan_cost,plan_type) values('$uid','$enrollee_type','$pricing_plan','$plan_cost','$plan_type')";
    if(mysqli_query($this->con, $sql))
    {
        $this->step2=true;
    }
    else
    {
        echo mysqli_error($this->con);
    }

}
function insertBillingInfo($bill_first_name,$bill_address,$bill_city,$bill_pincode,$bill_country,$card_no,$card_holder,$card_expiry,$card_cvv)
{


    mysqli_autocommit($this->con,FALSE);
    $uid=$_SESSION['cur_id'];
    $sql = "INSERT INTO user_billing_detail(u_id,bill_first_name,bill_address,bill_city,bill_pincode,bill_country,card_number,card_holder,card_expiry,card_cvv) values('$uid','$bill_first_name','$bill_address','$bill_city','$bill_pincode','$bill_country','$card_no','$card_holder','$card_expiry','$card_cvv')";

    if(mysqli_query($this->con, $sql))
    {
        $this->step4=true;
    }
    else
    {
        echo mysqli_error($this->con);
    }
}

function isSuccess()
{
    if($this->enrolee_type=="Single")
    {
        $this->step3=true;
    }
    if($this->step1&&$this->step2&&$this->step3&&$this->step4)
    {
        mysqli_commit($this->con);
           // echo "commit";
        mysqli_close($this->con);
        return true;
    }
    else{
        echo mysqli_error($this->con);
        mysqli_rollback($this->con);
            //echo "rollback";
        mysqli_close($this->con);
        return false;
    }
}
}
?>
