<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Jquery</title>
    <script src="jquery.min.js"></script>
</head>
<body>
<body>
    <h1>Check if jQuery is Working</h1>
    <button id="checkButton">Check jQuery</button>
    <p id="result"></p>
    <span class="result"></span>
    <button >Cek</button>
    <script>
        // $(document).ready(function() {
        //    $("p").text("jQuery is working!");
        //     $("#result").text("Jancok");
        //     $(".result").text("Jancok 2");
        // });
        
        $(document).ready(function() {
            $("button").dblclick(function() {
                // alert("Jancok");
                $("p").text("jQuery is working!");
            $("#result").text("Jancok");
            $(".result").text("Jancok 2");
            });
           
        });
    </script>
</body>
</body>
</html>