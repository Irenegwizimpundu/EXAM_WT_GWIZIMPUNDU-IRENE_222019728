<?php
include('db_connection.php');

// Check if Progress ID is set
if (isset($_REQUEST['progress_id'])) {
  $progress_id = $_REQUEST['progress_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM progress WHERE progress_id=?");
  $stmt->bind_param("i", $progress_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['UserId'];
    $date = $row['date'];
    $weight = $row['weight'];
    $body_fat_percentage = $row['body_fat_percentage'];
  } else {
    echo "Progress not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Progress Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update progress information form -->
        <h2><u>Update Progress Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
            <br><br>

            <label for="weight">Weight:</label>
            <input type="text" name="weight" value="<?php echo isset($weight) ? $weight : ''; ?>">
            <br><br>

            <label for="body_fat_percentage">Body Fat Percentage:</label>
            <input type="text" name="body_fat_percentage" value="<?php echo isset($body_fat_percentage) ? $body_fat_percentage : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $date = $_POST['date'];
  $weight = $_POST['weight'];
  $body_fat_percentage = $_POST['body_fat_percentage'];

  // Update the progress in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE progress SET date=?, weight=?, body_fat_percentage=? WHERE progress_id=?");
  $stmt->bind_param("sssi", $date, $weight, $body_fat_percentage, $progress_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: progress.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
