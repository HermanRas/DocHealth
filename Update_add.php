<?php
include_once './inc/AuthSession.php';
if ($_SESSION["AuthLevel"]  >  4){ 
    header("Location: index.php ");
    }
?>
<html>

<head>
    <link rel="stylesheet" href="main.css">
    <?php 
    //Setting DataStructure
    $empCompanyNumber = '';
    $empNameSurname = '';
    $empGender = '';
    $MonitoringDateTime = '';
    $MonitoringResult_BPSystolic = '';
    $MonitoringResult_BPDiastolic = '';
    $MonitoringResult_Weight = '';
    $MonitoringResult_Height = '';
    $MonitoringResult_BMI = '';
    $MonitoringResult_Gluco = '';
    $MonitoringResult_HIV = '';
    $MonitoringResult_TBScreening = '';
    $MonitoringResult_Other_Description = '';
    $MonitoringResult_Other = '';
    $Comments = '';
    $CapturedBy = '';

    //updating from SQL
    if (isset($_POST["CompNr"]) && !empty($_POST["CompNr"])) {
        
        $empCompanyNumber = $_POST["CompNr"];   
        $empNameSurname = $_POST["empNameSurname"];   
        $empGender = $_POST["empGender"];
        $MonitoringDateTime = $_POST["MonitoringDateTime"];
        $MonitoringResult_BPSystolic = $_POST["MonitoringResult_BPSystolic"];
        $MonitoringResult_BPDiastolic = $_POST["MonitoringResult_BPDiastolic"];
        $MonitoringResult_Weight = $_POST["MonitoringResult_Weight"];
        $MonitoringResult_Height = $_POST["MonitoringResult_Height"];
        $MonitoringResult_BMI = $_POST["MonitoringResult_BMI"];
        $MonitoringResult_Gluco = $_POST["MonitoringResult_Gluco"];
        $MonitoringResult_HIV = $_POST["MonitoringResult_HIV"];
        $MonitoringResult_TBScreening = $_POST["MonitoringResult_TBScreening"];
        $MonitoringResult_Other_Description = $_POST["MonitoringResult_Other_Description"];
        $MonitoringResult_Other = $_POST["MonitoringResult_Other"];
        $Comments = $_POST["Comments"];
        $CapturedBy = $_SESSION["User"];
        include_once './inc/db_open.php';

        //Build Vars For HealthData
        $Colmns =  "(CompanyNumber,MonitoringDateTime,MonitoringResult_BPSystolic,MonitoringResult_BPDiastolic,MonitoringResult_Weight,MonitoringResult_Height,MonitoringResult_BMI,MonitoringResult_Gluco,MonitoringResult_HIV,MonitoringResult_TBScreening,MonitoringResult_Other_Description,MonitoringResult_Other,Comments,CapturedBy)";
        $Values =  "('$empCompanyNumber','$MonitoringDateTime','$MonitoringResult_BPSystolic','$MonitoringResult_BPDiastolic','$MonitoringResult_Weight','$MonitoringResult_Height','$MonitoringResult_BMI','$MonitoringResult_Gluco','$MonitoringResult_HIV','$MonitoringResult_TBScreening','$MonitoringResult_Other_Description','$MonitoringResult_Other','$Comments','$CapturedBy')";
        //Insert to SQL
        $sql_HealthData = "INSERT INTO [OCHMedical].[dbo].[tWMonitoringResults] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_HealthData);
        //Set patent Active
        $sql_SetActive = "update [OCHMedical].[dbo].[tWPatientDetails] set ActiveIndicator = 1 where CompanyNumber = '$empCompanyNumber';";
        odbc_exec($conn, $sql_SetActive);
        }
    ?>
</head>

<body>
    <div class="container">
        <form id="contact" action="#" method="post">
            <h3>Employee Updated!</h3>
            <h4>The Employee's Recoreds has been updated on the system</h4>
            <fieldset>
                <button type="button" onclick="location.href = 'menu.php';">Close</button>
            </fieldset>
            <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank"
                    title="Dragoon Information Security">Dragoon Information Security</a></p>
        </form>
    </div>
</body>

</html>