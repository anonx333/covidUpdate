<?php
header('Content-Type: text/html; charset=utf-8');
include 'header.php';

if (isset($_GET['country'])){
	$searchCountry = $_GET['country'];
 }
 else{
	 $searchCountry = "Nepal";
 }

 $searchCountry = str_replace(' ', '', $searchCountry);

 $main_url= $url."getWorldInfoApi.php?country=".$searchCountry;

 $str = file_get_contents($main_url);
 
 $worldApi = json_decode($str);

include 'dbConnect.php';
include 'service_parameter.php';

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="Ashon Shakya">
    <meta name="description" content="Kukhurikan aims to provide discrete update on Covid 19 cases from all over the world using worldometers as source.">

    <title>Covid 19 Cases Updates for <?php echo $searchCountry; ?></title>
    <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
	<link rel="stylesheet" href="bootstrap.min.css?v=1.1" >
    <script data-ad-client="ca-pub-2649956165965557" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script src="jquery-3.5.0.min.js"></script>
    <style>
        .headerCard{
            height: 225px;
            background-color: #00acb6;
            text-align: center;
            color: white;
            font-size: 37px;
            font-weight: 100;
            padding-top: 15px;
        }

        @media (max-width:600px) {
            .headerCard{
                font-size: 25px;
            }
        }

        .headerWrap{
            height: 200px; 
            text-align: center;
        }

        .cardMainRow{
            min-height: 160px;
            margin-top: 10px;
            height: auto;
        }

        .cardRow{
            margin-top:-75px; 
            min-height: 200px;
            height: auto;
        }

        .numberWrap{
            height: 100%;
        }

        .numberCard{
            background-color: white;
            min-height: 210px;
            border-radius: 20px;
            border: 1px solid #e4e4e4;
            box-shadow: 2px 1px 2px 0px #80808026;
            margin-bottom: 20px;
        }

        .numberCard .header{
            min-height: 64px;
            text-align: center;
            font-size: 21px;
            font-weight: lighter;
            color: #2d2d2d;
            padding-top: 20px;
            padding-bottom: 10px;
            background: #eaeaea;
            border-radius: 20px 20px 0px 0px;
            box-shadow: inset 5px 5px 7px 2px #80808038;
        }

        .numberCard .numberLabel{
            height: 50px;
            line-height: 15px;
            text-align: center;
            font-size: 34px;
            font-weight: bold;
            padding-top: 15px;
            color: #4e4e4e;
        }

        .container-covid{
            margin: auto;
        }

        .searchRow{
        	height: 110px;
		    padding-top: 17px;
        }

        .searchContainer select{
        	width: 100%;
		    height: 50px;
		    font-size: 20px;
            border: 2px solid #0099cb38;
		    padding-left: 10px;
		    font-weight: lighter;
		    color: #2b2b2b;
		    background: #ffffff;
		    border-radius: 4px;
		    box-shadow: 1px 1px 3px #c1c1c163;
        }

        .searchContainer button{
        	height: 50px;
		    min-width: 93px;
		    border-radius: 5px;
            background: #0099cb;
		    border: 0px;
		    color: white;
		    font-size: 12px;
        }

        .imgWrap{
            height:50px;
            width:100%;
            margin-bottom: 15px;
        }

        .imgWrapBig{
            height: 80px;
            width: 100%;
            margin-bottom: 0px;
            padding-top: 15px;
        }

        .imgWrap img{
            height:100%;
        }

        .imgWrapBig img{
            height:100%;
        }
        

        .newRecord{
            font-size: 15px;
            font-weight: lighter;
            margin-top: 20px;
            color: #e84857;
        }

        .newsColumn{
            min-height: 25px;
            margin-top: 10px;
        }

        .newsRow{
            background-color: #ffffff;
            height: auto;
            min-height: 50px;
        }

        .bulletNews{
            height: 25px;
            width: 20px;
            padding-top: 5px;
            text-align: right;
        }

        .bulletClass{
            height: 10px;
            width: 10px;
            background-color: #0099cb;
        }

        .newsWrap{
            display:flex;
        }

        .newsHeadline{
            width: calc(100% - 20px);
            padding-bottom: 10px;
            /* border-bottom: 1px solid #98989826; */

        }

        .newsHeader{
            text-align: center;
            font-size: 20px;
            border-bottom: 1px solid #e2e2e2;
            padding-bottom: 5px;
            margin-bottom: 10px;
            color: #f5552c;
        }

        .newsHeaderWrap{
            background: #eaeaea;
            color: #585858;
            border-radius: 30px 30px 0px 0px;
            height: 90px;
            box-shadow: inset 5px 5px 7px 2px #80808038;
            padding-top: 20px;
            font-weight: lighter;

        }

        .newsContainer{
            border-radius: 0px 0px 20px 20px;
            border: 1px solid #e4e4e4;
            box-shadow: 2px 1px 2px 0px #80808026;
            padding-bottom: 10px;
            padding-top: 10px;
            margin-bottom: 20px;
        }

        .footer{
            background-color: #f1f1f1;
            padding: 20px;
            color: #4c4c4c;
        }

        .serviceFooter{
            background-color: #fff6dd;
            padding: 10px;
            color: #4c4c4c;
            margin-top: 56px;
            border-radius: 0px 0px 20px 20px;
            text-align: center;
            min-height: 68px;
            align-content: center;

        }

        .serviceFooterOpen{
            background: #00cb35 !important;
            color: white !important;
        }

        .serviceHeader{
            min-height: 80px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            color: #636363;
            padding-top: 15px;
            padding-bottom: 10px;
            background: #eaeaea;
            border-radius: 20px 20px 0px 0px;
            box-shadow: inset 5px 5px 7px 2px #80808038;
            align-content: center;
        }

        [class*="col-"] {
        width: 100%;
        }

        @media only screen and (min-width: 600px) {
        /* For tablets: */
        .col-sm-1 {width: 8.33%;}
        .col-sm-2 {width: 16.66%;}
        .col-sm-3 {width: 25%;}
        .col-sm-4 {width: 33.33%;}
        .col-sm-5 {width: 41.66%;}
        .col-sm-6 {width: 50%;}
        .col-sm-7 {width: 58.33%;}
        .col-sm-8 {width: 66.66%;}
        .col-sm-9 {width: 75%;}
        .col-sm-10 {width: 83.33%;}
        .col-sm-11 {width: 91.66%;}
        .col-sm-12 {width: 100%;}
        }

    </style>
