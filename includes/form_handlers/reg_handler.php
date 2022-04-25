<?php
//declaring variables to prevent errors
$fname = ""; //firstname
$lname = ""; //lastname
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$date = ""; // sign up date
$error_array = array(); //hlds error messages

if(isset($_POST['reg_button'])){

    //Registration of form values

    //First name
    $fname = strip_tags($_POST['reg_fname']); //removes html tags
    $fname = str_replace(' ', '', $fname); //removes spaces
    $fname = ucfirst(strtolower($fname)); //Capitalizes the first letter
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable

    //Last name
    $lname = strip_tags($_POST['reg_lname']); //removes html tags
    $lname = str_replace(' ', '', $lname); //removes spaces
    $lname = ucfirst(strtolower($lname));//Capitalizes the first letter
    $_SESSION['reg_lname'] = $lname; //stores last name into session variable

    //email
    $em = strip_tags($_POST['reg_email']);//removes html tags
    $em = str_replace(' ', '', $em);//removes spaces
    $em = ucfirst(strtolower($em));//Capitalizes the first letter
    $_SESSION['reg_email'] = $em; //stores email into session variable

    //email 2
    $em2 = strip_tags($_POST['reg_email2']);//removes html tags
    $em2 = str_replace(' ', '', $em2); //removes spaces
    $em2 = ucfirst(strtolower($em2));//Capitalizes the first letter
    $_SESSION['reg_email2'] = $em2; //stores email2 into session variable

    //password
    $password = strip_tags($_POST['reg_password']);//removes html tags
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable


    //password 2
    $password2 = strip_tags($_POST['reg_password2']);//removes html tags

    $date = date("y-m-d"); //Gets the current date

    if($em == $em2){
        //check if the email is in valid
        if(filter_var($em,FILTER_VALIDATE_EMAIL)){

            $em = filter_var($em,FILTER_VALIDATE_EMAIL);

            //Check if email exist
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '{$em}'");

            //count the number of rows returned
            $num_row = mysqli_num_rows($e_check);

            if($num_row > 0){
                array_push($error_array, "Email already in use<br>");
            }
        }
        else {
            array_push($error_array, "Invalid Format<br>");
        }
    } 
    else {
        array_push($error_array, "Emails don't match<br>");
    }

    if(strlen($fname) > 255 || strlen($fname) < 2){
        array_push($error_array, "Your first name must be between 2 and 255 characters<br>");
    }

    if(strlen($lname) > 255 || strlen($lname) < 2){
        array_push($error_array, "Your last name must be between 2 and 255 characters<br>");
    }

    if($password != $password2){
        array_push($error_array, "Your passwords do not match<br>");
    }
    else{
        if(preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($error_array, "Your password can only contain english characters<br>");
        }
    }

    if(strlen($password) > 255 || strlen($password) < 5){
        array_push($error_array, "Your password must be between 5 and 255 characters<br>");
    }

    if(empty($error_array)){
        $password = md5($password); //Encrypt password before sending to the database

        //Generate username by concatenating first name and last name
        $username = strtolower($fname ."_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '{$username}'");

        $i = 0;
        //if username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0){
            $i++;
            $username = $username . "_" . $id;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '{$username}'");
            return $username;
        }

        //Profile picture assignment
        $rand = rand(1, 3);
        switch($rand){
            case 1;
            $profile_pic = "assets/images/profile_pics/default/1.png";
            break;

            case 2;
            $profile_pic = "assets/images/profile_pics/default/2.png";
            break;

            case 3;
            $profile_pic = "assets/images/profile_pics/default/3.png";
            break;

            default:
            echo "System Error Fix";
            break;
        }

        $query = mysqli_query($con, "INSERT INTO users VALUES('','{$fname}','{$lname}','{$username}', '{$em}', '{$password}','{$date}','{$profile_pic}', '0', '0', 'no', ',')");

        array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");

        //Clear Session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }
}


?>