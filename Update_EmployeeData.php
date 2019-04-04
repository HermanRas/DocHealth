<?php
include_once './inc/AuthSession.php';
if ($_SESSION["AuthLevel"]  >  4){ 
    header("Location: index.php ");
    }
?>
<html>
    <head>
    <link rel="stylesheet" href="form.css">   
    <?php 
    //Setting DataStructure
    $CompanyNumber = '';
    $NameSurname = '';
    $Gender = '';
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

    //updating from SQL
    if (isset($_POST["CompNr"]) && !empty($_POST["CompNr"])) {
        $CompNr = 
            $empCompanyNumber = $_POST["CompNr"];   
            $empNameSurname = $_POST["empNameSurname"];   
            $empGender = $_POST["empGender"];   
            $date = new DateTime();
        
        include_once './inc/db_open.php';
        $sql_HealthData = "select * from [OCHMedical].[dbo].[vWMaxLastResults] WHERE [CompanyNumber] = '$empCompanyNumber';";
        $Health_list = odbc_exec($conn, $sql_HealthData);
            //link ODBC Values
            $CompanyNumber = odbc_result($Health_list, "CompanyNumber"); 
            $NameSurname =  odbc_result($Health_list, "NameSurname"); 
            $Gender = odbc_result($Health_list, "Gender"); 
            $MonitoringDateTime = odbc_result($Health_list, "MonitoringDateTime"); 
            $MonitoringResult_BPSystolic = odbc_result($Health_list, "MonitoringResult_BPSystolic"); 
            $MonitoringResult_BPDiastolic = odbc_result($Health_list, "MonitoringResult_BPDiastolic"); 
            $MonitoringResult_Weight = odbc_result($Health_list, "MonitoringResult_Weight"); 
            $MonitoringResult_Height = odbc_result($Health_list, "MonitoringResult_Height"); 
            $MonitoringResult_BMI = odbc_result($Health_list, "MonitoringResult_BMI"); 
            $MonitoringResult_Gluco = odbc_result($Health_list, "MonitoringResult_Gluco"); 
            $MonitoringResult_HIV = odbc_result($Health_list, "MonitoringResult_HIV"); 
            $MonitoringResult_TBScreening = odbc_result($Health_list, "MonitoringResult_TBScreening"); 
            $MonitoringResult_Other_Description = odbc_result($Health_list, "MonitoringResult_Other_Description"); 
            $MonitoringResult_Other = odbc_result($Health_list, "MonitoringResult_Other"); 
            $Comments = odbc_result($Health_list, "Comments"); 

            $sql = "select * from [OCHMedical].[dbo].[tWPatientMedicalConditions] WHERE CompanyNumber = '$empCompanyNumber';";
            $Conditions = odbc_exec($conn, $sql);
        }
    ?>
    <script type="text/javascript">
    function calcBMI() {
        var weight = document.getElementById("Weight").value;
        var height = document.getElementById("Height").value;
        var bmi = ((weight/height)/height);
        var roundedbmi = Math.round(bmi * 100) / 100
         document.getElementById("BMI").value = roundedbmi;
        }
    </script>
    </head>
    <body>
    <div class="container">  
    <form id="contact" action="Update_add.php" method="post">
        <h3>Employee Checkup!</h3>
        <h4>The Employee is ready for a checkup.</h4>
        <fieldset>
            Conditions being monitored:
            <?php
                 while($row = odbc_fetch_array($Conditions)) {
                    echo '<span class="HEAD"> (' . odbc_result($Conditions, "MedicalConditions") . ')</span>';
            } ?>
            <input name="CompNr" type="hidden" value="<?php echo $empCompanyNumber;?>">
            <input name="empNameSurname" type="text" readonly="readonly" value="<?php echo $empNameSurname;?>">
            <input name="empGender" type="text" readonly="readonly" value="<?php echo $empGender;?>">
            <input name="MonitoringDateTime" type="text"  readonly="readonly" value="<?php echo $date->format('Y-m-d H:i:s');?>">
        </fieldset>
        <fieldset>
           BP Systolic: <?php if ($MonitoringResult_BPSystolic) {echo '<span class="TAG"> (' . $MonitoringResult_BPSystolic . ')</span>';} ?>
           <input name="MonitoringResult_BPSystolic" placeholder="BP Systolic Result" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
           BP Diastolic: <?php if ($MonitoringResult_BPDiastolic) {echo '<span class="TAG"> (' . $MonitoringResult_BPDiastolic . ')</span>';} ?>
           <input name="MonitoringResult_BPDiastolic" placeholder="BP Diastolic Result" type="text" required>
        </fieldset>
        <fieldset>
            Weight <b>Kilograms</b>: <?php if ($MonitoringResult_Weight) {echo '<span class="TAG"> (' . $MonitoringResult_Weight . ')</span>';} ?>
            <input name="MonitoringResult_Weight" id="Weight" placeholder="Weight in Kg" type="text" onchange="calcBMI();" required>
        </fieldset>
        <fieldset>
            Height <b>Meters</b>: <?php if ($MonitoringResult_Height) {echo '<span class="TAG"> (' . $MonitoringResult_Height . ')</span>';} ?>
            <input name="MonitoringResult_Height" id="Height" placeholder="Hight in Meters" type="text" onchange="calcBMI();" required>
        </fieldset>
        <fieldset>
            BMI: <?php if ($MonitoringResult_BMI) {echo '<span class="TAG"> (' . $MonitoringResult_BMI . ')</span>';} ?>
            <input name="MonitoringResult_BMI" id="BMI"  value="0" readonly="readonly" type="text" >
        </fieldset>
        <fieldset>
          Gluco: <?php if ($MonitoringResult_Gluco) {echo '<span class="TAG"> (' . $MonitoringResult_Gluco . ')</span>';} ?>
          <input name="MonitoringResult_Gluco" placeholder="Gluco Result" type="text" required>
        </fieldset>
        <fieldset>
            HIV Test: <?php if ($MonitoringResult_HIV) {echo '<span class="TAG"> (' . $MonitoringResult_HIV . ')</span>';} ?>
            <select name="MonitoringResult_HIV">
                <option value="">Not Tested</option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
            </select>
        </fieldset>
        <fieldset>
           TB Screening <?php if ($MonitoringResult_TBScreening) {echo '<span class="TAG"> (' . $MonitoringResult_TBScreening . ')</span>';} ?>
           <select name="MonitoringResult_TBScreening">
                <option value="">Not Tested</option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
            </select>
        </fieldset>
        <fieldset>
           Other Test:
            <input name="MonitoringResult_Other_Description" placeholder="Test Name" type="text">
            <input name="MonitoringResult_Other" placeholder="Test Result" type="text">
        </fieldset>
        <fieldset>
            Comments: <input name="Comments" placeholder="Comments Here" type="text">
        </fieldset>
        <fieldset>
            <button type="submit" id="contact-submit" data-submit="...Sending">Add New</button>
        </fieldset>
        <fieldset>
            <button type="button" onclick="location.href = 'menu.php';">Cancel / Close</button>
        </fieldset>
        <p class="copyright">Designed by <a href="http://www.dragoon.co.za" target="_blank" title="Dragoon Information Security">Dragoon Information Security</a></p>
      </form>
    </div>
    </body>
</html>