</head>
<body>
    <div class="container-covid container-fluid">
        <!-- cases in country -->
        <div class="row">
            <div class="col-12">
                <div class="row headerCard" >
                    <div class="col-sm-12 headerWrap">
                        <div class="imgWrap">
                            <img src="img/003-virus.png" alt="">
                        </div>
                        - Covid 19 cases in <span id="currentCountry"><?php echo $worldApi->countryInfo->infoCountry ?> </span> -
                    </div>
                </div>
                <div class="row cardMainRow" >
                    <div class="col-sm-12">
                        <div class="row cardRow">
                            <div class="col-sm-0 col-md-0 col-lg-0 col-xl-1">
                                
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Total Cases
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/026-report.png" alt="026-repot.png">
                                                </div>
                                                <div id="countryTotalCase">
                                                    <?php echo $worldApi->countryInfo->infoTotalCase?>
                                                </div>
                                                <div id="countryNewCase" class="newRecord">
                                                    <?php echo $worldApi->countryInfo->infoNewCase?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Total Recovered
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/004-father.png" alt="004-father.png">
                                                </div>
                                                <div id="countryTotalRecovered">
                                                    <?php echo $worldApi->countryInfo->infoTotalRecovered?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Total Death
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/002-coffin.png" alt="002-coffin.png">
                                                </div>
                                                <div id="countryTotalDeath">
                                                    <?php echo $worldApi->countryInfo->infoTotalDeath ?>
                                                </div>
                                                <div id="countryNewDeath" class="newRecord">
                                                    <?php echo $worldApi->countryInfo->infoNewDeath?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Active Cases
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/004-man.png" alt="004-man.png">
                                                </div>
                                                <div id="countryActiveCase">
                                                    <?php echo $worldApi->countryInfo->infoActiveCase ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Total Tests 
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/019-test tube.png" alt="019-test tube.png">
                                                </div>
                                                <div id="countryTotalTest">
                                                    <?php echo $worldApi->countryInfo->infoTotalTest?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /cases in country -->
        <!-- Country Search -->
        <div class="row">
        	<div class="col-12">
        		<form action="#" method="GET">
					<div class="row searchRow">
						<div class="col-2">
						</div>
						<div class="col-8 searchContainer">
							<div class="row">
								<div class="col-0 col-sm-0 col-md-1 col-lg-2">
									
								</div>
								<div class="col-12 col-sm-12 col-md-10 col-lg-8">
									<select name="country" id="country">
										<?php
										foreach($worldApi->countryList as $countryvalue) {
											?>
											<option value="<?php echo str_replace(' ', '', $countryvalue); ?>"  <?php if($searchCountry == str_replace(' ', '', $countryvalue)){ echo "selected"; } ?> ><?php echo $countryvalue; ?></option>
										<?php
										}
										?>

                                    </select>
                                    <input type="hidden" id="mainCountry" value="<?php echo $worldApi->countryInfo->infoCountry ?>">
								</div>
							</div>
						</div>
					</div>
				</form>
        	</div>
        </div>
        <!-- /Country search -->
        <!-- open Services -->
        <div class="row" id="openServices" style="display:none">
            <div class="col-12">
                <div class="row headerCard" style="background-color: #00cb80; height: 280px;" >
                    <div class="col-sm-12 headerWrap">
                        <div class="searchContainer">
                            <select name="daySelect" id="daySelect" style="max-width: 200px;">
                                <?php
                                foreach($dayList as $day) {
                                    ?>
                                    <option value="<?php echo $day; ?>"  <?php if($day == date('l')){ echo "selected"; } ?> ><?php echo $day; ?></option>
                                <?php
                                }
                                ?>

                            </select>
						</div>
                        <div class="imgWrapBig">
                            <img src="img/open.png" alt="open.png">
                        </div>
                    </div>
                </div>
                <div class="row cardMainRow" >
                    <div class="col-sm-12">
                        <div class="row cardRow" id="serviceListRow">
                          
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /open Services -->
        <!-- cases in world -->
        <div class="row">
            <div class="col-12">
                <div class="row headerCard" style="background-color: #0099cb;" >
                    <div class="col-sm-12 headerWrap">
                        <div class="imgWrap">
                            <img src="img/001-petri dish.png" alt="001-petri dish.png">
                        </div>
                        - Covid 19 cases in World -
                    </div>
                </div>
                <div class="row cardMainRow" >
                    <div class="col-sm-12">
                        <div class="row cardRow">
                            <div class="col-sm-0 col-md-0 col-lg-0 col-xl-2">
                                
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Total Cases
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/026-report.png" alt="026-repot.png">
                                                </div>
                                                <div id="worldTotalCase">
                                                    <?php echo $worldApi->worldInfo->infoTotalCase?>
                                                </div>
                                                <div id="worldNewCase" class="newRecord">
                                                    <?php echo $worldApi->worldInfo->infoNewCase?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Total Recovered
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/004-father.png" alt="004-father.png">
                                                </div>
                                                <div id="worldTotalRecovered">
                                                    <?php echo $worldApi->worldInfo->infoTotalRecovered?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Total Death
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/002-coffin.png" alt="002-coffin.png">
                                                </div>
                                                <div id="worldTotalDeath">
                                                    <?php echo $worldApi->worldInfo->infoTotalDeath ?>
                                                </div>
                                                <div id="worldNewDeath" class="newRecord">
                                                    <?php echo $worldApi->worldInfo->infoNewDeath?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-2">
                                        
                                    </div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard">
                                        <div class="row header">
                                            <div class="col-12" >
                                                Active Cases
                                            </div>
                                        </div>
                                        <div class="row numberLabel">
                                            <div class="col-12">
                                                <div class="imgWrap">
                                                    <img src="img/004-man.png" alt="004-man.png">
                                                </div>
                                                <div id="worldActiveCase">
                                                    <?php echo $worldApi->worldInfo->infoActiveCase ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /cases in world -->
        <div class="row" style="background-color: #f7f7f7;padding: 14px 5px;">
            <div class="col-sm-12" style="text-align:center">
                Source : <a href="https://www.worldometers.info/coronavirus/">https://www.worldometers.info/coronavirus/</a> 
            </div>
        </div>
        <div class="row">
			<div class="col-2">
			</div>
		    <div class="col-8">
                <!-- kukhurikan -->
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
					style="display:inline-block;width:728px;height:90px"
					data-ad-client="ca-pub-2649956165965557"
					data-ad-slot="2860988249"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
        </div>
        <div class="row">
			<div class="col-1 col-xl-2">
			</div>
		    <div class="col-10 col-xl-8" style="text-align:center;font-weight:bold;">
                   COVID 19 OUTBREAK MAP BY: “Johns Hopkins University”
			</div>
        </div>
        <div class="row">
			<div class="col-1 col-xl-2">
			</div>
		    <div class="col-10 col-xl-8">
				<iframe width="100%" height="600px" frameborder="0" scrolling="no" 
                    marginheight="0" marginwidth="0" title="2019-nCoV" 
                    src="//arcgis.com/apps/Embed/index.html?webmap=14aa9e5660cf42b5b4b546dec6ceec7c&extent=77.3846,11.535,163.5174,52.8632&zoom=true&previewImage=false&scale=true&disable_scroll=true&theme=light"
                    style="border-radius: 30px;    border: 10px solid #ababab;    margin-bottom: 30px;"></iframe>
			</div>
        </div>
        <div class="row" id="newsSection">
            <div class="col-12">
                <div class="row headerCard" style="background-color: #0099cb; height: 160px;padding-top: 70px;" >
                    <div class="col-1 col-xl-2">

                    </div>
                    <div class="col-10 col-xl-8 newsHeaderWrap">
                        - Covid 19 News (Nepal) -
                    </div>
                </div>
                <div class="row newsRow">
                    <div class="col-1 col-xl-2">

                    </div>
                    <div class="col-10 col-xl-8 newsContainer">
                        <div class="row">
                            <?php
                                $sql = "SELECT DISTINCT newssource FROM news ORDER BY newsid DESC";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        
                            ?>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 newsColumn">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="newsWrap">
                                            <div class="newsHeader">
                                                <?php echo $row["newssource"]?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                    $newssource = $row["newssource"];
                                    $newssql = "SELECT * FROM news WHERE news.newssource = '$newssource'  ORDER BY newsid DESC, newsdate DESC LIMIT 8";
                                    $newsresult = $conn->query($newssql);
                                    
                                    if ($newsresult->num_rows > 0) {
                                        // output data of each row
                                        while($newsrow = $newsresult->fetch_assoc()) {
                                            ?>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="newsWrap">
                                            <div class="bulletNews">
                                                <div class="bulletClass">
                                                
                                                </div>
                                            </div>
                                            <div class="newsHeadline">
                                                <a href="<?php echo $newsrow["newslink"]  ?>" target="_blank"> <?php echo $newsrow["newstitle"]  ?> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                        }
                                    }
                                ?>
                            </div>

                            <?php 
                                    }
                                } else {
                                ?>
                                    <div class="col-sm-12 newsColumn">
                                        <div class="newsWrap">
                                            <div class="newsHeadline">
                                                No News
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                                $conn->close();
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row footer">
            <div class="col-12">
                <audio id="myAlarm">
                    <source src="alarm.wav" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <div class="row">
                    <div class="col-sm-12" style="text-align:center">
                        Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="text-align:center">
                        Developed by <a href="http://www.ashonshakya.com.np" title="Ashon Shakya"> Ashon Shakya</a> and <a href="https://www.facebook.com/janamrajkaji" title="Janam Maharjan"> Janam Maharjan</a>
                    </div>
                </div>
            </div>
            </div>

    </div>


</body>

<script>

    var updateRecord;
    var x = document.getElementById("myAlarm"); 
    const dayList = ["Sunday", "Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

    function playAlarm() { 
        x.play(); 
    } 

    function pauseAlarm() { 
        x.pause(); 
    } 

    function setCookie(cname,cvalue,exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    $(document).ready(function () {
        updateRecord = setTimeout(function(){update_number();}, 20000);
        var d = new Date();
        console.log(d.getDay());
        update_service(dayList[d.getDay()]);
    });


    $('#country').change(function(){
        $("#mainCountry").val($( "#country option:selected" ).text());
        $("#currentCountry").html($( "#country option:selected" ).text());
        clearTimeout(updateRecord);
        update_number();
    });

    $('#daySelect').change(function(){
        var daySelect = $("#daySelect option:selected").text();
        update_service(daySelect);
    });

    function update_number(){
        var searchCountry = $("#mainCountry").val();

        if(searchCountry == "Nepal" )
        {
            $('#openServices').css('display','none');
        }
        else
        {
            $('#openServices').css('display','none');
        }

        $.ajax({
            type: "GET",
            dataType: 'JSON',
            crossDomain: true,
            crossOrigin: true,
            url: "getWorldInfoApi.php?country=" + searchCountry,
            success: function (response) { 

                var prevNumber = getCookie("Country" + $("#mainCountry").val());

                update_record('#countryTotalCase',$('#countryTotalCase').html(),response.countryInfo.infoTotalCase);
                update_record('#countryNewCase',$('#countryNewCase').html(),response.countryInfo.infoNewCase);
                update_record('#countryTotalTest',$('#countryTotalTest').html(),response.countryInfo.infoTotalTest);
                update_record('#countryActiveCase',$('#countryActiveCase').html(),response.countryInfo.infoActiveCase);
                update_record('#countryTotalDeath',$('#countryTotalDeath').html(),response.countryInfo.infoTotalDeath);
                update_record('#countryNewDeath',$('#countryNewDeath').html(),response.countryInfo.infoNewDeath);
                update_record('#countryTotalRecovered',$('#countryTotalRecovered').html(),response.countryInfo.infoTotalRecovered);
                
                update_record('#worldTotalCase',$('#worldTotalCase').html(),response.worldInfo.infoTotalCase);
                update_record('#worldActiveCase',$('#worldActiveCase').html(),response.worldInfo.infoActiveCase);
                update_record('#worldNewCase',$('#worldNewCase').html(),response.worldInfo.infoNewCase);
                update_record('#worldTotalDeath',$('#worldTotalDeath').html(),response.worldInfo.infoTotalDeath);
                update_record('#worldNewDeath',$('#worldNewDeath').html(),response.worldInfo.infoNewDeath);
                update_record('#worldTotalRecovered',$('#worldTotalRecovered').html(),response.worldInfo.infoTotalRecovered);

                updateRecord = setTimeout(function(){update_number();}, 20000);
            }
        });
      
    }

    function update_service(service)
    {
        
        // $.ajax({
        //     type: "GET",
        //     dataType: 'JSON',
        //     crossDomain: true,
        //     crossOrigin: true,
        //     url: "getOpenService.php?day=" + service,
        //     success: function (response) { 
        //         $('#serviceListRow').html('');
        //         for(var i = 0 ; i < response.length; i++)
        //         {   var divBody = '';

        //              divBody = divBody + '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-2 numberWrap"><div class="row"><div class="col-1 col-sm-1 col-md-1 col-lg-2"></div><div class="col-10 col-sm-10 col-md-10 col-lg-8 numberCard"><div class="row serviceHeader"><div class="col-12" >' + response[i]["name"] +'</div></div><div class="row numberLabel"><div class="col-12"><div class="imgWrapBig"><img src="img/service/' + response[i]["icon"] + '" alt="' + response[i]["name"] +'"></div></div></div>';
                    
        //             if (response[i]["time"] != undefined)
        //             {
        //                 var checkOpen = false;
        //                 for(var j = 0; j< response[i]["time"].length;j++)
        //                 {
        //                     if (response[i]["time"][j] == "00:00-23:59")
        //                     {
        //                         checkOpen = true;
        //                     }
        //                     else
        //                     {

        //                         var openTime = response[i]["time"][j].split('-')[0];
        //                         var closeTime = response[i]["time"][j].split('-')[1];

        //                         var firstDate = new Date("January 01, 2000 " + openTime);
        //                         var secondDate = new Date("January 01, 2000 " + closeTime);

        //                         var today = new Date();
        //                         var time = today.getHours() + ":" + today.getMinutes();

        //                         var currentTime = new Date("January 01, 2000 " + time);

        //                         if(currentTime >= firstDate && currentTime <= secondDate)
        //                         {
        //                             checkOpen = true;
        //                         }

        //                     }
        //                 }

        //                 if(checkOpen)
        //                 {
        //                     divBody = divBody + '<div class="row serviceFooter serviceFooterOpen"><div class="col-12" >';
        //                 }
        //                 else
        //                 {
        //                     divBody = divBody + '<div class="row serviceFooter"><div class="col-12" >';
        //                 }

        //                 for(var j = 0; j< response[i]["time"].length;j++)
        //                 {
        //                     if (response[i]["time"][j] == "00:00-23:59")
        //                     {
        //                         divBody = divBody +"Full Day" + '<br/>';
        //                     }
        //                     else
        //                     {
        //                         divBody = divBody + response[i]["time"][j] + '<br/>';
        //                     }
        //                 }
        //                 divBody = divBody + '</div></div>';
        //             }

        //             divBody = divBody + '</div></div></div>';
                   
                    
        //             $('#serviceListRow').append(divBody);
        //         }
        //     }

        // });
    }

    function update_record(x,y,z){
        var targetDiv = x;
        var oldValue = Number(y.replace(/,/g, ''));
        var newValue = Number(z.replace(/,/g, ''));
        
        if(isNaN(oldValue))
        {
            oldValue = 0;
        }

        if(isNaN(newValue))
        {
            newValue = 0;
        }

        direct_update(x,z);

        // if(z=="N/A" || (isNaN(Number(z.replace(/,/g, ''))) && z!=""))
        // {
        //     direct_update(x,z);
        // }
        // else
        // {
        //     var increment = newValue - oldValue;

        //     if (Math.abs(increment) > 1000) {
        //         oldValue = increment < 0 ? newValue + 1000: newValue - 1000;
        //         increment = increment < 0 ? -1000 : 1000;
        //     }

        //     var incr = increment < 0 ? -1:1;
        //     var updateValue = oldValue;

        //     for(var i = 0; i < Math.abs(increment); i++)
        //     {   
        //         updateValue = updateValue + incr;
        //     }
        // }
    }

    function direct_update(x,z){
        $(x).html(z);
    }

</script>
</html>