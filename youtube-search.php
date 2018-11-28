<?php

/**
 * This sample lists videos that are associated with a particular keyword and are in the radius of
 *   particular geographic coordinates by:
 *
 * 1. Searching videos with "youtube.search.list" method and setting "type", "q", "location" and
 *   "locationRadius" parameters.
 * 2. Retrieving location details for each video with "youtube.videos.list" method and setting
 *   "id" parameter to comma separated list of video IDs in search result.
 *
 * @author Ibrahim Ulukaya
 */

/**
 * Library Requirements
 *
 * 1. Install composer (https://getcomposer.org)
 * 2. On the command line, change to this directory (api-samples/php)
 * 3. Require the google/apiclient library
 *    $ composer require google/apiclient:~2.0
 */
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}

require_once __DIR__ . '/vendor/autoload.php';

$htmlBody = <<<END
<form method="GET">
  <div>
    Search: <input type="search" id="q" name="q" placeholder="Enter Search Term">
  </div>
  <input type="submit" value="Search">
</form>
END;

// This code executes if the user enters a search query in the form
// and submits the form. Otherwise, the page displays the form above.
if (isset($_GET['q'])) {
    /*
     * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
    * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
    * Please ensure that you have enabled the YouTube Data API for your project.
    */
    $DEVELOPER_KEY = 'AIzaSyCDQM84XUFkyA6__WNdffCvmMzYoiaA6og';

    $client = new Google_Client();
    $client->setDeveloperKey($DEVELOPER_KEY);

    // Define an object that will be used to make all API requests.
    $youtube = new Google_Service_YouTube($client);

    try {
        // Call the search.list method to retrieve results matching the specified
        // query term.
        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'type' => 'video',
            'q' => $_GET['q'],
            'maxResults' => 25,
        ));

        $videoResults = array();
        # Merge video ids
        foreach ($searchResponse['items'] as $searchResult) {
            array_push($videoResults, $searchResult['id']['videoId']);
        }
        $videoIds = join(',', $videoResults);

        $videosResponse = $youtube->videos->listVideos('snippet, recordingDetails', array(
            'id' => $videoIds,
        ));

        $videos = '';

        // Display the list of matching videos.
        foreach ($videosResponse['items'] as $videoResult) {
            $videos .= sprintf('<li>%s</li>',
                $videoResult['snippet']['title']);

        }


        $htmlBody .= <<<END
    <h3>Videos</h3>
    <ul>$videos</ul>
END;
    } catch (Google_Service_Exception $e) {
        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage()));
    } catch (Google_Exception $e) {
        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage()));
    }
}
?>

<!doctype html>
<html>
    <head>
    </head>
    <body>
        <?=$htmlBody?>
    </body>
</html>

