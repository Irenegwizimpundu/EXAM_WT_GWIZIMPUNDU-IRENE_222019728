<?php
include('db_connection.php');

// Check if Workout ID is set
if (isset($_REQUEST['workout_id'])) {
  $workout_id = $_REQUEST['workout_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM workouts WHERE workout_id=?");
  $stmt->bind_param("i", $workout_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['UserId'];
    $workout_name = $row['workout_name'];
    $date = $row['date'];
    $duration = $row['duration'];
  } else {
    echo "Workout not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workout Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update workout information form -->
        <h2><u>Update Workout Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="user_id">User id:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>"> <br><br>

            <label for="workout_name">Workout Name:</label>
            <input type="text" name="workout_name" value="<?php echo isset($workout_name) ? $workout_name : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
            <br><br>

            <label for="duration">Duration (minutes):</label>
            <input type="text" name="duration" value="<?php echo isset($duration) ? $duration : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $user_id = $_POST['user_id'];
  $workout_name = $_POST['workout_name'];
  $date = $_POST['date'];
  $duration = $_POST['duration'];

  // Update the workout in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE workouts SET UserId=?, workout_name=?, date=?, duration=? WHERE workout_id=?");
  $stmt->bind_param("isssi", $user_id, $workout_name, $date, $duration, $workout_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: workouts.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
