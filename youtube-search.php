<?php
?>
<html>
<script>

    var vquery, nextPageToken, prevPageToken;

    function searchvideo(vquery, pageToken) {
        $('ol').empty();
        gapi.client.setApiKey('AIzaSyCDQM84XUFkyA6__WNdffCvmMzYoiaA6og');
        gapi.client.load('youtube', 'v3', function(){
            var vquery = $('#vquery').val(); // Your input box

            var requestOptions = {
                q: vquery,
                part: 'snippet',
                maxResults: 20, // Change results number here
                type: 'video', // Notice that type used is video only
                pageToken: pageToken
            };

            if (pageToken) {
                requestOptions.pageToken = pageToken;
            }

            var request = gapi.client.youtube.search.list(requestOptions);

            request.execute(function(response) {

                nextPageToken = response.result.nextPageToken;
                var nextVis = nextPageToken ? 'visible' : 'hidden';
                $('#NEXTbutton').css('visibility', nextVis);
                prevPageToken = response.result.prevPageToken
                var prevVis = vprevPageToken ? 'visible' : 'hidden';
                $('#PREVbutton').css('visibility', prevVis);

// This part displays your results:

                for(var i=0;i<response.items.length;i++) {
                    var rThumbnail = response.items[i].snippet.thumbnails.default.url;
                    var rVideoID = response.items[i].id.videoId; // or snippet.videoId
                    var rTitle = response.items[i].snippet.title;
                    var rDescription = response.items[i].snippet.description;

                    $('ol').append('<li"><img src="'+rThumbnail+'" alt="'+rVideoID+'" />
                        <a href="javascript:void(0)" alt="'+rVideoID+'">'+rTitle+'</a>
                        <div class="desc">'+rDescription+'</div></li>');

                    $('.desc').each(function(){ // I use this in case no description
                        if ($(this).text() === '') {
                            $(this).text('- No description available -');
                        }
                    });
                }
            });
        });
    }

    function nextPage() {
        searchvideo(vquery, nextPageToken);
    }
    function previousPage() {
        searchvideo(vquery, prevPageToken);
    }

</script>


<input id="vquery" type="text"/>
<button id="PREVbutton" onclick="previousPage();" class="YTSpagers">Prev</button>
<button id="NEXTbutton" onclick="nextPage();" class="YTSpagers">Next</button>

<ol></ol>


<script>

    $('.YTSpagers').css('visibility', 'hidden'); //Hide buttons before client loads

</script>


<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady">
</script>

<script>

    // When client loads, trigger action:

    function googleApiClientReady() {
        $('.YTSpagers').css('visibility', 'visible');//Buttons display when client ready
    });
    }

</script>
</html>

