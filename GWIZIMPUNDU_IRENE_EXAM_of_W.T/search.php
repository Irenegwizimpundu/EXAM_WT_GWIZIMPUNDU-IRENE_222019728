<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {

 include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'achievement' => "SELECT  achievement_name FROM achievement WHERE achievement_name LIKE '%$searchTerm%'",
        'exercises' => "SELECT exercise_name FROM exercises WHERE exercise_name LIKE '%$searchTerm%'",
        'food' => "SELECT  food_name FROM food WHERE food_name LIKE '%$searchTerm%'",
        'goals' => "SELECT  goal_type FROM goals WHERE goal_type LIKE '%$searchTerm%'",
        'meal_food' => "SELECT meal_food_id FROM meal_food WHERE meal_food_id LIKE '%$searchTerm%'",
        'profile' => "SELECT UserId FROM profile WHERE UserId LIKE '%$searchTerm%'",
        'progress' => "SELECT  progress_id FROM progress WHERE progress_id LIKE '%$searchTerm%'",
        'user_activity' => "SELECT activity_name FROM user_activity WHERE activity_name LIKE '%$searchTerm%'",
        'workouts' => "SELECT workout_name FROM workouts WHERE workout_name LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
