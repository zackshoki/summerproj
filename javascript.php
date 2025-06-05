<html>

<head>
    <script type='text/javascript'>
        function getCurrentTime() {
            fetch('ajax_endpoint.php').then(
                response => (
                    response.text()
                )).then(
                data => (
                    document.getElementById('dateTimeSelection').innerHTML = data
                )
            )
        }
    </script>
</head>

<body>
    <input type='button' value='what time is it?' onclick='getCurrentTime()'>
    <p id='dateTimeSelection' style='color: purple'> The original inner html</p>
</body>

</html>