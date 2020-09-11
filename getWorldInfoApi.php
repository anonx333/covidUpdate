<?php

class worldApi{
    public function __construct($countryInfo,
                                $worldInfo,
                                $countryList){

        $this->countryInfo = $countryInfo;
        $this->worldInfo   = $worldInfo;
        $this->countryList = $countryList;

        $this->worldApiArray = ["countryInfo" => $countryInfo->infoCountryArray,
                                "worldInfo"   => $worldInfo->infoCountryArray,
                                "countryList" => $countryList];
    }
}

class countryInfo{
    public function __construct($countryInfoCountry,
                                $countryInfoTotalTest,
                                $countryInfoTotalCase,
                                $countryInfoNewCase,
                                $countryInfoTotalRecovered,
                                $countryInfoActiveCase,
                                $countryInfoTotalDeath,
                                $countryInfoNewDeath){

        $this->infoCountry         = $countryInfoCountry;
        $this->infoTotalTest       = $countryInfoTotalTest;
        $this->infoTotalCase       = $countryInfoTotalCase;
        $this->infoNewCase         = $countryInfoNewCase;
        $this->infoTotalRecovered  = $countryInfoTotalRecovered;
        $this->infoActiveCase      = $countryInfoActiveCase;
        $this->infoTotalDeath      = $countryInfoTotalDeath;
        $this->infoNewDeath        = $countryInfoNewDeath;

        $this->infoCountryArray = ["infoCountry"        =>  $countryInfoCountry,
                                   "infoTotalTest"      =>  $countryInfoTotalTest,
                                   "infoTotalCase"      =>  $countryInfoTotalCase,
                                   "infoNewCase"        =>  $countryInfoNewCase,
                                   "infoTotalRecovered" =>  $countryInfoTotalRecovered,
                                   "infoActiveCase"     =>  $countryInfoActiveCase,
                                   "infoTotalDeath"     =>  $countryInfoTotalDeath,
                                   "infoNewDeath"       =>  $countryInfoNewDeath];
    }
}

$main_url="https://www.worldometers.info/coronavirus/";

$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

$str = file_get_contents($main_url, false, stream_context_create($arrContextOptions));

$doc = new DOMDocument; 
@$doc->loadHTML($str); 

$tableMain = $doc->getElementById('main_table_countries_today');
$tableBody = $tableMain->getElementsByTagName("tbody")->item(0);
$rows = $tableBody->getElementsByTagName("tr");

if (isset($_GET['country'])){
   $searchCountry = $_GET['country'];
}
else{
    $searchCountry = "Nepal";
}

$searchCountry = str_replace(' ', '', $searchCountry);

$fetched = false;
$countryList = [];

foreach ($rows as $row) {
   $cells = $row -> getElementsByTagName('td');
   $i = 0;

   foreach ($cells as $cell) {
       if($i == 1)
       {
           $country = $cell->nodeValue;
           array_push($countryList, $country);
       }

       if($i == 2)
       {
           $totalCase = $cell->nodeValue;
       }

       if($i == 3)
       {
           $newCase = $cell->nodeValue;
       }

       if($i == 6)
       {
           $totalRecovered = $cell->nodeValue;
       }

       if($i == 8)
       {
           $activeCase = $cell->nodeValue;
       }

       if($i == 4)
       {
           $totalDeath = $cell->nodeValue;
       }

       if($i == 5)
       {
           $newDeath = $cell->nodeValue;
       }

       if($i == 12)
       {
           $totalTest = $cell->nodeValue;
       }

       $i++;

   }


   if(str_replace(' ', '', $country) == $searchCountry){
       $InfoCountry        = (trim($country) == "")?"0":$country;
       $InfoTotalTest      = (trim($totalTest) == "")?"0":$totalTest;
       $InfoTotalCase      = (trim($totalCase) == "")?"0":$totalCase;
       $InfoNewCase        = (trim($newCase) == "")?"":"(".$newCase.")";
       $InfoTotalRecovered = (trim($totalRecovered) == "")?"0":$totalRecovered;
       $InfoActiveCase     = (trim($activeCase) == "")?"0":$activeCase;
       $InfoTotalDeath     = (trim($totalDeath) == "")?"0":$totalDeath;
       $InfoNewDeath       = (trim($newDeath) == "")?"":"(".$newDeath.")";

       $countryInfo = new countryInfo($InfoCountry,
                                      $InfoTotalTest,
                                      $InfoTotalCase,
                                      $InfoNewCase,
                                      $InfoTotalRecovered,
                                      $InfoActiveCase,
                                      $InfoTotalDeath,
                                      $InfoNewDeath);

       $fetched = TRUE;
   }
}

sort($countryList);

if(!$fetched){
   $InfoCountry        = $searchCountry;
   $InfoTotalTest      = 0;
   $InfoTotalCase      = 0;
   $InfoNewCase        = "";
   $InfoTotalRecovered = 0;
   $InfoActiveCase     = 0;
   $InfoTotalDeath     = 0;
   $InfoNewCase        = "";

    $countryInfo = new countryInfo($InfoCountry,
                                   $InfoTotalTest,
                                   $InfoTotalCase,
                                   $InfoNewCas,
                                   $InfoTotalRecovered,
                                   $InfoActiveCase,
                                   $InfoTotalDeath,
                                   $InfoNewDeath);
}

$tableMain = $doc->getElementById('main_table_countries_today');
$tableBody = $tableMain->getElementsByTagName("tbody")->item(2);
$rows = $tableBody->getElementsByTagName("tr");

foreach ($rows as $row) {
   $cells = $row -> getElementsByTagName('td');
   $i = 0;

   foreach ($cells as $cell) {
       if($i == 1)
       {
           $country = $cell->nodeValue;
       }

       if($i == 2)
       {
           $totalCase = $cell->nodeValue;
       }

       if($i == 3)
       {
           $newCase = $cell->nodeValue;
       }

       if($i == 6)
       {
           $totalRecovered = $cell->nodeValue;
       }

       if($i == 8)
       {
           $activeCase = $cell->nodeValue;
       }

       if($i == 4)
       {
           $totalDeath = $cell->nodeValue;
       }

       if($i == 5)
       {
           $newDeath = $cell->nodeValue;
       }

       if($i == 12)
       {
           $totalTest = $cell->nodeValue;
       }

       $i++;

   }

       $worldInfoCountry        = "World";
       $worldInfoTotalTest      = (trim($totalTest) == "")?"0":$totalTest;
       $worldInfoTotalCase      = (trim($totalCase) == "")?"0":$totalCase;
       $worldInfoNewCase        = (trim($newCase) == "")?"":"(".$newCase.")";
       $worldInfoTotalRecovered = (trim($totalRecovered) == "")?"0":$totalRecovered;
       $worldInfoActiveCase     = (trim($activeCase) == "")?"0":$activeCase;
       $worldInfoTotalDeath     = (trim($totalDeath) == "")?"0":$totalDeath;
       $worldInfoNewDeath       = (trim($newDeath) == "")?"":"(".$newDeath.")";

       $world = new countryInfo($worldInfoCountry,
                                $worldInfoTotalTest,
                                $worldInfoTotalCase,
                                $worldInfoNewCase,
                                $worldInfoTotalRecovered,
                                $worldInfoActiveCase,
                                $worldInfoTotalDeath,
                                $worldInfoNewDeath);

}

$worldApi = new worldApi($countryInfo,$world,$countryList);

echo json_encode($worldApi->worldApiArray);

?>
