<?php

include 'dbConnect.php';
include 'accessToken.php';

$newsid = $_POST["newsid"];
$token  = $_POST["token"];

if ($token == $deleteToken)
{
    $sql = "DELETE FROM news WHERE news.newsid = $newsid";
    
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

?>