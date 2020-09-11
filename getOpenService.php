<?php

include 'service_parameter.php';

$todayServiceList = [];

foreach($serviceList as $service)
{
    foreach($service["openDays"] as $days )
    {
        if($days == $_GET['day'])
        {
            array_push($todayServiceList,$service);
            break;
        }
    }
}

echo json_encode($todayServiceList);

?>
