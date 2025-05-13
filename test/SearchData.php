
<?php
require_once('server/connect.php');
error_reporting(0); 
$searchTerm = ""; // Initialize search term
$column = ""; // Initialize column name
if (isset($_POST['search'])) {
  $searchTerm = $_POST['search'];
  $column = $_POST['column'];
}
else{
  // echo "<script>alert('Please enter a valid data');</script>";
}
  // Check connection
   // Prepare the SQL query
 // $sql = "SELECT * FROM bodyeval,existbody WHERE $column LIKE '%" . $searchTerm . "%'";
  // $result = mysqli_query($conn, $sql);

   $sql = "SELECT * FROM bodyeval WHERE $column LIKE '%" . $searchTerm . "%'";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Data</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">

  <style>
  :root {
  --primary: #6366f1;
  --primary-dark: #4f46e5;
  --primary-light: #a5b4fc;
  --success: #10b981;
  --danger: #ef4444;
  --warning: #f59e0b;
  --dark: #1f2937;
  --light: #f9fafb;
  --gray: #9ca3af;
  --surface: #ffffff;
  --gradient: linear-gradient(135deg, #c3ec52, #0ba29d);
  --gradient-dark: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  --gradient-light: linear-gradient(135deg, #a5b4fc, #c4b5fd);
  --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
  --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
  --radius-sm: 0.25rem;
  --radius: 0.5rem;
  --radius-lg: 1rem;
  --radius-full: 9999px;
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

}

body {
  background: var(--gradient);
  color: var(--dark);
  min-height: 100vh;
  padding: 2rem;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  background: var(--surface);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  padding: 2rem;
  position: relative;
  user-select: none;
 
}
/* Header Styles */
h1 {
  color: var(--dark);
  font-size: 1.875rem;
  font-weight: 600;
  margin-bottom: 2rem;
  text-align: center;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

/* Search Form Styles */
.search-form {
  display: flex;
  gap: 1rem;
  background: var(--light);
  padding: 1.5rem;
  border-radius: var(--radius-lg);
  margin-bottom: 2rem;
  align-items: flex-end;
  border: 1px solid rgba(0,0,0,0.1);
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-group:nth-child(1) {
  min-width: 200px;
}

.form-group:nth-child(2) {
  flex: 1;
}

label {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--dark);
}

select,
input {
  padding: 0.75rem 1rem;
  border: 1px solid var(--gray);
  border-radius: var(--radius);
  font-size: 0.875rem;
  transition: var(--transition);
  background: var(--surface);
}

select:hover,
input:hover {
  border-color: var(--primary);
}

select:focus,
input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px var(--primary-light);
}

.btn-search {
  background: var(--primary);
  color: white;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: var(--radius);
  font-weight: 500;
  cursor: pointer;
  transition: var(--transition);
}

.btn-search:hover {
  background: var(--primary-dark);
  transform: translateY(-1px);
}

/* Table Styles */
.table-container {
  overflow-x: auto;
  border-radius: var(--radius);
  border: 1px solid rgba(0,0,0,0.1);
}

table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  user-select:text;
}
table::selection {
  background: var(--warning);
  color: white;
}
thead {
  background: var(--gradient);
}

th {
  text-align: left;
  padding: 1rem;
  color: white;
  font-size: 0.875rem;
  white-space: nowrap;
}

td {
  padding: 1rem;
  border-bottom: 1px solid var(--gray);
  font-size: 0.875rem;
  color: var(--dark);
}

tr:last-child td {
  border-bottom: none;
}

tbody tr:hover {
  background-color: var(--light);
}

/* Status and Action Styles */
.status {
  padding: 0.25rem 0.75rem;
  border-radius: var(--radius-full);
  font-size: 0.75rem;
  font-weight: 500;
  text-align: center;
  display: inline-block;
}

.no-results {
  text-align: center;
  padding: 2rem;
  color: var(--gray);
  font-style: italic;
}

.error-message {
  background: var(--danger);
  color: white;
  padding: 1rem;
  border-radius: var(--radius);
  margin-bottom: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  body {
    padding: 1rem;
  }

  .container {
    padding: 1rem;
  }

  .search-form {
    flex-direction: column;
    gap: 1rem;
  }

  .form-group {
    width: 100%;
  }
  
  h1 {
    font-size: 1.5rem;
  }
}

/* Custom Scrollbar */
/* Target the entire scrollbar */
::-webkit-scrollbar {
  width: 5px;
}

/* Track (background of scrollbar) */
::-webkit-scrollbar-track {
  background: #1e1e1e;
}

/* Scrollbar thumb (the draggable part) */
::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, #4caf50, #2e7d32);
  border-radius: 10px;
  border: 2px solid #1e1e1e;
}
.table-container {
  display: none;
  }
