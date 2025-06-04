<html>

<head>
    <link rel='stylesheet' href='styles.css'>
</head>

<body>
    <script type="text/javascript">
        function showHiddenButton() {
            console.log("hiya");
            const element = document.getElementById("secretButton");
            element.classList.add("unhidden");
        }
        for (let index = 0; index < 3; index++) {
            const colors = ["red", "yellow", "green"];
            console.log("this is my current color: " + colors[index]);
            
        }
    </script>
    <h1>this is a java script lesson</h1> <br>
    <a onclick=showHiddenButton()>im a button</a> <br>
    <p id="secretButton" class="hiddenJsButton">the quick brown fox jumps over the lazy dog.</p>
</body>

</html>