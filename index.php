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
        <a href="https://www.instagram.com/zackshoki" target="_blank">
            <!-- picture --> <img src="IMG_68.jpg" style="position:relative;width:100%;height:100%;">
            <div class="textUnderImage">this is under the image</div>
        </a>
    </div>
    <div class="imgWrapper img2">
        <a href="https://www.linkedin.com/in/wzshoki" target="_blank">
            <!-- picture --> <img src="IMG_3893.jpeg" style="position:relative;width:100%;height:100%;">
        </a>
    </div>
    <div class="imgWrapper img3">
        <a href="https://www.lessannoyingcrm.com/" target="_blank">
            <!-- picture --> <img src="IMG_0057.jpeg" style="position:relative;width:100%;height:100%;">
        </a>
    </div>
    <div class="introParagraph">
        <p>
            Hello! My name is William Zackaria Shoki, and I am a rising sophomore studying Computer Engineering and Cognitive Neuroscience at <a href="https://www.washu.edu" target="_blank">Washington University in St. Louis.</a> I made this website as a sort of hub for you to learn everything there is to know about me. You'll find some more interesting information about me using the link in the top-left corner of your screen, while you can find out about the projects I have been a part of in the past at the link in the top right.
        </p>
    </div>
    <div class="text2" style="font-size:4.5vw">
        <p>You can hover over each of the images to see where clicking them will take you, or you can just continue to admire the beauty of the website that I made. </p>

    </div>
    <div class="text3" style="font-size:2.9vw">
        <p>
            Right now, I am working as a coding fellow for Less Annoying CRM, where I collaborate with the wonderful people pictured below and where I created this website! Check them out by clicking the image.
        </p>
    </div>
    <div class="separator">
    </div>
    <div class="finalText" id="button">
        <p>thank you for reading!</p>
    </div>

</div>
<script type="text/javascript" src="confetti.min.js">

</script>
<script>
    let confetti = new Confetti('button');
    confetti.setCount(100);
    confetti.setSize(5);
    confetti.setPower(150);
    confetti.setFade(false);
    confetti.destroyTarget(true);
    // window.addEventListener('scroll', () => {
    //     if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    //         console.log("hit bottom");
    //         document.getElementById("button").click();
    //     }
    // })
    // function removeButton(t) {
    //         (t.target.style.opacity = 0),
    //           setTimeout(() => {
    //             (t.target.style.visibility = ""), (t.target.style.opacity = 1);
    //           }, 5e3);
    //       }
</script>
<script type="text/javascript">
    const pageHeight = document.body.scrollHeight;
    console.log(pageHeight);
</script>
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