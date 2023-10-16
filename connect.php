<!-- 
Assignment 2 - AWS RDS with MySQL
Author: Aimi Tran
Course: SWE4633
AWS RDS URL: 'studentgrade-db.clriokky0kyy.us-east-2.rds.amazonaws.com'
user name: 'admin'
password: 'password' 
database name: 'studentgrade'
-->
<!DOCTYPE html>
<html>
<head>
    <title>Student Grade Display</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <h1>Student Grade Display</h1>
    <ul>
        <li><a href="index.php">Enter Data</a></li>
        <li><a href="connect.php">Display Data</a></li>
    </ul>

    <!-- Table to display student data -->
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP code to fetch and display data from the database -->
            <?php
                // Database connection settings
                //AWS RDS URL
                $db_host = 'studentgrade-db.clriokky0kyy.us-east-2.rds.amazonaws.com'; 
                //user name
                $db_user = 'admin'; 
                //password
                $db_pass = 'password';
                //database name 
                $db_name = 'studentgrade'; 

                // Connect to the database
                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    echo "$conn->connect_error";
                    die("Connection failed: " . $conn->connect_error);
                }
                if(isset($_POST['studentid']) && isset($_POST['grade'])){
                    //Insert data into database
                    $studentid = $_POST['studentid'];
                    $grade = $_POST['grade'];
                    // SQL statement to insert data into the StudentGrades table with attributes "StudentID" and "Grade"
                    $insertQuery = "INSERT INTO StudentGrades (StudentID, Grade) VALUES (?, ?)";
                            
                    // Prepare and execute the statement
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bind_param("ii", $studentid, $grade); // "ii" means two integer parameters
                    $stmt->execute();

                    // Check for successful insertion
                    if ($stmt->affected_rows > 0) {
                        echo "Data inserted successfully.";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                }

                 // Query to retrieve student data
                 $query = "SELECT StudentID, Grade FROM StudentGrades";
                 $result = $conn->query($query);
 
                 if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                         echo "<tr>";
                         echo "<td>" . $row["StudentID"] . "</td>";
                         echo "<td>" . $row["Grade"] . "</td>";
                         echo "</tr>";
                     }
                 } else {
                     echo "<tr><td colspan='2'>No data found.</td></tr>";
                 }

                // Query to calculate the average grade
                $query = "SELECT AVG(Grade) AS AverageGrade FROM StudentGrades";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $averageGrade = $row["AverageGrade"];
                    echo "<p>The average grade of all students is: " . $averageGrade . "</p>";
                } else {
                    echo "No data found.";
                }

                // Close the database connection
                $conn->close();
            ?>
        </tbody>
    </table>
              
</body>
</html>

