<?php
include('db_connection.php');

// Check if Profile ID is set
if (isset($_REQUEST['profile_id'])) {
  $profile_id = $_REQUEST['profile_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM profile WHERE profile_id=?");
  $stmt->bind_param("i", $profile_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['UserId'];
    $age = $row['age'];
    $height = $row['height'];
    $weight = $row['weight'];
  } else {
    echo "Profile not found.";
  }

  $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update profile information form -->
        <h2><u>Update Profile Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="user_id">User id:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>"> <br><br>

            <label for="age">Age:</label>
            <input type="number" name="age" value="<?php echo isset($age) ? $age : ''; ?>"> <br><br>

            <label for="height">Height (cm):</label>
            <input type="number" name="height" value="<?php echo isset($height) ? $height : ''; ?>"> <br><br>

            <label for="weight">Weight (kg):</label>
            <input type="number" name="weight" value="<?php echo isset($weight) ? $weight : ''; ?>"> <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $user_id = $_POST['user_id'];
  $age = $_POST['age'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];

  // Update the profile in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE profile SET UserId=?, age=?, height=?, weight=? WHERE profile_id=?");
  $stmt->bind_param("iiddi", $user_id, $age, $height, $weight, $profile_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: profile.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
