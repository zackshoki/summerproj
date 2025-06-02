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
    <form action="" method="post" enctype="multipart/form-data" class="projectForm" style="margin:auto;"  class="projectContainer">
        <p style = "text-align:center;">project name</p>
        <input type="text" name="projectName">
        <p  style = "text-align:center;">date created</p>
        <input type="datetime" name="dateCreated">
        <p  style = "text-align:center;">organization</p>
        <input type="text" name="projectOrganization">
        <p  style = "text-align:center;">creators</p>
        <input type="text" name="projectCreators">
        <p  style = "text-align:center;">short description</p>
        <input type="text" name="shortDescription">
        <p style = "text-align:center;">long description</p>
        <input type="text" name="longDescription">
        <p style = "text-align:center;">image</p>
        <input type="file" name="image">
        <input type="submit">
    </form>
 </div>