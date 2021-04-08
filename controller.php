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


    //Retrieving data of RFI radio feed
    function get_data(){
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
        return simplexml_load_file($url);
    }

    //Geting Bing dialy wallpaper
    function get_wallpaper(){
        return "https://bing.com".@json_decode(@file_get_contents("https://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=fr-FR"),true)["images"][0]['url'];
    }
    
    //Theme manager

    function Is_daytime(){
        $content=@json_decode(@file_get_contents("http://extreme-ip-lookup.com/json/"));

        $now=time();

        /* $longitude = 52.27026;
        $latitude  = -1.89188; */
        $longitude =  $content->lon;
        $latitude  =  $content->lat;
        
        $sun    = date_sun_info ( $now, $longitude, $latitude);
        $light  = $sun['civil_twilight_begin'];
        $dark   = $sun['civil_twilight_end'];
        
        if (($now > $light && $now < $dark)) {
            //It's daytime
            return true;
        }else{
            //It's daytime
            return false;
        }
    }

    //To print the content in XML vanilla
    /* header('Content-type: application/xml');*/

?>