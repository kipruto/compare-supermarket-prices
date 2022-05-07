<?php

require './dbhandler.php';

$email = $_POST['email'];
$password = $_POST['password'];
$pwdrepeat = $_POST['npassword'];

$ok = true;
$serverResponse = array();

//check to see if any field has been left blank

if (empty($email) || empty($password) || empty($pwdrepeat)) {

    $ok = false;
    $serverResponse[] = 'Fields cannot be empty';

} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $password)) {
    $ok = false;
    $serverResponse[] = 'Invalid Email/Password combination!';

}

// check to see if the email is valid.

elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $ok = false;
    $serverResponse[] = 'invalid Email';

}
//validate password
elseif (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {

    $ok = false;
    $serverResponse[] = 'Password is not acceptable! Try Again';

} else if ($password !== $pwdrepeat) {
    $ok = false;
    $serverResponse[] = 'Passwords dont match!';
    exit();

} else {

    $sql  = "SELECT email FROM users WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        $ok = false;
        $serverResponse[] = 'Internal Error! Could not connect to server';

    } else {

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);



        if ($resultCheck < 0) {
            $ok = false;
            $serverResponse[] = 'That Email doesnt exists ';

        } else {

            $sql= "UPDATE users SET password =? WHERE email=? ";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {

                $ok = false;
                $serverResponse[] = 'Could not set new password! Internal Error';

            } else {
                $hashedpwd	= md5($password);
                mysqli_stmt_bind_param($stmt, "ss", $email, $hashedpwd);
                mysqli_stmt_execute($stmt);
                session_start();
            
                $ok = true;
                $serverResponse[] = 'Password updated Successful!';
            }
        }

    }

    echo json_encode(

        array(

            'ok' => $ok,
            'messages' => $serverResponse

        )
    );

}





