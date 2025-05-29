<?php
include("include/init.php");
include("include/helper_functions.php");
// $posts = getPosts();
// var_dump($posts);
//echoHeader($title); // we may have to change this based on what the title variable actually is

if (isset($_REQUEST['projectId'])) {
    // Check for the project
    // save project to variable

    $project = getProject($_REQUEST['projectId']);
    //debugOutput($project);
} else {
    echo "no project is available.";
}
$image = $project['image'];
   $description = $project['longDescription'];
    echoHeader($project['title']);
    echo "
        <div class='pageTitle'>".$project['title']."</div>   
        <div>
        <img src='$image'>
        </div> 
        <div class='introParagraph'>$description</div>
    ";    