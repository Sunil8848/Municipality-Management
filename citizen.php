
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

        button {
            margin: 0;
            padding: 14px 16px;
            background-color: red;
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
        p{
            color:red;
            text-align: center;
            font-size: 12px
        }
    </style>
    <script type="text/javascript">
   function func_citizenid(){
       var id=document.getElementById("citizen").value;
        var reg=/^[a-zA-Z0-9_]{6,15}$/;
       if(!reg.test(id)){
           document.getElementById("citizen").style.border="2px solid red";
           document.getElementById("text").innerHTML="Enter correct Citizen ID (6-15)character !!!";
       }
       else{
           document.getElementById("citizen").style.border="2px solid green";
           document.getElementById("text").innerHTML="";
       }
   }
    
    </script>
</head>

<body>

    <div class="topnav">
        <!-- <span>
            <img src="logo.png" alt="">
        </span> -->
       
        <a href="firstpage.html" style="padding:0;">
         <img src="logo.png" height="45px" width="45px" alt="logo">
       </a>
       
        <span style="float:right;margin-right: 10px;">
            <button class="btn" onclick=report()>Report</button>
        </span>
    </div>
  <h3 style="text-align:center;color:yellow;margin:15% 20%;">TO MAKE COMPLAINT CLICK <b style="color:red;">REPORT</b> ON TOP-RIGHT CORNER!!!</h3>
  <p ><a href="firstpage.html" style="color:yellow;font-size:16px;"><i>go back to homepage</i></a></p>


<div id="hide">
    <h2 style="text-align: center;"> Report your Complains here: </h2>
    <form id="report" action="?" method="post">
        <label for="citizen"><b>Citizen id:</b></label>
        <input type="text" name="citizenid" id="citizen" onchange="func_citizenid()" required><p id="text"></p>
        <br><br>
        <label for="subject"><b>Complain:</b></label><br>
        <textarea id="subject" placeholder="Write your complain here" name="complain" rows="5" cols="90"
            style="height:200px" required></textarea><br><br>
        <button  style="background-color:green;"  class="btn" type="submit" name="submit"><b>Submit</b></button>
        <button style="text-align:right;margin-left:74%;background-color:red;"  class="btn" type="button" onclick="document.location='firstpage.html'"><b>Cancel</b></button>


    </form>
   </div>
   <h1 style="text-align: center">
   
    </h1>
   

</body>

<script>
    function report() {
        console.log("clicked!!");
        var x=document.getElementById('hide');
        console.log(x.style.display);
        if (x.style.display == "none" || x.style.display == "")
            x.style.display='block';
        else
            x.style.display='none';
        
        //document.main.style.display="none";
    }
</script>
<?php
  $host="localhost";
  $dbusername="root";
  $dbpassword="";
  $dbanme="municipality";
  $conn=mysqli_connect($host, $dbusername, $dbpassword, $dbanme);
  
  
  if (!$conn){
      echo "Server is not connected";
  }

  if(isset($_POST['submit']))
  {
    $cid=$_POST['citizenid'];
    $complain=$_POST['complain'];

    $sql="select * from citizen_details where Citizen_ID=$cid ";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_num_rows($result);

    if($row==1){
              
            $sql_query="insert into complains (Citizen_ID,Complain)
                               values('$cid','$complain')";
            
                               if(mysqli_query($conn,$sql_query)){
                                $msg="Complain Registered Successfully !";
                                echo "<script type='text/javascript'>alert('$msg');</script>";
                               }
                               else{
                                 echo "Error".$sql_query." ".mysqli_error($conn);
                               }

    }
    else{
        $msg="Citizen does not exists !";
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
  }
?>
</html>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>