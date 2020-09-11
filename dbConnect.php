<?php
$conn = new mysqli("localhost","root","","kukhurikandb");
$conn -> set_charset("utf8");
// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>