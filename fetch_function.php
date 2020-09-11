<?php 
function fetchFromSetoPati($source,$main_url,$date,$keyword) {
    //update setopati
    $url = $main_url."/search?from=".$date["fromYear"]."%2F".$date["fromMonth"]."%2F".$date["fromDay"]."&to=".$date["year"]."%2F".$date["month"]."%2F".$date["day"]."&search_text=";

    $str = file_get_contents($url);
    
    $itemArray = [];
    $uploadArray = [];

    $doc = new DOMDocument; 
    @$doc->loadHTML('<?xml encoding="utf-8" ?>'.$str); 

    $finder = new DomXPath($doc);
    $classname="search-res-list";
    $itemBody = $finder->query("//*[contains(@class, '$classname')]");

    $nodes = $itemBody->item(0);
    if($nodes != null)
    {
        $itemCollection = $nodes->getElementsByTagName("div");
        for($i = 0; $i < $itemCollection->length ; $i++  )
        {
            $items = $itemCollection->item($i);
            $title = $items->getElementsByTagName("a")->item(0)->getAttribute("title");
            $link  = $items->getElementsByTagName("a")->item(0)->getAttribute("href");
            
            for($j = 0; $j < count($keyword); $j++)
            {
                if(strpos($title, $keyword[$j])!== false)
                {
                    $itemArray = ["newstitle"  => $title,
                                  "newslink"   => $link,
                                  "newssource" => $source];
                    array_push($uploadArray, $itemArray);
                    $j = count($keyword);
                }
            }
    
        }
    }

    return $uploadArray;
}

function fetchFromOnlineKhabar($source,$main_url,$date,$keyword) {
    //update onlineKhabar
    $url = $main_url."/content/news";

    $str = file_get_contents($url);
    
    $itemArray = [];
    $uploadArray = [];

    $doc = new DOMDocument; 
    @$doc->loadHTML('<?xml encoding="utf-8" ?>'.$str); 

    $finder = new DomXPath($doc);
    $classname="item__wrap";
    $itemCollection = $finder->query("//*[contains(@class, '$classname')]");

    if ($itemCollection != null)
    {
        for($i = 0; $i < $itemCollection->length ; $i++  )
        {   
            $items = $itemCollection->item($i)->getElementsByTagName("a")->item(0);
            $title = $items->nodeValue;
            $link  = $items->getAttribute("href");
    
            for($j = 0; $j < count($keyword); $j++)
            {
                if(strpos($title, $keyword[$j])!== false)
                {
                    $itemArray = ["newstitle"    => $title,
                                    "newslink"   => $link,
                                    "newssource" => $source];
                    array_push($uploadArray, $itemArray);
                    $j = count($keyword);
                }
            }
        }
    }

    return $uploadArray;
}

function fetchFromRatoPati($source,$main_url,$date,$keyword) {
    //update onlineKhabar
    $url = $main_url."/tag/%E0%A4%95%E0%A5%8B%E0%A4%B0%E0%A5%8B%E0%A4%A8%E0%A4%BE%E0%A4%AD%E0%A4%BE%E0%A4%87%E0%A4%B0%E0%A4%B8";
    
    $str = file_get_contents($url);

    $itemArray = [];
    $uploadArray = [];

    $doc = new DOMDocument; 
    @$doc->loadHTML('<?xml encoding="utf-8" ?>'.$str); 

    $finder = new DomXPath($doc);
    $classname="ot-articles-material-blog-list";
    $itemBody = $finder->query("//*[contains(@class, '$classname')]");
    $nodes = $itemBody->item(0);

    if ($nodes != null)
    {
        $itemCollection = $nodes->getElementsByTagName("div");
    
        for($i = 0; $i < $itemCollection->length ; $i++  )
        {   
            $items = $itemCollection->item($i)->getElementsByTagName("a")->item(0);
            $title = $items->nodeValue;
            $link  = $main_url.$items->getAttribute("href");
            $class = $items->getAttribute("class");
    
            if ($class != "item-header-image")
            {
                for($j = 0; $j < count($keyword); $j++)
                {
                    if(strpos($title, $keyword[$j])!== false)
                    {
                        $itemArray = ["newstitle"    => $title,
                                        "newslink"   => $link,
                                        "newssource" => $source];
                        array_push($uploadArray, $itemArray);
                        $j = count($keyword);
                    }
                }
            }
        }
    }

    return $uploadArray;
}

function fetchFromEkantipur($source,$main_url,$date,$keyword) {
    //update ekantipur
    $url = $main_url."/tag/id-1425";
    $str = file_get_contents($url);

    $itemArray = [];
    $uploadArray = [];

    $doc = new DOMDocument; 
    @$doc->loadHTML('<?xml encoding="utf-8" ?>'.$str); 

    $finder = new DomXPath($doc);
    $classname="tagList";
    $itemBody = $finder->query("//*[contains(@class, '$classname')]");
    $nodes = $itemBody->item(0);
    if($nodes != null)
    {
        $itemCollection = $nodes->getElementsByTagName("article");
    
        for($i = 0; $i < $itemCollection->length ; $i++  )
        {   
            $items = $itemCollection->item($i)->getElementsByTagName("a")->item(0);
            $title = $items->nodeValue;
            $link  = $items->getAttribute("href");
            $link = $main_url.$link;
                $itemArray = ["newstitle"    => $title,
                                "newslink"   => $link,
                                "newssource" => $source];
                array_push($uploadArray, $itemArray);
        }
    }

    return $uploadArray;
}

function fetchFromHimalayanTimes($source,$main_url,$date,$keyword) {
    //update himalayantimes
    $url = $main_url."/?s=covid-19";
    $str = file_get_contents($url);

    $itemArray = [];
    $uploadArray = [];

    $doc = new DOMDocument; 
    @$doc->loadHTML('<?xml encoding="utf-8" ?>'.$str); 

    $finder = new DomXPath($doc);
    $classname="mainNews";
    $itemBody = $finder->query("//*[contains(@class, '$classname')]");
    $nodes = $itemBody->item(0);
    if ($nodes != null)
    {
        $itemCollection = $nodes->getElementsByTagName("li");
    
        for($i = 0; $i < $itemCollection->length ; $i++  )
        {   
            $items = $itemCollection->item($i)->getElementsByTagName("a")->item(0);
            $title = $items->getAttribute("title");
            $link  = $items->getAttribute("href");
    
                $itemArray = ["newstitle"    => $title,
                                "newslink"   => $link,
                                "newssource" => $source];
                array_push($uploadArray, $itemArray);
          
        }
    }

    return $uploadArray;
}

function fetchFromAnnapurnaPost($source,$main_url,$date,$keyword) {
    //update Annapurna
    $url = "http://bg.annapurnapost.com/api/search?title=%E0%A4%95%E0%A5%8B%E0%A4%B0%E0%A5%8B%E0%A4%A8%E0%A4%BE";
    $str = file_get_contents($url);

    $itemArray = [];
    $uploadArray = [];

    $jsonObject = json_decode($str);

    $data = $jsonObject->data;

    $itemCollection = $data->items;

    for($i = 0; $i < count((array)$itemCollection) ; $i++  )
    {   
        $title = $itemCollection[$i]->title;
        $link  = "/news/".$itemCollection[$i]->slug."-".$itemCollection[$i]->id;

        $link = $main_url.$link;

        $itemArray = ["newstitle"    => $title,
                        "newslink"   => $link,
                        "newssource" => $source];
        array_push($uploadArray, $itemArray);
    }

    return $uploadArray;
}


?>