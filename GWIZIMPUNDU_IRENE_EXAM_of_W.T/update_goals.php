<?php
include('db_connection.php');

// Check if Goal ID is set
if (isset($_REQUEST['goal_id'])) {
  $goal_id = $_REQUEST['goal_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM goals WHERE goal_id=?");
  $stmt->bind_param("i", $goal_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['UserId'];
    $goal_type = $row['goal_type'];
    $target = $row['target'];
    $deadline = $row['deadline'];
  } else {
    echo "Goal not found.";
  }

  $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Goal Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update goal information form -->
        <h2><u>Update Goal Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="user_id">User id:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>"> <br><br>

            <label for="goal_type">Goal Type:</label>
            <input type="text" name="goal_type" value="<?php echo isset($goal_type) ? $goal_type : ''; ?>"> <br><br>

            <label for="target">Target:</label>
            <input type="number" name="target" value="<?php echo isset($target) ? $target : ''; ?>"> <br><br>

            <label for="deadline">Deadline:</label>
            <input type="date" name="deadline" value="<?php echo isset($deadline) ? $deadline : ''; ?>"> <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $user_id = $_POST['user_id'];
  $goal_type = $_POST['goal_type'];
  $target = $_POST['target'];
  $deadline = $_POST['deadline'];

  // Update the goal in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE goals SET UserId=?, goal_type=?, target=?, deadline=? WHERE goal_id=?");
  $stmt->bind_param("issii", $user_id, $goal_type, $target, $deadline, $goal_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: goals.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