</style>
</head>
<script>
  function showTable() {
    var tableContainer = document.querySelector('.table-container');
    tableContainer.style.display = "block";
  }
</script>
<body>

<header>
      <h1>Healthy and Happy Community</h1>
    </header>

<nav>
      <a href="about.html">About</a>
      <div class="dropdown">
        <a href="#"> Clients</a>
        <div class="dropdown-content">
          <a href="registration.html">New Registration</a>
          <a href="existingUser.html">Gold UMS Registration</a>
          <a href="SearchData.php">Search Profile</a>
          <a href="#">Client Reports</a>
          
        </div>
      
      </div>
      <a href="idealweight.html">Weight Tracker</a>
      <a href="#">Payments</a>
      <a href="#">Settings</a>
      <a href="index.html">Logout</a>
    </nav>

    <br>
    
    <div class="container">
        <h1>Body Evaluation Records</h1>
        
        <form method="post" class="search-form">
            <div class="form-group">
                <label for="column">Search By:</label>
                <select name="column" id="column">
                    <option value="uname">Name</option>
                    <option value="ID">ID</option>
                    <option value="Date">Date</option>
                </select>

            </div>
            
            <div class="form-group">
                <input type="text" name="search" id="search" placeholder="Enter search term">
            </div>
            
            <div class="form-group">
                <input type="submit" value="Search" class="btn-search" onclick="">
            </div>
        </form>
        
        <div class="table-container">
            <table>
                <thead style="user-select: none; font-weight: 700;">
                    <tr class="table-header">
                        <th>Date</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Body Fat</th>
                        <th>BMI</th>
                        <th>VFA</th>
                        <th>Body Age</th>
                        <th>RM</th>
                        <th>Chest</th>
                        <th>Waist</th>
                        <th>Hip</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Execute the query and fetch results  
                try {
                    if (mysqli_num_rows($result) > 0) {
                      echo "<script>showTable();</script>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['Date'] . "</td>";
                            echo "<td>" . $row['Id'] . "</td>";
                            echo "<td>" . $row['UNAME'] . "</td>";
                            echo "<td>" . $row['HEIGHT'] . "</td>";
                            echo "<td>" . $row['WEIGHT'] . "</td>";
                            echo "<td>" . $row['BODYFAT'] . "</td>";
                            echo "<td>" . $row['BMI'] . "</td>";
                            echo "<td>" . $row['VFA'] . "</td>";
                            echo "<td>" . $row['BODYAGE'] . "</td>";
                            echo "<td>" . $row['RM'] . "</td>";
                            echo "<td>" . $row['CHEST'] . "</td>";
                            echo "<td>" . $row['WAIST'] . "</td>";
                            echo "<td>" . $row['HIP'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                            echo "<script>showTable();</script>";

                        echo "<tr style='user-select:none;'><td colspan='13' class='no-results'>No results found.</td></tr>";

                    }
                    if ($result === 0) {
                        throw new Exception("Something went wrong in someFunction.");
                    }
                } catch (Exception $e) {
                    // Code to handle the exception
                    // For example, log the error, display a message to the user, etc.
                    echo "<div class='error-message'>Caught exception: " . $e->getMessage() . "</div>";
                }
                // Close the connection
                mysqli_close($conn);
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
      &copy; 2025 Healthy and Happy Community
    </footer>
</body>
</html>