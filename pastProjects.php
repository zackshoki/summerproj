<?php
include("include/init.php");
include("include/helper_functions.php");

// $posts = getPosts();
// var_dump($posts);
echoHeader("Past Projects");

echo '
   <div class="pageTitle">
    projects
   </div>
   <div class="projectContainer">';

//    if(isset($_REQUEST['title'])){
$allProjects = getAllProjects();
// debugOutput($allProjects);
foreach ($allProjects as $project) {
    $title = $project['title'];
    $projectId = $project['projectId'];
    $image = $project['image'];
    echo "
                <div class='projectBlock' style='background-image:url($image); height:500px; background-size: cover; background-position: center;'>
                    <h2><a href='view_project.php?projectId=" . $projectId . "'>" . $title . "</a><h2>
                </div>
                ";
}
echo "</div>";
echo "
<div class='finalText'>
<a href='addAProject.php'>add a project?</a>
</div>
";
echo "</body>";
echo "</html>";
//    } else {
//         echo "no post is available.";
//    }
