<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercises Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="green">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/OI.jfif" width="90" height="60" alt="Logo">
  </li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./achievement.php">Achievement</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./exercises.php">Exercises</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./food.php">Food</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./goals.php">Goals</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./meal_food.php">Meal_food</a>
  </li>  <li style="display: inline; margin-right: 10px;"><a href="./profile.php">Profile</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./progress.php">Progress</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./user_activity.php">User_activity</a>
   </li>
   <li style="display: inline; margin-right: 10px;"><a href="./workouts.php">Workouts</a>
   </li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
    <h1><u>Food Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">

    <label for="food_id">Food_id:</label>
    <input type="number" id="book_id" name="book_id" required><br><br>

    <label for="food_name">Food_name:</label>
    <input type="text" id="ride_id" name="ride_id" required><br><br>

    <label for="calories">Calories:</label>
    <input type="text" id="passenger_id" name="passenger_id" required><br><br>

     <label for="protein">Protein:</label>
    <input type="text" id="passenger_id" name="passengerid" required><br><br>

     <label for="carbs">carbs:</label>
    <input type="text" id="passenger_id" name="passengeid" required><br><br>

     <label for="fat">Fat:</label>
    <input type="text" id="passenger_id" name="passengid" required><br><br>
        
    </select><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO food(food_id, food_name, calories,protein,carbs,fat) VALUES (?, ?, ?, ? ,?,?)");
    $stmt->bind_param("isssss", $food_id, $food_name, $calories,$protein,$carbs,$fat);
    // Set parameters and execute
    $food_id = $_POST['book_id'];
    $food_name = $_POST['ride_id'];
    $calories = $_POST['passenger_id'];
    $protein= $_POST['passengerid'];
    $carbs= $_POST['passengeid'];
    $fa=$_POST['passengid'];
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>



<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO food(food_id, food_name, calories, protein, carbs, fat) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiii", $food_id, $food_name, $calories, $protein, $carbs, $fat);
    // Set parameters and execute
    $food_id = $_POST['food_id'];
    $food_name = $_POST['food_name'];
    $calories = $_POST['calories'];
    $protein = $_POST['protein'];
    $carbs = $_POST['carbs'];
    $fat = $_POST['fat'];

    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center>
        <!-- Food table -->
        <h2>Food Table</h2>
        <table border="3">
            <tr>
                <th>food_id</th>
                <th>food_name</th>
                <th>calories</th>
                <th>protein</th>
                <th>carbs</th>
                <th>fat</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Retrieve and display data from the food table
            $sql = "SELECT * FROM food";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    $food_id = $row['food_id'];
                    echo "<tr>
                            <td>" . $row['food_id'] . "</td>
                            <td>" . $row['food_name'] . "</td>
                            <td>" . $row['calories'] . "</td>
                            <td>" . $row['protein'] . "</td>
                            <td>" . $row['carbs'] . "</td>
                            <td>" . $row['fat'] . "</td>
                            <td><a style='padding:4px' href='delete_food.php?food_id=$food_id'>Delete</a></td> 
                            <td><a style='padding:4px' href='update_food.php?food_id=$food_id'>Update</a></td> 
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
            }

// Close the database connection
$connection->close();
?>

      </table>

</body>

</section>
 
<footer>
  <center> 
   <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:IRENE GWIZIMPUNDU</h2></b>
  </center>
</footer>
  
</body>
</html>

