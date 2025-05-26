<html>
    <form action="magic8Ball.php">
        Question: <input type="text" name="question">
        <input type="submit"> 
</form>

<?php
// variable for the question
if (isset($_GET["question"])) {
    $question = $_GET["question"];
}
// check for the question
if (isset($question)) {
$potentialAnswers = [ // make an array of all the possible answers
    "yes!",
    "maybe..",
    "quite possibly",
    "probably not :(",
    'sadly, yes',
    "DEFINITELY NOT",
    "no...",
]; 

$ans = $potentialAnswers[rand(0, count($potentialAnswers)-1)]; // generate an answer to the question

echo $ans; // echo the answer inside of the 8 ball
} 
?>
</html>
