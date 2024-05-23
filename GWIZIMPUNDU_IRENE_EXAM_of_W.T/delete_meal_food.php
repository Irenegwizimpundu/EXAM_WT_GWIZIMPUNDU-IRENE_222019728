<?php
include('db_connection.php');

// Check if Meal Food ID is set
if(isset($_REQUEST['meal_food_id'])) {
    $meal_food_id = $_REQUEST['meal_food_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM meal_food WHERE meal_food_id=?");
    $stmt->bind_param("i", $meal_food_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="meal_food_id" value="<?php echo $meal_food_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Meal Food ID is not set.";
}

$connection->close();
?>
