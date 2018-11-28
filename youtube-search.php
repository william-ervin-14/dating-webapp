<?php
    require_once('load.php');
    include('includes/header.php');

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        unset($_SESSION['email']);
        session_destroy();
        header("location: login.php");
    }
    $email = $_SESSION['email'];
    $user = $query->load_user_objects_by_email($email);
    $logged_user_id = ($user->ID);
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
        Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
      </div>
      <input type="submit" value="Search">
    </form>
END;

    // This code will execute if the user entered a search query in the form
    // and submitted the form. Otherwise, the page displays the form above.
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

        $htmlBody = '';
        try {

            // Call the search.list method to retrieve results matching the specified
            // query term.
            $searchResponse = $youtube->search->listSearch('id,snippet', array(
                'type' => 'video',
                'q' => $_GET['q'],
                'maxResults' => 25,
            ));

            $videos = '';

            // Add each result to the appropriate list, and then display the lists of
            // matching videos, channels, and playlists.
            foreach ($searchResponse['items'] as $searchResult) {
                $videos .= sprintf('<li>%s (%s)</li>',
                    $searchResult['snippet']['title'], $searchResult['id']['videoId']);


            }

            $htmlBody .= <<<END
        <h3>Videos</h3>
        <ul>$videos</ul>
        <h3>Channels</h3>
        <ul>$channels</ul>
        <h3>Playlists</h3>
        <ul>$playlists</ul>
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
        <title>YouTube Search</title>
    </head>
    <body>
        <?=$htmlBody?>
    </body>
</html>

