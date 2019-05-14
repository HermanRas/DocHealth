<?php
include_once './inc/AuthSession.php';
if ($_SESSION["AuthLevel"]  >  1){ 
    header("Location: index.php ");
    }
?>
<html>

<head>
    <link rel="stylesheet" href="main.css">
    <?php 
    //Setting DataStructure
    $LoginName = '';
    $date = new DateTime();
    $date = date_format($date, 'Fd');

    //updating from SQL
    if (isset($_GET["LoginName"]) && !empty($_GET["LoginName"])) {
        $LoginName = $_GET["LoginName"];   


        include_once './inc/db_open.php';
        //Build Vars For UserData
        //DELETE FROM SQL
        $sql_HealthData = "UPDATE [OCHMedical].[dbo].[tUserDetail] SET [ProgramPassword] = '$date' WHERE [Userlogin] = '$LoginName';";
        odbc_exec($conn, $sql_HealthData);
        }
    ?>
</head>

<body>
    <div class="container">
        <form id="contact" action="#" method="post">
            <h3>User Password Reset!</h3>
            <h4>The Users Password has been reset on the system</h4>
            <fieldset>
                <label>New Password = <?php echo $date;?></label>
            </fieldset>
            <fieldset>
                <button type="button" onclick="location.href = 'menu.php';">Close</button>
            </fieldset>
            <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank"
                    title="Dragoon Information Security">Dragoon Information Security</a></p>
        </form>
    </div>
</body>

</html>