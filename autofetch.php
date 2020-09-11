<?php

include 'accessToken.php';

$dayBefore = -7;

$year = date("Y", strtotime("1 days"));
$month = date("m", strtotime("1 days"));
$day  = date("d", strtotime("1 days"));

$fromYear = date("Y", strtotime("$dayBefore days"));
$fromMonth = date("m", strtotime("$dayBefore days"));
$fromDay   = date("d", strtotime("$dayBefore days"));

$searchDate = ["year"      => $year,
               "month"     => $month,
               "day"       => $day,
               "fromYear"  => $fromYear,
               "fromMonth" => $fromMonth,
               "fromDay"   => $fromDay];

include 'fetch_parameter.php';

$uploadList = [];
$token = $_POST["token"];

include 'fetch_function.php';

if ($token == $checkToken)
{
    // from setopati
    $setopatiList = [];
    $setopatiList = fetchFromSetoPati("Setopati", $websiteList["setopati"],$searchDate,$keywordList);
    
    for($i = 0 ; $i < count($setopatiList) ; $i++)
    {
        array_push($uploadList,$setopatiList[$i]);
    }

    //onlinekhabar
    $onlineKhabarList = [];
    $onlineKhabarList = fetchFromOnlineKhabar("Onlinekhabar",$websiteList["onlinekhabar"],$searchDate,$keywordList);
    
    for($i = 0 ; $i < count($onlineKhabarList) ; $i++)
    {
        array_push($uploadList,$onlineKhabarList[$i]);
    }

    //ratopati
    $ratoPatiList = [];
    $ratoPatiList = fetchFromRatoPati("Ratopati",$websiteList["ratopati"],$searchDate,$keywordList);
    
    for($i = 0 ; $i < count($ratoPatiList) ; $i++)
    {
        array_push($uploadList,$ratoPatiList[$i]);
    }

    //ekantipur
    $ekantipurList = [];
    $ekantipurList = fetchFromEkantipur("eKantipur",$websiteList["eKantipur"],$searchDate,$keywordList);
    
    for($i = 0 ; $i < count($ekantipurList) ; $i++)
    {
        array_push($uploadList,$ekantipurList[$i]);
    }

    //himalayantimes
    $himalayantimesList = [];
    $himalayantimesList = fetchFromHimalayanTimes("Himalayan Times",$websiteList["himalayantimes"],$searchDate,$keywordList);
    
    for($i = 0 ; $i < count($himalayantimesList) ; $i++)
    {
        array_push($uploadList,$himalayantimesList[$i]);
    }

    //annapurnapost
    $annapurnapostList = [];
    $annapurnapostList = fetchFromAnnapurnaPost("Annapurna Post",$websiteList["annapurnapost"],$searchDate,$keywordList);
    
    for($i = 0 ; $i < count($annapurnapostList) ; $i++)
    {
        array_push($uploadList,$annapurnapostList[$i]);
    }
    
    if(count($uploadList) > 0){

        
        $todayyear  = date("Y");
        $todaymonth = date("m");
        $todayday   = date("d");
        
        $newsdate  = $todayday."-".$todaymonth."-".$todayyear;  
        
        if(isset($_POST['localfetch']))
        {
            echo json_encode($uploadList);
        }
        else
        {
            include 'dbConnect.php';

            
            for($i = count($uploadList) - 1 ; $i >= 0 ; $i--)
            {   
                $newstitle = str_replace("'","&#39;",$uploadList[$i]['newstitle']);
                $newslink  = $uploadList[$i]['newslink'];
                $newsdesc  = $uploadList[$i]['newssource'];
                
                $searchLink = "Select * From news Where newslink = '$newslink'";
                $result = $conn->query($searchLink);
                
                if($result->num_rows == 0)
                {
                    if($newsdesc == "Himalayan Times" )
                    {
                        echo $newslink."<br/>";
                    } 
                    $sql = "INSERT INTO news (newstitle,newslink,newsdesc,newssource,newsdate) VALUES ('$newstitle','$newslink','$newsdesc','$newsdesc','$newsdate' )";
                
                    if ($conn->query($sql) === TRUE) {
    
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        }
    }
}

?>