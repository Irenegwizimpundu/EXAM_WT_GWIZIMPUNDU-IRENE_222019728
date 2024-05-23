<?php
include('db_connection.php');

// Check if Food ID is set
if (isset($_REQUEST['food_id'])) {
  $food_id = $_REQUEST['food_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM food WHERE food_id=?");
  $stmt->bind_param("i", $food_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $food_name = $row['food_name'];
    $calories = $row['calories'];
    $protein = $row['protein'];
    $carbs = $row['carbs'];
    $fat = $row['fat'];
  } else {
    echo "Food not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Food Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update food information form -->
        <h2><u>Update Food Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="food_name">Food Name:</label>
            <input type="text" name="food_name" value="<?php echo isset($food_name) ? $food_name : ''; ?>">
            <br><br>

            <label for="calories">Calories:</label>
            <input type="text" name="calories" value="<?php echo isset($calories) ? $calories : ''; ?>">
            <br><br>

            <label for="protein">Protein:</label>
            <input type="text" name="protein" value="<?php echo isset($protein) ? $protein : ''; ?>">
            <br><br>

            <label for="carbs">Carbs:</label>
            <input type="text" name="carbs" value="<?php echo isset($carbs) ? $carbs : ''; ?>">
            <br><br>

            <label for="fat">Fat:</label>
            <input type="text" name="fat" value="<?php echo isset($fat) ? $fat : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $food_name = $_POST['food_name'];
  $calories = $_POST['calories'];
  $protein = $_POST['protein'];
  $carbs = $_POST['carbs'];
  $fat = $_POST['fat'];

  // Update the food in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE food SET food_name=?, calories=?, protein=?, carbs=?, fat=? WHERE food_id=?");
  $stmt->bind_param("siiiii", $food_name, $calories, $protein, $carbs, $fat, $food_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: food.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
