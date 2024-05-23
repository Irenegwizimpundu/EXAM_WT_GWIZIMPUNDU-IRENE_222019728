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
    <h1><u>GOAL Form</u></h1>


<form method="post" onsubmit="return confirmInsert();">

    <label for="goal_id">Goal_id:</label>
    <input type="number" id="book_id" name="book_id" required><br><br>

    <label for="UserId">UserId:</label>
    <input type="text" id="ride_id" name="ride_id" required><br><br>

    <label for="goal_type">Goal_type:</label>
    <input type="text" id="passenger_id" name="passenger_id" required><br><br>

     <label for="target">Target:</label>
    <input type="text" id="passenger_id" name="passengerid" required><br><br>

     <label for="deadline">Deadline:</label>
    <input type="date" id="passenger_id" name="passengeid" required><br><br>

    </select><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO goals(goal_id, UserId, goal_type,target,deadline) VALUES (?, ?, ?, ? ,?,?)");
    $stmt->bind_param("isssss", $food_id, $food_name, $calories,$protein,$carbs,$fat);
    // Set parameters and execute
    $goal_id = $_POST['book_id'];
    $UserId = $_POST['ride_id'];
    $goal_type = $_POST['passenger_id'];
    $target= $_POST['passengerid'];
    $deadline= $_POST['passengeid'];

    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>oals Details</title>
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
    <center><h2>Goals Table</h2></center>
    <table border="3">
        <tr>
            <th>goal_id</th>
            <th>UserId</th>
            <th>goal_type</th>
            <th>target</th>
            <th>deadline</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all goals
$sql = "SELECT * FROM goals";
$result = $connection->query($sql);

// Check if there are any goals
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $goal_id = $row['goal_id']; // Fetch the goal_id
        echo "<tr>

            <td>" . $row['goal_id'] . "</td>
            <td>" . $row['UserId'] . "</td>
            <td>" . $row['goal_type'] . "</td>
            <td>" . $row['target'] . "</td>
            <td>" . $row['deadline'] . "</td>
            <td><a style='padding:4px' href='delete_goals.php?goal_id=$goal_id'>Delete</a></td> 
            <td><a style='padding:4px' href='update_goals.php?goal_id=$goal_id'>Update</a></td> 
        </tr>";
    }

} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
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

