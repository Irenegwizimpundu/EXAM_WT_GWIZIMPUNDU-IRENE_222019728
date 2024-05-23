<?php
include('db_connection.php');

// Check if Achievement ID is set
if (isset($_REQUEST['achievement_id'])) {
  $achievement_id = $_REQUEST['achievement_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM achievement WHERE achievement_id=?");
  $stmt->bind_param("i", $achievement_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['UserId'];
    $achievement_name = $row['achievement_name'];
    $date_unlocked = $row['date_unlocked'];
  } else {
    echo "Achievement not found.";
  }

  $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Achievement Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update achievement information form -->
        <h2><u>Update Achievement Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="user_id">User id:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>"> <br><br>

            <label for="achievement_name">Achievement Name:</label>
            <input type="text" name="achievement_name" value="<?php echo isset($achievement_name) ? $achievement_name : ''; ?>">
            <br><br>

            <label for="date_unlocked">Date Unlocked:</label>
            <input type="date" name="date_unlocked" value="<?php echo isset($date_unlocked) ? $date_unlocked : ''; ?>">
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
  $achievement_name = $_POST['achievement_name'];
  $date_unlocked = $_POST['date_unlocked'];

  // Update the achievement in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE achievement SET UserId=?, achievement_name=?, date_unlocked=? WHERE achievement_id=?");
  $stmt->bind_param("issi", $user_id, $achievement_name, $date_unlocked, $achievement_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: achievement.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
