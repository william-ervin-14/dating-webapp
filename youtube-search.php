<?php
    if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
        throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
    }

    require_once __DIR__ . '/vendor/autoload.php';

    if (isset($_GET['q'])) {

        $DEVELOPER_KEY = 'AIzaSyCDQM84XUFkyA6__WNdffCvmMzYoiaA6og';
        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);

        $youtube = new Google_Service_YouTube($client);

        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'type' => 'video',
            'q' => $_GET['q'],
            'maxResults' => 25,
        ));

        $videos = '';
        $thumbnails = array();

        foreach ($searchResponse['items'] as $searchResult) {
            $videos .= sprintf('<li>%s (%s)</li>',
                $searchResult['snippet']['title'], $searchResult['id']['videoId']);
        }
        foreach ($searchResponse['items'] as $searchResult) {
            $thumbnails = $searchResult['snippet']['thumbnails']['default'];
        }
    }
?>
<html>
    <body>
        <form method="GET">
            <div class="video-search-results">
                <div>
                    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
                </div>
                <div class = "youtube-submit-button">
                    <input type="submit" value="Search">
                </div>
                <h3>Videos</h3>
                <?php foreach ($searchResponse['items'] as $searchResult) : ?>
                    <?php $video_url = 'youtube.php?vid='.$searchResult['id']['videoId'] ?>
                    <ul>
                        <li><a href=<?php echo $video_url; ?>><?php echo $searchResult['snippet']['title']; ?></a></li>
                    </ul>
                <?php endforeach; ?>
            </div>
        </form>
    </body>
</html>
