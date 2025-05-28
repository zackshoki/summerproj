<?php
	function echoHeader($pageTitle){ 
			echo '
			    <!DOCTYPE html>
                    <head>
			            <meta charset="utf-8" name="viewport" content="width=device-width">
                        <title>'.$pageTitle.'</title>
                        <link rel="icon" type="image/x-icon" href="Photo on 5-22-25 at 9.51 AM.jpg">

                        <link rel="stylesheet" href="styles.css">
                    </head>
			        <body>		            
			            <div class="otterTitle">
                            <a href="aboutMe.php" target="" class="supportingLink">about me</a>
                            
                                <div class="logoLink" href="index.php">
                                    <a href="index.php">ZACK SHOKI</a>
                                </div>
                            
                             <a href="pastProjects.php" target="" class="supportingLink">past projects</a> 
        
                        </div>        
                            
			';
	}

//If you want a footer you can add one this is the bare minimum
function echoFooter(){
	echo "
			</body>
		</html>
	";
}
function echoProjectFooter () {

}