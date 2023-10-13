<!DOCTYPE html>
<html>
  <head>
    <title>Student Grade Calculator</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
  </head>
  <body>
    <h1>Student Grade Calculator</h1>
    <div class="entry-form">
      <h2>Data Entry</h2>
      <form id="dataEntryForm" action="connect.php" method="post">
        <label for="studentID">Student ID:</label>
        <input type="text" id="studentID" required name="studentid" /><br /><br />
        
        <label for="grade">Grade:</label>
        <input type="number" id="grade" required name="grade" /><br /><br />
        
        <button type="submit" 
       
        >
        Submit</button>
      </form>
    </div>
  </body>
</html>
