<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Yahari Analysis Test</title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".show").click(function (){
                    $(this).next().slideToggle(); 
                });
            });
             
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
        <?php
            function nextLine($file){
                $file->next();
                return $file->current();
            }
            $src = "";
            $img = "";
            $off = 17;
            $file = new SplFileObject('part1-3.txt');            
            $ctr = 0;
            $end = 388;
            $line = $file->current();
            
            while (!$file->eof()) {
               if((strstr($line, "http")) == false && (strstr($line, "----")) == false){
                    echo $line ."<br>";
               }elseif((strstr($line, "http")) != false){
                  if((strstr($line, "imgur") != false)){
                    if((strstr($line, "https")) != false){
                        $off = (strstr($line, "/a/") != false)?20:18;
                        $img = trim(substr($line,18));
                        $src = trim(substr($line,$off)); 
                    }else{  
                        $off = (strstr($line, "/a/") != false)?19:17;
                        $img = trim(substr($line,17));
                        $src = trim(substr($line,$off));
                    }
                    echo "<div class=\"picCont container-fluid\"><blockquote class=\"imgur-embed-pub\" lang=\"en\""
                    . " data-id=\"".$img."\"><a href=\"//imgur.com/".$src."\""
                    . "></a></blockquote><script async src=\"//s.imgur.com/min/embed.js\" "
                    . "charset=\"utf-8\"></script><br></div>";
                  }else if(strstr($line, "youtube") != false){
                    $src = substr($line,32);
                    echo "<div class=\"picCont container-fluid\">"
                    . "<iframe src=\"http://www.youtube.com/embed/".$src."\" width=\"560\" height=\"315\""
                    . " frameborder=\"0\" allowfullscreen></iframe><br></div>";
                }else{
                      echo "<a href=\"".$line."\">".$line."</a><br>";
                  } 
               }else{
                   $line = nextLine($file);
                   echo "<button class=\"show button\">LN Excerpt</button>";
                   echo "<span class=lnText><br>";
                   while((strstr($line, "----")) == false){
                    echo $line ."<br>";
                    $line = nextLine($file);
                   }
                   echo "</span>";
                   echo "<br>";
               }
                $line = nextLine($file);
            }

                        
        ?>
                  </div>
                <div class="col-md-12 text-center">
                    <ul class="pagination">
                      <li><a href="index.php">1</a></li>
                      <li><a href="page2.php">2</a></li>
                      <li   class="active" ><a href="page3.php">3</a></li>
                    </ul>
                </div>
            </div>
        </div>
        

    </body>


</html>
