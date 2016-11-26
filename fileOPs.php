<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function readStart($file){
    
    for($ctr = 0,$file->seek($ctr),$end = $ctr+40;!$file->eof() && $ctr < $end;) {
       $line = $file->current();
       if((strstr($line, "----")) == false){
           printLine($line);
       }else{
           $ctr++;
           $file->seek($ctr);
           $line = $file->current();
           echo "<button class=\"show\">LN Excerpt</button>";
           echo "<span class=lnText><br>";
           while((strstr($line, "----")) == false){          
               printLine($line);
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

function resolveLink($line){
     $src = "";
     $img = "";
     $off = 17;  
     $set = 1;
     if((strstr($line, "imgur") != false)){
            $set = ((strstr($line, "https")) != false)?18:17;
            $off = (strstr($line, "/a/") != false)?$set+2:$set;
            $img = trim(substr($line,17));
            $src = trim(substr($line,$off));
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
}
function printLine($line){
    if((strstr($line, "http")) == false){
      echo $line ."<br>";
    }elseif((strstr($line, "http")) != false){
      resolveLink($line);
    }
    }
}