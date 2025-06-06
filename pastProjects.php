<?php
include("include/init.php");
include("include/helper_functions.php");

// $posts = getPosts();
// var_dump($posts);
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>past projects</title>
    <link rel="icon" type="image/x-icon" href="Photo on 5-22-25 at 9.51 AM.jpg">
    <script type='text/javascript'>
        function printProjects() {
            fetch('projectFormatting.php').then(
                response => (
                    response.text()
                )).then(
                data => (
                    document.getElementById('projectContainer').innerHTML = data
                )
            )
        }
    </script>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="otterTitle">
        <a href="aboutMe.php" target="" class="supportingLink">about me</a>

        <div class="logoLink" href="index.php">
            <a href="index.php">zack shoki</a>
        </div>

        <a href="pastProjects.php" target="" class="supportingLink">past projects</a>

    </div>
    <?php

    echo '
   <div class="pageTitle">
    projects
   </div>
   <div class="projectContainer" id="projectContainer" ">';

    echo "</div>";
    echo "
<div class='finalText' onclick='printProjects()'>
<a href='addAProject.php'>add a project?</a>
</div>
";
    echo "</body>";
    echo "</html>";
//    } else {
//         echo "no post is available.";
//    }
