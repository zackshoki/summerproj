<!DOCTYPE html>
<html>
<?php
include("include/init.php");

// $posts = getPosts();
// var_dump($posts);
echoHeader("ZACKARIA");
?>
<!-- for 5/27: 
    how can we make it so that the sticky images stop sticking whenever we hit the final text?
        try using a wrapper to see images are taking up a certain percentage of the screen and cropping the bottom off if so
    make it so that hovering over any of the images makes them opaque with text and clicking them sends you to another website
    make the colors and fonts prettier, as well as experiment with the border radius and the colors of the background and size of padding to create a really modern looking website
    finish the about me page, using this page as a template.  -->
<!-- make the get all posts function
    make the get posts function 
    populate the practice posts array with all the stuff that you have on ur page
    add the linkes in your url or wtv-->

<!-- <head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>ZACKARIA</title>
    <link rel="icon" type="image/x-icon" href="Photo on 5-22-25 at 9.51 AM.jpg">
=
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="otterTitle">
        <a href="aboutMe.php" target="_blank" class="supportingLink">about me</a>
            <div class="logoLink" href="index.php">
                ZACK SHOKI
            </div>
        <a href="https://github.com/zackshoki" target="_blank" class="supportingLink">past projects</a> 
        
    </div> -->

<div class="siteGridContainer">
    <div class="imgWrapper img1">
        <!-- picture --> <img src="IMG_68.jpg" style="position:relative;width:100%;height:100%;">
    </div>
    <div class="imgWrapper img2">
        <!-- picture --> <img src="IMG_3893.jpeg" style="position:relative;width:100%;height:100%;">
    </div>
    <div class="imgWrapper img3">
        <!-- picture --> <img src="IMG_0057.jpeg" style="position:relative;width:100%;height:100%;">
    </div>
    <div class="introParagraph">
        <p>
            
        </p>
    </div>
    <div class="text2">
        <p></p>
           
    </div>
    <div class="text3">
        <p>
        </p>
    </div>
    <div class="finalText">
        <p>thank you for reading!</p>
    </div>

</div>

<!-- <span>
        <img src="https://em-content.zobj.net/source/apple/232/otter_1f9a6.png" alt="the otter emoji"
            class="otterImage">
    </span>
    <span>
        <img src="https://em-content.zobj.net/source/apple/232/otter_1f9a6.png" alt="the otter emoji"
            class="mirroredOtterImage">
    </span> -->
<!-- <div>
        <img class="hangingFrame">
        
        <div>
            <img class="imageInFrame" src="4F80B169-E743-4484-8A51-174E9E8A0CAC_1_201_a.jpeg">
        </div>
    </div> 
    <div>
        
        <img class="hangingFrame" style="left: auto;right:1em;transform: rotateY('180deg');">
        
             <div>
                <img class="imageInFrame" src="B2DB6F3E-0D8C-41F1-B3EA-6F6EDDD9EE7E_1_201_a.jpeg"
            style="left: auto;right:9.8%;transform: rotateY('180deg');width: 10%;">
            </div>  
    </div>-->
</body>
</html>