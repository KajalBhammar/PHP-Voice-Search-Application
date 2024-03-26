<?php

include 'config.php';

$searchText = $_POST['speechText'];

// search query
$query = 'SELECT * FROM posts WHERE title like "%'.$searchText.'%" or content like "%'.$searchText.'%"';

$result = mysqli_query($con,$query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        $link = $row['link'];
        
        // Generate HTML for each search result
        echo '<div class="blog-post">';
        echo '<h2 class="search-result-title">' . $title . '</h2>';
        echo '<p class="search-result-content">' . $content . '</p>';
        echo '<a class="search-result-link" href="' . $link . '" target="_blank">Read more</a>';
        echo '</div>';
    }
} else {
    // Display message if no results found
    echo '<p class="no-results">No results found</p>';
}

exit;
?>
