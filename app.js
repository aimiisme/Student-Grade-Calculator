const express = require("express");
const bodyParser = require("body-parser");
const sql = require("mssql");
const app = express();
const port = 3000;

app.use(bodyParser.json());

// Configure your SQL Server connection
const config = {
  server: "your-server-name.database.windows.net",
  user: "your-username",
  password: "your-password",
  database: "your-database-name",
  options: {
    encrypt: true, // For security
  },
};

// Define API endpoints
app.post("/api/grades", async (req, res) => {
  const { studentID, grade } = req.body;

  try {
    await sql.connect(config);
    const result =
      await sql.query`INSERT INTO Grades (StudentID, Grade) VALUES (${studentID}, ${grade})`;
    sql.close();
    res.json({ message: "Data submitted successfully" });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.get("/api/grades", async (req, res) => {
  try {
    await sql.connect(config);
    const result = await sql.query`SELECT * FROM Grades`;
    sql.close();
    res.json(result.recordset);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
