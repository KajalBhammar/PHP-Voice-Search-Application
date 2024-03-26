<!doctype html>
<html>
<head>
    <title>Search Blog with Speech Recognition</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .search-container {
            text-align: center;
            margin-top: 50px;
        }

        #speechText {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        #start {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        #start:hover {
            background-color: #45a049;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .blog-post {
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .blog-post:last-child {
            border-bottom: none;
        }

        h2 {
            margin-top: 0;
        }

        p {
            margin-bottom: 0;
        }

        .voice-search-title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-result {
            margin-top: 20px;
        }

        .search-result-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .search-result-content {
            color: #555;
        }

        .search-result-link {
            color: #007bff;
            text-decoration: none;
        }

        .search-result-link:hover {
            text-decoration: underline;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var recognition = new webkitSpeechRecognition();

        recognition.onresult = function(event) {
            console.log('result');
            var saidText = "";
            for (var i = event.resultIndex; i < event.results.length; i++) {
                if (event.results[i].isFinal) {
                    saidText = event.results[i][0].transcript;
                } else {
                    saidText += event.results[i][0].transcript;
                }
            }

            document.getElementById('speechText').value = saidText;

            // Search Posts
            searchPosts(saidText);
        }

        function startRecording(){
            recognition.start();
        }

        // Search Posts
        function searchPosts(saidText){

            $.ajax({
                url: 'getData.php',
                type: 'post',
                data: {speechText: saidText},
                success: function(response){
                    $('.container').html(response);
                }
            });
        }
    </script>
</head>
<body>

<div class='search-container'>
    <!-- Title for Voice Search -->
    <h1 class="voice-search-title">Voice Search for Blog</h1>

    <!-- Search box-->
    <input type='text' id='speechText' placeholder="Speak here..." > &nbsp;
    <input type='button' id='start' value='Start' onclick='startRecording();'>
</div>

<!-- Search Result -->
<div class="container">
    <!-- Search results will appear here -->
</div>

</body>
</html>
