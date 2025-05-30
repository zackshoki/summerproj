<?php
    include('include/init.php');
    include('include/helper_functions.php');
    include('comments.php');
    $comments = getComments(); 
    // debugOutput($comments);
    debugOutput($_REQUEST);
    if (isset($_REQUEST['name']) && isset($_REQUEST['comment'])){
        insertComment($_REQUEST['name'], $_REQUEST['comment']);
        header("Location: form_practice.php");
        exit;
        // add a form
        // make it aesthetic
        // add validation
    } 
?> 
<html>
    <body>
        <form action="" method="post">
            name: <input type="text" name="name">
            comment: <input type="text" name="comment">
            <input type="submit">
        </form>
        <?php 
        foreach ($comments as $comment) {
            $name = $comment['name'];
            $content = $comment['content'];
            echo "<div>".htmlspecialchars($name)." said ".htmlspecialchars($content)."</div>";
        } ?>
    </body></html>


