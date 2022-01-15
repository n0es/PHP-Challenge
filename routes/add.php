<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
 
return function( $request , $response ){
    if($request->isGet()) {
        return $this->view->render( $response , 'add.phtml' );
    }
    if($request->isPost()) {
        $body = $request->getParsedBody();
        $first_name = $body['first_name'];
        $last_name = $body['last_name'];
        $email = $body['email'];

        if ( !$first_name || !$last_name || !$email ) 
            return $this->view->render( $response , 'add.phtml', ['error' => 'Missing data! Please fill out the form.'] );
        

        $mysqli = mysqli_connect('localhost', 'root', 'ewhite', 'db');

        // if user already exists, do not create a new user. find the user_id and insert the email
        // if user does not exist, create a new user and insert the email

        $query = "SELECT * FROM users WHERE first_name = '$first_name' AND last_name = '$last_name'";
        $result = mysqli_query($mysqli, $query);
        $user = mysqli_fetch_assoc($result);
        if ( $user ) {
            $user_id = $user['user_id'];
            $query = "INSERT INTO emails (user_id, email) VALUES ($user_id, '$email')";
            $result = mysqli_query( $mysqli , $query );
        } else {
            $queryUser = "INSERT INTO users (first_name, last_name) VALUES ('$first_name', '$last_name')";
            $resultUser = mysqli_query( $mysqli , $queryUser );
            $user_id = mysqli_insert_id( $mysqli );
            $queryEmail = "INSERT INTO emails (user_id, email) VALUES ($user_id, '$email')";
            $resultEmail = mysqli_query( $mysqli , $queryEmail );
        }
        return $this->view->render( $response, 'add.phtml', ['message' => 'Successfully added '.$email.' to '.$first_name.' '.$last_name] );
    }
    return;
}
?>