<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function( Request $request , Response $response , $args ) {
    $mysqli = mysqli_connect('localhost', 'root', 'ewhite', 'db');

    $first = $request->getQueryParam('first');
    $last = $request->getQueryParam('last');

    $query = "SELECT * FROM users";
    if ( $first || $last ) {
        $query .= " WHERE";
        if ( $first ) {
            $query .= " first_name = '$first'";
        }
        if ( $last ) {
            if ( $first ) {
                $query .= " AND";
            }
            $query .= " last_name = '$last'";
        }
    }
    $result = mysqli_query( $mysqli , $query );
    if( !$result ) {
        return $response->withStatus(400)->write('Invalid Query');
    }
    $users = array();
    while ( $row = mysqli_fetch_object( $result ) ) {
        $users[] = $row;
    }

    foreach ( $users as $user ) {
        $user->emails = array();
        $qEmails = "
        SELECT email
        FROM emails
        WHERE user_id = $user->user_id";
        $resultEmails = mysqli_query( $mysqli , $qEmails );
        while ( $row = mysqli_fetch_object( $resultEmails ) ) {
            $user->emails[] = $row->email;
        }
    }

    return $response->write( json_encode( $users ) );
};
?>