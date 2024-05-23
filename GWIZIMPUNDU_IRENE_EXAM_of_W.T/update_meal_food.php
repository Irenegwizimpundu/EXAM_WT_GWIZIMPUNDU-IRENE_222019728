<?php
include('db_connection.php');

// Check if meal_food_id is set
if (isset($_REQUEST['meal_food_id'])) {
  $meal_food_id = $_REQUEST['meal_food_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM meal_food WHERE meal_food_id=?");
  $stmt->bind_param("i", $meal_food_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $food_id = $row['food_id'];
    $quantity = $row['quantity'];
  } else {
    echo "Meal food not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Meal Food Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update meal food information form -->
        <h2><u>Update Meal Food Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="food_id">Food ID:</label>
            <input type="text" name="food_id" value="<?php echo isset($food_id) ? $food_id : ''; ?>">
            <br><br>

            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $food_id = $_POST['food_id'];
  $quantity = $_POST['quantity'];

  // Update the meal food in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE meal_food SET food_id=?, quantity=? WHERE meal_food_id=?");
  $stmt->bind_param("iii", $food_id, $quantity, $meal_food_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: meal_food.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
