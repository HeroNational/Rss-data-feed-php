<?php 
    //Check internet connexion 
    function is_connected()
    {
        $connected = @fsockopen("www.example.com", 80); 
                                            //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    
    }

    if(!is_connected()) die("connexion failed");

    //Retrieving data of RFI radio feed
    if(isset($_GET["lang"])){
        if($_GET["lang"]=="fr"){
            $url="https://www.rfi.fr/fr/rss";
        }else{
            $url="https://www.rfi.fr/en/rss";
        }
    }else{
        $url="https://www.rfi.fr/fr/rss";
    }
    //$url="file.xml";
    $content=file_get_contents($url);
    $xml=simplexml_load_file($url);

    //Geting Bing dialy wallpaper
    $wallpaper="https://bing.com".@json_decode(@file_get_contents("https://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=fr-FR"),true)["images"][0]['url'];
    
    //To print the content in XML vanilla
    /* header('Content-type: application/xml');*/

?>