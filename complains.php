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
        form {
            border: 3px solid #f1f1f1;
            margin: 5% 10%;
            padding: 10px;
            background-color: rgb(164, 187, 187);
        }
        .show{
            border: 3px solid #f1f1f1;
            margin: 5% 10%;
            padding: 10px;
            background-color: rgb(164, 187, 187);
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
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

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }

        button {
            padding: 6px;
            margin: 4px;
            background-color: #04AA6D;
            color: white;
        }

        button:hover {
            background-color: #ddd;
            color: black;

        }
        table, th, td{
            border: 2px solid black;
            border-collapse: collapse;
            border-color:green;
        }
    </style>
</head>

<body>

    <div class="topnav">
    <a href="firstpage.html" style="padding:0;">
    <img src="logo.png" height="45px" width="45px" alt="logo">
    </a>
        <a href="adminpage.php">DataEntry</a>
        <a href="update.php">UpdateData</a>
        <a class="active" href="complains.php">Complains</a>
        <a href="ProjectDetails.php">Projects</a>
        <a href="AddProject.php">AddProjects</a>

        <span style="float:right;margin-right: 10px;">
            <a href="reset.php">ResetPassword</a>
            <a href="firstpage.html">Logout</a>
        </span>
    </div>

    
        <form id="citizen" action="?" method="post">
            <button type="submit" name="view">ViewComplains</button>
            
        </form>
<div class="show">

<?php
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbanme="municipality";
$conn=mysqli_connect($host, $dbusername, $dbpassword, $dbanme);


if (!$conn){
    echo "Server is not connected";
}

if(isset($_POST["view"]))
{  

$sql="SELECT * from complains  ";

function view($conn, $sql, $row)
{
    $i=0;
    if($query = mysqli_query($conn, $sql))
    {
        if(mysqli_num_rows($query) > 0)
        {
            while($result = mysqli_fetch_array($query)){
                $i=$i+1;
                $cid  = $result['Citizen_ID'];
                $comp = $result['Complain'];

                $row = $row."<tr>
                     <td>$i</td>
                    <td>$cid</td>
                    <td>$comp</td>
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
  <th>S.No.</th>
  <th>Citizen ID</th>
  <th>Complain</th>
</tr>".$s."
</table>";

mysqli_close($conn);

}
?>
</div>

</body>
</html>
