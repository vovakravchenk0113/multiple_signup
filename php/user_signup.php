<?php
require_once('user.php');
require_once('dbconnect.php');
ob_start();

$user=new User();

if(isset($_POST['submit']))
{
        if(isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['last_name']))
        {
            $first_name= isset($_POST['first_name']) ? $_POST['first_name'] : '';
            $last_name= isset($_POST['last_name']) ? $_POST['last_name'] : '';
            $email= isset($_POST['email']) ? $_POST['email'] : '';
            $password= isset($_POST['password']) ? $_POST['password'] : '';

            if($first_name != '' && $last_name != '' && $email != '' && $password != '')
            {
                //check for email format
                if(valid_email($email))
                {
                    //check if user exists with email
                    if( $user->checkEmail($email))
                    {
                        $id=$user->signUp($first_name,$last_name,$email,$password);
                        if($id>0)
                        {
                            //set current user id for the form
                            $_SESSION['cur_id']=$id;
                            header('Location:../registration.php');
                        }
                        else{
                        ?>
                            <script>alert('Error in singup.Try again.');history.back();</script>
                        <?php
                        }
                    }
                    else{
                        ?>
                            <script>alert('Email address is already registered.');history.back();</script>
                        <?php
                        }
                }
                else{
                    ?>
                        <script>alert('Email addrees is not valid.');history.back();</script>
                    <?php
                    } 
            }
        }
}

//function to chek email address
function valid_email($email) 
{
    if(is_array($email) || is_numeric($email) || is_bool($email) || is_float($email) || is_file($email) || is_dir($email) || is_int($email))
        return false;
    else
    {
        $email=trim(strtolower($email));
        if(filter_var($email, FILTER_VALIDATE_EMAIL)!==false) return $email;
        else
        {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            return (preg_match($pattern, $email) === 1) ? $email : false;
        }
    }
}
?>