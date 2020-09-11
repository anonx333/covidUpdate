<?php

include 'dbConnect.php';
include 'accessToken.php';

$token       = $_POST["token"];
$newstitle   = $_POST["newstitle"];
$newslink    = $_POST["newslink"];
$newsdate    = $_POST["newsdate"];
$newsdesc    = $_POST["newsdesc"];
$newssource  = $_POST["newssource"];


if ($token == $checkToken)
{
    $searchLink = "Select * from news where newslink = '$newslink'";

    $result = $conn->query($searchLink);

        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO news (newstitle,newslink,newsdesc,newssource,newsdate) 
                VALUES ('$newstitle','$newslink','$newsdesc','$newssource','$newsdate')";
            
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

}

?>