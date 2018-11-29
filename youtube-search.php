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
        $thumbnails;

        foreach ($searchResponse['items'] as $searchResult) {
            $videos .= sprintf('<li>%s (%s)</li>',
                $searchResult['snippet']['title'], $searchResult['id']['videoId']);
        }
        foreach ($searchResponse['items'] as $searchResult) {
            $thumbnails = $searchResult['snippet']['thumbnails']['default'];
        }
    }
?>

<!doctype html>
<html>
    <head>
        <title>YouTube Search</title>
    </head>
    <body>
        <form method="GET">
            <div>
                Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
            </div>
            <input type="submit" value="Search">
        </form>
        <h3>Videos</h3>
        <ul><?php echo $videos; ?></ul>
        <div>
            <?=$htmlBody?>
        </div>
        <?php foreach ($thumbnails as $thumbnail) : ?>
            <div>
                <?php echo "<img src='$thumbnail'>"; ?>
            </div>
        <?php endforeach; ?>
    </body>
</html>

