<?php
?>
<html>
<head>
    <title>Youtube playlist search</title>
</head>

<body>

<script type="text/javascript">

    function go_get(){
        var base_url = 'http://www.youtube.com/embed?listType=search&list=';
        var search_field = document.getElementById('yourtextfield').value;
        var target_url = base_url + search_field;
        var ifr = document.getElementById('youriframe');
        ifr.src = target_url;
        return false;
    }

</script>

<form onsubmit="go_get(); return false;" >
    <input type="text"  id="yourtextfield"/>
    <input type="submit" value="Search Playlists" />
</form>

<iframe id="youriframe" width="640" height="360" ></iframe>

</body>
</html>

