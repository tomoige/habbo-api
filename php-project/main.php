<?php
    // Include the Composer autoloader
    include 'vendor/autoload.php';
    
    // Shortcut for the FQN
    use HabboAPI\HabboAPI;
    use HabboAPI\HabboParser;
    
    // Create new Parser and API instance
    $habboParser = new HabboParser('com');
    $habboApi = new HabboAPI($habboParser);
    
    // Find the user 'koeientemmer' and get their ID
    $koeientemmer = $habboApi->getHabbo('molly.holly')->getId();
    
    // Collect all the profile info
    $profile = $habboApi->getProfile($koeientemmer);

    // Display more information from the profile
    print_r($profile->getFriends()[1]);