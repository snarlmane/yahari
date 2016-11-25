<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".show").click(function (){
                   $(this).next().toggle(); 
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
        <?php
        
            $src = "";
            $img = "";
            $off = 17;
            $handle = fopen("genuine.txt", "r");
            $file = new SplFileObject('genuine.txt');            
            $ctr = 0;
            $end = 105;
            if ($handle) {
                $file->seek($ctr);
                while (!$file->eof() && $ctr < $end) {
                   $line = $file->current();
                   
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
                        echo "<div class=\"picCont\"><blockquote class=\"imgur-embed-pub\" lang=\"en\""
                        . " data-id=\"".$img."\"><a href=\"//imgur.com/".$src."\""
                        . "></a></blockquote><script async src=\"//s.imgur.com/min/embed.js\" "
                        . "charset=\"utf-8\"></script><br></div>";
                      }else if(strstr($line, "youtube") != false){
                        $src = substr($line,32);
                        echo "<iframe src=\"http://www.youtube.com/embed/".$src."\" width=\"560\" height=\"315\" frameborder=\"0\" allowfullscreen></iframe><br>";
                      }else{
                          echo "<a src=\"".$line."\">".$line."</a>";
                      } 
                   }else{
                       $ctr++;
                       $file->seek($ctr);
                       $line = $file->current();
                       echo "<button class=\"show\">LN Excerpt</button>";
                       echo "<span class=lnText><br>";
                       while((strstr($line, "----")) == false){
                        if((strstr($line, "http")) == false){
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
                        echo "<blockquote class=\"imgur-embed-pub\" lang=\"en\""
                        . " data-id=\"".$img."\"><a href=\"//imgur.com/".$src."\""
                        . "></a></blockquote><script async src=\"//s.imgur.com/min/embed.js\" "
                        . "charset=\"utf-8\"></script><br>";
                         }
                        }
                           $ctr++;
                            $file->seek($ctr);
                           $line = $file->current();
                       }
                       
                       echo "</span>";
                       echo "<br>";
                   }
                    $ctr++;
                    $file->seek($ctr);
                }

                fclose($handle);
                
                        } else {
                // error opening the file.
            }
            echo $ctr
        ?>
        </div>
    </body>


</html>
<!--
<blockquote class="imgur-embed-pub" lang="en" data-id="BeBBHIi">
<a href="//imgur.com/BeBBHIi"></a></blockquote>
<script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>
-->