<?php
    include("include/init.php");
    
    // $posts = getPosts();
    // var_dump($posts);
   //echoHeader($title); // we may have to change this based on what the title variable actually is
    
   if(isset($_REQUEST['projectId'])){
    // Check for the project
    // save project to variable
    $project = getProject($_REQUEST['projectId']);
   } else {
    echo "no project is available.";
   }

    echoHeader($project['title']);
    echo "
        <div>".$project['title']."</div>    
    ";    