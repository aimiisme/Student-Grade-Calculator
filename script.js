function submitData() {
  const studentID = document.getElementById("studentID").value;
  const grade = document.getElementById("grade").value;

  fetch("/api/grades", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ studentID, grade }),
  })
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("message").innerText = data.message;
    })
    .catch((error) => console.error(error));
}

function displayData() {
  fetch("/api/grades")
    .then((response) => response.json())
    .then((data) => {
      const dataDisplay = document.getElementById("dataDisplay");
      dataDisplay.innerHTML = "<h2>Student Grades</h2>";
      data.forEach((item) => {
        dataDisplay.innerHTML += `<p>Student ID: ${item.StudentID}, Grade: ${item.Grade}</p>`;
      });
    })
    .catch((error) => console.error(error));
}

if (window.location.pathname === "/index.html") {
  displayData();
} else if (window.location.pathname === "/display.html") {
  displayData();
}
