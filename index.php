<?php 
  include("./controller.php");
  if(!is_connected()) die("connexion failed");  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Daniel Fokou, Hero National, Hamed Norach, Megali Freshner and Tarkovski Woo">
    <meta name="generator" content="Jekyll v4.1.1">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/52329673?v=4" type="image/x-icon">
    <title>News Feed</title>

    <link rel="stylesheet" href="./assets/font/style.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
    <?php
      
      if (Is_daytime()) {
        
      ?>
        <link href="./assets/dist/css/bootstrap.📕.css" rel="stylesheet">
      <?php
      
      } else {
        
        $value="It's nighttime";
      ?>
        <link href="./assets/dist/css/bootstrap.📗.css" rel="stylesheet">
      <?php 
      }
    ?>

    <!-- Bootstrap core CSS -->

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      .print-title{
        display:none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>
  <body>
    
    <main role="main">
      <style>
        #bing-bg{
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center;
          background-origin: border-box;
          background: linear-gradient(
            to bottom,
            rgba(0,0,0, 0),
            rgba(0,0,0, 100)
          ),url("<?php echo get_wallpaper(); ?>"), linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4));
      </style>
      <section class="jumbotron text-center mt-0" id="bing-bg">
        <div class="container" id="cta">
          <h1 style="color:red;">RFI News</h1>
          <p class="lead text">Newspaper from the data stream of Radio France Internationale (RFI), the popular radio station.
            <br/> Made with love <span class="heart">❤</span> by <a href='https://github.com/heronational' target="_blank"> Daniel Uokof </a></p>
          <p>
            <p class="print-title">Journal du <?php echo date("j/m/o");?> </p>
            <div class="btn btn-group">
              <a href="https://github.com/heronational/Rss-data-feed-php" class="btn btn-info my-2"><span class="lnr lnr-laptop"></span>&nbsp;&nbsp;&nbsp;&nbsp;Suivre le projet</a>
              <a href="<?php 
              if(isset($_GET["lang"])){
                if($_GET["lang"]=="fr"){
                  echo "https://www.rfi.fr/fr/rss";
                }else{
                  echo "https://www.rfi.fr/en/rss";
                }
              } ?>" class="btn btn-warning my-2"><span class="lnr lnr-cloud"></span>&nbsp;&nbsp;&nbsp;&nbsp;Voir à la source</a>
              <a href="javascript:window.print()" class="btn btn-secondary my-2"><span class="lnr lnr-printer"></span>&nbsp;&nbsp;&nbsp;&nbsp;Imprimer</a>
            </div>
            <br>
            <style>
              a:hover{
                text-decoration: none;
              }
            </style>
            <?php 
              if(isset($_GET["lang"])){
                if($_GET["lang"]=="fr"){
                  ?>
                    <a href="?lang=en" class=" border-4 border-bottom py-2 border-warning text-success lang">Journal in English</a>
                  <?php
                }else{
                  ?>
                    <a href="?lang=fr" class="text-success lang border-4 border-bottom py-2 border-danger" >Journal en Français</a> 
                  <?php
                }
              }else{
                ?>
                    <a href="?lang=en" class=" border-4 border-bottom py-2 border-warning text-success lang">Journal in English</a>
                <?php
              }
            ?>
          </p>
          <br>
          <style>
            @keyframes down {
              0%{
                top:3px;
              }
              20%{
                border-color: aquamarine;
              }
              30%{
                border-color: rgb(250, 101, 15);
              }
              40%{
                border-color: rgb(89, 250, 15);
              }
              50%{
                border-color: rgb(250, 215, 15);
              }
              100%{
                border-color: rgb(255, 146, 146);
                top:-3px;
              }
            }
            .down{
              transition: 400ms cubic-bezier(0.075, 0.82, 0.165, 1);
              border:1px solid white;
              border-radius:100%;
              position: relative;
              padding:20px;
              font-weight: bold;
              animation: down 400ms linear infinite;
              font-size: 30px;
            }
            .down:hover{
              cursor: pointer;
              animation-play-state: paused;
              background: rgba(253, 255, 143, 0.2);
              transition: 400ms cubic-bezier(0.075, 0.82, 0.165, 1);
              color:darkorange;
            }
          </style>
          <span class="lnr lnr-chevron-down down"></span>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <?php 
                $xml=get_data();
                foreach($xml->channel->item as $item){
            ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <?php if($item->source["url"]!='unknown'){?>
                    <img class="bd-placeholder-img card-img-top" src="<?php echo($item->source["url"]); ?>" alt="<?php echo($item->title); ?>">
                <?php } ?>
                <div class="card-body">
                  <h5 class="card-title"><?php echo($item->category); ?></h5>
                  <p class="card-text"><?php echo($item->description); ?></p>
                  <small class="text-muted">Date: <?php echo($item->pubDate);?></small>
                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="<?php echo($item->link); ?>"  class="btn container-fluid btn-sm btn-outline-success">Voir plus<a/>
                    <!-- 
                      <div class="btn-group">
                        <a href="<?php /*echo($item->link);*/ ?>"  class="btn btn-fluid btn-sm btn-outline-secondary">Voir plus<a/>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                    -->
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>

    </main>

    <style>
      .heart {
        animation: beat 1s linear infinite;
        width: 30px;
        max-width: 30px;
        min-width: 30px;
      }
    
    @keyframes beat {
        0% {
          font-size: 20px;
        }
        50% {
          font-size: 18px;
        }
      }
      .back-to-top{
        visibility: hidden;
        position: fixed;
        bottom: 50px;
        right: 5px;
        background-color: rgba(255, 0, 0, 0.233);
        padding:15px;
        border-radius: 10%;
        font-weight: bold;
        transition: 700ms cubic-bezier(0.075, 0.82, 0.165, 1);
        color:rgb(245, 209, 166);
        font-size: 20px;
      }
      .back-to-top:hover{
        transition: 700ms cubic-bezier(0.075, 0.82, 0.165, 1);
        box-shadow: 0px 0px 10px 5px rgba(245, 245, 245, 0.548);
        background-color: rgba(255, 0, 0, 0.589);
      }
    </style>
    <span class="lnr lnr-chevron-up back-to-top" href="#"></span>

    <footer class="fixed-bottom: bg-dark text-center text-muted">
      <div class="container">
        <p class='pt-2'>Made with love <span class="hearts">❤</span> by  <a href="https://github.com/heronational/">Daniel Uokof.</a> Contact me on <a href="https://t.me/heronational">Telegram</a></p>
      </div>
    </footer>
    <style>
      @media print {
        .btn,.lead,.back-to-top,.lang, .down{
          display: none;
        }
        
        .print-title{
          display:block;
          color:teal;
        }
      }
    </style>
  </body>
  <script src="./assets/dist/js/jquery.js"></script>
  <script>
    $("#bing-bg").css(
      {
        height:screen.height
      }
    );
    $("#cta").offset(
      {
        top:(screen.height-$("#cta").height())/2,
      }
    )
    $(".back-to-top").click((e)=>{
      e.preventDefault();
      var body = $("html, body");
      body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
        
      });
    })
    $(".down").click((e)=>{
      e.preventDefault();
      var body = $("html, body");
      body.stop().animate({scrollTop:screen.height+2+"px"}, 500, 'swing', function() { 
        
      });
    })

    window.addEventListener("scroll", (event) => {
      if(this.scrollY > screen.height+(screen.height*0.1)){
        $(".back-to-top").css({
          visibility: "visible"
        }).animate(fadeIn,100)
      }else{
        $(".back-to-top").css({
          visibility: "hidden"
        }).animate(fadeOut,1000)
      }
  });
  </script>
</html>
