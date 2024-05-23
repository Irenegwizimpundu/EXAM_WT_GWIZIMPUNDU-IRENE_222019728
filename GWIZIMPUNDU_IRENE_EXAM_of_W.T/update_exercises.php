<?php
include('db_connection.php');

// Check if Exercise ID is set
if (isset($_REQUEST['exercise_id'])) {
  $exercise_id = $_REQUEST['exercise_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM exercises WHERE exercise_id=?");
  $stmt->bind_param("i", $exercise_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $exercise_name = $row['exercise_name'];
    $description = $row['description'];
  } else {
    echo "Exercise not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Exercise Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update exercise information form -->
        <h2><u>Update Exercise Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="exercise_name">Exercise Name:</label>
            <input type="text" name="exercise_name" value="<?php echo isset($exercise_name) ? $exercise_name : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $exercise_name = $_POST['exercise_name'];
  $description = $_POST['description'];

  // Update the exercise in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE exercises SET exercise_name=?, description=? WHERE exercise_id=?");
  $stmt->bind_param("ssi", $exercise_name, $description, $exercise_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: exercises.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
