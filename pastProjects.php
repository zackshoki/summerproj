<?php
    include("include/init.php");
    
    // $posts = getPosts();
    // var_dump($posts);
   echoHeader("Past Projects");

   echo '
   <h1>PROJECTS<h1>
   <div class="projectContainer">';

//    if(isset($_REQUEST['title'])){
    $allProjects = getAllProjects();
        foreach ($allProjects as $project) {
                $title = $project['title'];
                $projectId = $project['projectId'];
                echo "
                <div class='projectBlock'>
                    <h2><a href='view_project.php?projectId=".$projectId."'>".$title."</a><h2>
                </div>
                ";
        }
        echo "</div>"

//    } else {
//     echo "no post is available.";
//    }
?>   