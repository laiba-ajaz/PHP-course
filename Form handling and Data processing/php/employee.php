<style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7ff;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #2d3e50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e6f0ff;
        }
    </style>

<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["empName"])){
     
     $name = $_POST["empName"];
     $email = $_POST["empEmail"];
     $contact = $_POST["empNo"];
     $depart = $_POST["depart"];
     $salary = $_POST["salary"];
     $bonus = 0;
     $totalSalary = 0;

     if($salary < 25000){
        $bonus = 5;
     } elseif($salary >= 25000 && $salary <= 50000){
        $bonus = 10;
     } else{
        $bonus = 15;
     }

     $calculatedBonus = ($salary * $bonus) / 100; 
     $totalSalary = $salary + $calculatedBonus;

     echo "<h2 style='text-align:center;'>Employee Salary Details</h2>

     <table>
         <tr>
            <th>Employee Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Contact</th>
            <th>Salary</th>
            <th>Bonus</th>
            <th>Total Salary</th>
         </tr>
         <tr>
            <td>$name</td>
            <td>$email</td>
            <td>$depart</td>
            <td>$contact</td>
            <td>$salary</td>
            <td>{$bonus}%</td>
            <td>$totalSalary</td>
         </tr>
     </table>";
    } else {
        echo "Form data is missing!";
    }

} else {
    echo "Invalid Request!";
}



?>