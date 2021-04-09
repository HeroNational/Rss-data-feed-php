<?php 
  include("./controller.php");
  if(!is_connected()) die("Internet connexion failed. For elements to be loaded, you need to have an internet connexion.");  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Daniel Fokou, Hero National, Hamed Norach, Megali Freshner and Tarkovski Woo">
    <meta name="generator" content="Jekyll v4.1.1">
    <link rel="shortcut icon" href="https/://avatars.githubusercontent.com/u/52329673?v=4" type="image/x-icon">
    <title>News Feed</title>

    <link rel="stylesheet" href="./assets/font/style.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
    <!-- Bootstrap core CSS -->
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

    <link href="./assets/dist/css/fakescroll.css" rel="stylesheet">

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
          ),url("<?php  echo get_wallpaper(); ?>"), linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4));
      </style>
      <section class="jumbotron text-center mt-0" id="bing-bg">
        <div class="container" id="cta">
          <h1 style="color:red;">RFI News</h1>
          <p class="lead text-white">Newspaper from the data stream of Radio France Internationale (RFI), the popular radio station.
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
          <span class="lnr lnr-chevron-down down text-white"></span>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <?php 
                $xml=get_data();
                foreach($xml->channel->item as $item){
            ?>
            <div class="col-sm-12 col-md-4">
              <div class="card mb-4 shadow">
                <?php if($item->source["url"]!='unknown'){?>
                    <img class="bd-placeholder-img card-img-top" src="<?php echo($item->source["url"]); ?>" alt="<?php echo($item->title); ?>">
                <?php } ?>
                <div class="card-body">
                  <h5 class="card-title"><?php echo($item->category); ?></h5>
                  
                  <div class="card border-1 text-success  shadow  m-2 p-2">
                    <?php echo($item->title); ?>
                  </div>
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
        bottom: 65px;
        right: 5px;
        background-color: rgba(255, 0, 0, 0.233);
        padding:15px;
        border-radius: 10%;
        font-weight: bold;
        transition: 700ms linear;
        color:rgb(245, 209, 166);
        font-size: 20px;
      }
      .back-to-top:hover{
        transition: 700ms linear;
        background-color: rgba(255, 0, 0, 0.589);
      }
    </style>
    <span class="lnr lnr-chevron-up back-to-top shadow" href="#"></span>
      
    <footer class="position-relative shadow footer mt-auto py-1 bg-dark text-center text-warning">
        <p class='mt-3'>Made with love <span class="hearts">❤</span> by  <a target="_blank" href="https://github.com/heronational/">Daniel Uokof.</a> Contact me on <a href="https://t.me/heronational">Telegram</a></p>
    </footer>
    <div
      id="scrollshow"
      style="
        background: rgb(34, 195, 107);
        background: radial-gradient(
          circle,
          rgba(34, 195, 107, 1) 0%,
          rgba(34, 193, 195, 1) 40%,
          rgba(117, 183, 191, 1) 52%,
          rgba(253, 187, 45, 1) 100%
        );
        position: fixed;
        left: 0px;
        top: 0px;
        z-index: 2000000;
        height: 6px;
      "
    ></div>

    <style>
      @media print {
        .btn,.lead,.back-to-top,.lang, .down{
          display: none;
        }
        #bing-bg{
          /*height: 40px!important;*/
        }
        .print-title{
          display:block;
          color:teal;
        }
      }
      /* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f5cc8e83; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgba(255, 117, 83, 0.699); 
  transition: 700ms linear;
  border-radius: 19px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  transition: 700ms linear;
  background: rgba(255, 117, 83, 1); 
}
    </style>
  </body>
  <script src="./assets/dist/js/jquery.js"></script>
  <script>

      //Scroll percent
      const percentLabel = document.querySelector("#scrollshow");
      let docT = document.title;
      window.addEventListener("scroll", () => {
        scrollTop = window.scrollY-$(window).height();
        let docHeight = document.body.scrollHeight;
        let winHeight = window.innerHeight+$(window).height();
        let scrollPercent = scrollTop / (docHeight - winHeight);
        scrollPercentRounded = Math.round(scrollPercent * 100);
        if (Math.round(scrollPercent * 100) > 100) {
          scrollPercentRounded = 100;
        } else {
          if (Math.round(scrollPercent * 100) < 0) {
            scrollPercentRounded = 0;
          }
        }
        document.title = docT + " : " + scrollPercentRounded + "% de la lecture";
        //percentLabel.innerHTML = scrollPercentRounded;
        document.getElementById("scrollshow").style.width =
          scrollPercentRounded + "%";
      });

      $(".down").click((e)=>{
        e.preventDefault();
        var body = $("html, body");
        body.stop().animate({scrollTop: $(window).height()+2+"px"}, 500, 'swing', function() { 
          
        });
      })

      function ctaHeight(){
        $("#bing-bg").css(
          {
            height: $(window).height()
          }
        );
        $("#cta").offset(
          {
            top:( $(window).height()-$("#cta").height())/2,
          }
        )
      }
      
      ctaHeight()
      
      $(".back-to-top").click((e)=>{
        e.preventDefault();
        var body = $("html, body");
        body.stop().animate({scrollTop: $(window).height()}, 500, 'swing', function() { 
          
        });
      })

      addEventListener("resize",ctaHeight());
      window.addEventListener("scroll", (event) => {
        if(this.scrollY >  $(window).height()+( $(window).height()*0.1)){
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
