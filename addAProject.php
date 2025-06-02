<?php
include('include/init.php');
include('include/helper_functions.php');
echoHeader('Add A Project');

    // debugOutput($comments);
    if (isset($_REQUEST['projectName']) && isset($_REQUEST['projectOrganization'])&& isset($_REQUEST['projectCreators'])&& isset($_REQUEST['shortDescription'])&& isset($_REQUEST['longDescription'])&& isset($_REQUEST['dateCreated'])){ //isset($_REQUEST['image']) && i
        insertProject($_REQUEST['projectName'], $_REQUEST['projectOrganization'], $_REQUEST['dateCreated'], $_REQUEST['shortDescription'], $_REQUEST['projectCreators'], $_REQUEST['longDescription']); //, $_REQUEST['image']
        header("Location: addAProject.php");
        exit;
        // add a form
        // make it aesthetic
        // add validation
    } 
?> 
<div class="pageTitle">
    add a project</div>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="projectName">
        <input type="datetime" name="dateCreated">
        <input type="text" name="projectOrganization">
        <input type="text" name="projectCreators">
        <input type="text" name="shortDescription">
        <input type="text" name="longDescription">
        <input type="file" name="image">
        <input type="submit">
    </form>
</div> 