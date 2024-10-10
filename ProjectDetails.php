<?php
//include("simple_html_dom.php");
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
    header('location: login.php');
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-size: 18px;
        }

        form {
            border: 3px solid #f1f1f1;
            margin: 5% 10%;
            padding: 10px;
            background-color: rgb(164, 187, 187);
        }

        #hide{
            position: fixed;
            top:20%;
            left:20%;
            width:60%;
            z-index: 1;
            opacity:1;
            background-color: antiquewhite;
            border:solid #ddd;
            display: none;
        }
        th, td
        {
            padding:0 15px;
        }
        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
        table, th, td{
            border: 2px solid black;
            border-collapse: collapse;
           
        }
        td{
            color:white;
        }
        button {
            margin: 0;
            padding: 14px 16px;
            background-color: rgb(245, 30, 30);
            color: white;
        }

        .btn:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }
        .main{

            margin: 8% 8% 2% 8%;
            display: flex;
            justify-content: center;
        }
        .center{
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 90%;
            margin: auto;

        }

    </style>
</head>

<body>
<div class="topnav">
<a href="firstpage.html" style="padding:0;">
    <img src="logo.png" height="45px" width="45px" alt="logo">
    </a>
<a  href="adminpage.php">DataEntry</a>
<a href="update.php">UpdateData</a>
<a href="complains.php">Complains</a>
<a class="active" href="ProjectDetails.php">Projects</a>
<a href="AddProject.php">AddProjects</a>


<span style="float:right;margin-right: 10px;">
  <a href="reset.php">ResetPassword</a>
  <a href="firstpage.html">Logout</a>
</span>
</div>
<div class="center">
  <h2 style="text-align:center;">Udergoing Projects:</h2>

  <?php

    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbanme="municipality";
    $conn=mysqli_connect($host, $dbusername, $dbpassword, $dbanme);
    if(!$conn){
        echo "Database not connected";
    }
    
    $sql = "SELECT * from addProject ";

    
    function view($conn, $sql, $row){
        if($query = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($query) > 0){
                while($result = mysqli_fetch_array($query)){
                    $name  = $result['Project_Name'];
                    $no = $result['Project_No'];
                    $department = $result['Department_No'];
                    $budget = $result['Budget'];
                    $company = $result['Project_Company'];
                    $location = $result['Project_Location'];
                    $start = $result['Start_Date'];
                    $end = $result['End_Date'];

                    $row = $row."<tr>
                        <td>$no</td>
                        <td>$name</td>
                        <td>$department</td>
                        <td>$budget</td>
                        <td>$company</td>
                        <td>$location</td>
                        <td>$start</td>
                        <td>$end</td>
                        </tr>";
                }
                mysqli_free_result($query);
            }
        }
        return $row;
    }
    $s = view($conn, $sql, "");
    echo "<table>
    <tr>
      <th>Project Number</th>
      <th>Project Name</th>
      <th>Department</th>
      <th>Budget</th>
      <th>Project Company</th>
      <th>Project Location</td>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>".$s."
    </table>";
    ?>

</div>
  </body>

</html>