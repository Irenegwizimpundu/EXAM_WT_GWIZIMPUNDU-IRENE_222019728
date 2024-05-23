<?php
include('db_connection.php');

// Check if Activity ID is set
if (isset($_REQUEST['activity_id'])) {
  $activity_id = $_REQUEST['activity_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM user_activity WHERE activity_id=?");
  $stmt->bind_param("i", $activity_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['UserId'];
    $activity_name = $row['activity_name'];
    $date = $row['date'];
    $duration = $row['duration'];
  } else {
    echo "Activity not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Activity Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update activity information form -->
        <h2><u>Update Activity Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="activity_name">Activity Name:</label>
            <input type="text" name="activity_name" value="<?php echo isset($activity_name) ? $activity_name : ''; ?>">
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
  $activity_name = $_POST['activity_name'];
  $date = $_POST['date'];
  $duration = $_POST['duration'];

  // Update the activity in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE user_activity SET activity_name=?, date=?, duration=? WHERE activity_id=?");
  $stmt->bind_param("sssi", $activity_name, $date, $duration, $activity_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: user_activity.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
