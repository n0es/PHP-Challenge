<?php
return function( $request, $response, $args ){
    $mysqli = mysqli_connect('localhost', 'root', 'ewhite', 'db');
    $id = $args['id'];

    $query = "SELECT * FROM users WHERE user_id = $id";
    $user = mysqli_fetch_assoc( mysqli_query( $mysqli , $query ) );
    if( !$user ) {
        return $response->withStatus(404)->write('User not found');
    }
    $qName = "
    SELECT first_name, last_name
    FROM users
    WHERE user_id = $id";
    $resultName = mysqli_query( $mysqli , $qName );
    $name = $resultName->fetch_assoc();
    $JSON = new Class {};
    $JSON->first_name = $name['first_name'];
    $JSON->last_name = $name['last_name'];
    $JSON->emails = array();
    $qEmails = "
    SELECT email
    FROM emails
    WHERE user_id = $id";
    $resultEmails = mysqli_query( $mysqli , $qEmails );
    while ( $row = mysqli_fetch_object( $resultEmails ) ) {
        $JSON->emails[] = $row->email;
    }
    return $response->write( json_encode( $JSON ) );
}

?>