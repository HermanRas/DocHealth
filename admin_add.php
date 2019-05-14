<?php
include_once './inc/AuthSession.php';
if ($_SESSION["AuthLevel"]  >  0){ 
    header("Location: index.php ");
    }
?>
<html>

<head>
    <link rel="stylesheet" href="main.css">
    <?php 
    //Setting DataStructure
    $LoginName = '';
    $NetworkAccount = '';
    $UserName = '';
    $AccessLevel = '';
    $Password = '';

    //updating from SQL
    if (isset($_POST["LoginName"]) && !empty($_POST["LoginName"])) {
        $LoginName = $_POST["LoginName"];   
        $NetworkAccount = $_POST["NetworkAccount"];   
        $UserName = $_POST["UserName"];
        $AccessLevel = $_POST["AccessLevel"];
        $Password = $_POST["Password"];

        include_once './inc/db_open.php';
        //Build Vars For UserData
        
        $Colmns =  "(Userlogin,DomainAccount,Username,SecurityLevel,ProgramPassword,OCHPhysicalDB,OCHWellnewssDB)";
        $Values =  "('$LoginName','$NetworkAccount','$UserName','$AccessLevel','$Password','1','1')";
        //Insert to SQL
        $sql_HealthData = "INSERT INTO [OCHMedical].[dbo].[tUserDetail] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_HealthData);
        }
    ?>
</head>

<body>
    <div class="container">
        <form id="contact" action="#" method="post">
            <h3>User Added!</h3>
            <h4>The User has been created on the system</h4>
            <fieldset>
                <button type="button" onclick="location.href = 'menu.php';">Close</button>
            </fieldset>
            <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank"
                    title="Dragoon Information Security">Dragoon Information Security</a></p>
        </form>
    </div>
</body>

</html>