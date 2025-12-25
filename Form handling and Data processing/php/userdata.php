<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f4f7ff;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px 20px;
    }
    table {
        border-collapse: collapse;
        width: 80%;
        max-width: 600px;
        margin-top: 20px;
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #6c63ff;
        color: white;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
</style>

<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["username"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $pass= $_POST["password"];

        echo "<h2>User Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$username</td>
                    <td>$email</td>
                    <td>$pass</td>
                </tr>
            </tbody>
        </table>";   
 
    } else {
        
        echo "<p style='color:red; font-weight:bold;'>⚠️ Please fill all fields!</p>";
    }

} else {

    echo "<p style='color:blue; font-weight:bold;'>Please submit the form to see user data.</p>";
}

?>