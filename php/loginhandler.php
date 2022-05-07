<?php

require './dbhandler.php';

$email = $_POST['email'];
$password = $_POST['password'];
$ok = true;
$serverResponse = array();

if (empty($email)  || empty($password)) {
    $ok = false;
    $serverResponse[] = 'Fields cannot be empty';
} else {

    $sql  = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $ok = false;
        $serverResponse[] = 'Cannot connect! Try Again.';
    } else {

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $db_password = $row['password'];
            $hash_password    = md5($password);
            if ($db_password !== $hash_password) {
                $ok = false;
                $serverResponse[] = 'Wrong Password';
            } else if ($db_password === $hash_password) {

                $ok = true;
                $serverResponse[] = 'Login Successful!';
                session_start();
                $_SESSION['useragent'] = $row["email"];
            } else {

                $ok = false;
                $serverResponse[] = 'Unknown Error Occured!';
            }
        } else {

            $ok = false;
            $serverResponse[] = 'No such user exist in our records! Try again';
        }
    }

    echo json_encode(

        array(
            'ok' => $ok,
            'messages' => $serverResponse
        )
    );
}
