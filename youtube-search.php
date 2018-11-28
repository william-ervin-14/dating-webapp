<?php
?>
<html>
<script>
    function showResponse(response) {
        var responseString = JSON.stringify(response, '', 2);
        document.getElementById('response').innerHTML += responseString;
    }

    function onClientLoad() {
        gapi.client.load('youtube', 'v3', onYouTubeApiLoad);
    }

    function onYouTubeApiLoad() {
        gapi.client.setApiKey('API_KEY');

        search();
    }

    function search() {
        var request = gapi.client.youtube.search.list({
            part: 'snippet',
            q:"dogs",

        });


        request.execute(onSearchResponse);
    }

    function onSearchResponse(response) {
        showResponse(response);
    }
</script>

<head>
    <script src="javascript.js" type="text/javascript"></script>
    <script src="https://apis.google.com/js/client.js?onload=onClientLoad" type="text/javascript"></script>
</head>
<body>
<pre id="response"></pre>
</body>
</html>

