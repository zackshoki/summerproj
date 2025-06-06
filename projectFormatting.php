<?php
include('include/init.php');

function formatProjects($theProjects)
{
    foreach ($theProjects as $project) {
        $title = $project['title'];
        $projectId = $project['projectId'];
        $image = $project['image'];
        echo "
                <div class='projectBlock' style='background-image:url($image); height:500px; background-size: cover; background-position: center;'>
                    <button style='position: relative;background-color:red; width:20px; height:20px; bottom: 0px;'onclick='deleteProject($projectId)'></button>
                    <h2 style='text-align:center'><a href='view_project.php?projectId=" . $projectId . "'>" . $title . "</a><h2>
                    
                </div>
                ";
    }
}
echo formatProjects(getAllProjects());