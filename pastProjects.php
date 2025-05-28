<?php
include("include/init.php");
include("include/helper_functions.php");

// $posts = getPosts();
// var_dump($posts);
echoHeader("Past Projects");

echo '
   <div class="pageTitle">
    PROJECTS
   </div>
   <div class="projectContainer">';

//    if(isset($_REQUEST['title'])){
$allProjects = getAllProjects();
// debugOutput($allProjects);
foreach ($allProjects as $project) {
    $title = $project['title'];
    $projectId = $project['projectId'];
    echo "
                <div class='projectBlock'>
                    <h2><a href='view_project.php?projectId=" . $projectId . "'>" . $title . "</a><h2>
                </div>
                ";
}
echo "</div>";
echo "</body>";
echo "</html>";
//    } else {
//         echo "no post is available.";
//    }
