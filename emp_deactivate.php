<?php
include_once './inc/AuthSession.php';
if ($_SESSION["AuthLevel"]  > 0){ 
    header("Location: index.php ");
    }
?>
<html>

<head>
    <link rel="stylesheet" href="main.css">
    <?php 
    //Setting DataStructure
    $CompNr = ''; //Pat & Comp


    //updating from SQL
    if (isset($_POST["CompNr"]) && !empty($_POST["CompNr"])) {
        $CompNr = $_POST["CompNr"];
                
        include_once './inc/db_open.php';
        //Set patent Active
        $sql_SetActive = "update [OCHMedical].[dbo].[tWPatientDetails] set ActiveIndicator = 0 where CompanyNumber = '$CompNr';";
        odbc_exec($conn, $sql_SetActive);
    }




    ?>
</head>

<body>
    <div class="container">
        <form id="contact" action="#" method="post">
            <h3>Employee Deactivated!</h3>
            <h4>The Employee Has been deactivated on the system</h4>
            <fieldset>
                <button type="button" onclick="location.href = 'menu.php';">Close</button>
            </fieldset>
            <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank"
                    title="Dragoon Information Security">Dragoon Information Security</a></p>
        </form>
    </div>
</body>

</html>