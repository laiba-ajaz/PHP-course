<style>
/* General Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #e0eafc, #cfdef3);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 5px;
    overflow: hidden;
}

/* Marksheet Container */
.marksheet-container {
    width: 95%;
    max-width: 650px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 12px;
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

/* Headings */
h1 {
    text-align: center;
    color: #333;
    font-size: 1.7em;
    margin-bottom: 15px;
    position: relative;
}
h1::after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background: #007bff;
    margin: 8px auto 0;
    border-radius: 2px;
}

h2 {
    color: #007bff;
    margin: 15px 0 8px;
    font-size: 1.1em;
}

/* Student Details */
.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px dashed #ddd;
    flex-wrap: wrap;
}
.detail-row strong {
    color: #555;
    font-size: 1em;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 5px;
    font-size: 0.85em;
}
th, td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}
th {
    background: #007bff;
    color: #fff;
}
tbody tr:nth-child(even) {
    background: #f9f9f9;
}
.total-row td {
    background: #e9ecef;
    font-weight: bold;
}
.obtained-total {
    color: #28a745;
}

/* Final Result */
.final-result .highlight {
    font-weight: bold;
    color: #ffc107;
}
.final-result .grade-a {
    font-weight: bold;
    color: #dc3545;
    border: 2px solid #dc3545;
    padding: 4px 10px;
    border-radius: 5px;
    display: inline-block;
    font-size: 1em;
}

/* Responsive Adjustments */
@media (max-width: 600px) {
    .marksheet-container {
        padding: 12px 15px;
    }
    h1 {
        font-size: 1.3em;
    }
    table, th, td {
        font-size: 0.9em;
    }
    .detail-row {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>



<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["rollno"])){
      $rollNo= $_POST["rollno"];
      $name = $_POST["stdName"];
      $email = $_POST["stdEmail"];

      $sub1 = $_POST["sub1"];
      $sub2 = $_POST["sub2"];
      $sub3 = $_POST["sub3"];
      $sub4 = $_POST["sub4"];
      $sub5 = $_POST["sub5"];
      $sub6 = $_POST["sub6"];
      $sub7 = $_POST["sub7"];


    $obtMarks = $sub1 + $sub2 + $sub3 + $sub4 + $sub5 + $sub6 + $sub7;
      $percentage = round(($obtMarks / 700) * 100, 2);
      $grade ="";
      
      if($percentage>=80){
         $grade = "A+";
      }elseif($percentage>=70){
         $grade = "A";
      }elseif($percentage>=60){
         $grade = "B";
      }elseif($percentage>=50){
         $grade = "C";
      }else{
        $grade="fail";
      }

  echo "<div class='marksheet-container'>
        <h1>Student Marksheet 🎓</h1>

        <div class='section student-details'>
            <h2>Personal Information</h2>
            <div class='detail-row'>
                <strong>Name:</strong> <span>$name</span>
            </div>
            <div class='detail-row'>
                <strong>Email:</strong> <span>$email</span>
            </div>
            <div class='detail-row'>
                <strong>Roll No:</strong> <span>$rollNo</span>
            </div>
        </div>

        <div class='section subject-performance'>
            <h2>Subject-wise Performance</h2>
            <table>
    <thead>
        <tr>
            <th>Subject Name</th>
            <th>Maximum Marks</th>
            <th>Obtained Marks</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>Mathematics</td><td>100</td><td>$sub1</td></tr>
        <tr><td>Science</td><td>100</td><td>$sub2</td></tr>
        <tr><td>History</td><td>100</td><td>$sub3</td></tr>
        <tr><td>English</td><td>100</td><td>$sub4</td></tr>
        <tr><td>Urdu</td><td>100</td><td>$sub5</td></tr>
        <tr><td>Islamiat</td><td>100</td><td>$sub6</td></tr>
        <tr><td>Computer</td><td>100</td><td>$sub7</td></tr>
    </tbody>
    <tfoot>
        <tr class='total-row'>
            <td><strong>Total</strong></td>
            <td><strong>700</strong></td>
            <td class='obtained-total'><strong>$obtMarks</strong></td>
        </tr>
    </tfoot>
</table>
        </div>

        <div class='section final-result'>
            <h2>Final Result ✨</h2>
            <div class='detail-row'>
                <strong>Percentage:</strong> <span class='highlight'>$percentage</span>
            </div>
            <div class='detail-row'>
                <strong>Grade:</strong> <span class='grade-a'>$grade</span>
            </div>
        </div>

    </div>";
      
  } 
    else {
        
        echo "<div class='marksheet-container'>
                <h2 style='color:#dc3545; text-align:center;'>⚠️ Please fill all fields before submitting!</h2>
              </div>";
    }
} 
else {
    
    echo "<div class='marksheet-container'>
            <h2 style='color:#007bff; text-align:center;'>📌 Please submit the form to view the marksheet.</h2>
          </div>";
}


?>