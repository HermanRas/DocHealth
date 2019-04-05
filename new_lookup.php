<?php
include_once './inc/AuthSession.php';
 if ($_SESSION["AuthLevel"]  >  2){ 
        header("Location: index.php");    
    }
?>
<html>
    <head>
    <link rel="stylesheet" href="main.css">   
    <?php 
    //Setting DataStructure
    $EmployeeCode = ''; //Pat & Comp
    $IDPassport = ''; //Pat
    $EmployeeDisplay = ''; //Pat
    $JobTitle = ''; //Comp
    $DisciplineDepartment = '';  //Comp
    $CostCentre = ''; 
    $ShiftType = ''; //Comp
    $ReportsToEmployee = ''; 
    $ReportToEmployeeCode = ''; //Comp
    $Gender = '';  //Pat
    $HomeCityTown = '';  //Comp
    $SurfaceUnderground = '';  //Comp
    $Age = '';  //Pat
    $PermanentContractor = ''; //Comp
    $Employer = ''; //Comp
    $ContactDetails = ''; //Comp

    //updating from SQL
    if (isset($_POST["CompNr"]) && !empty($_POST["CompNr"])) {
        $CompNr = $_POST["CompNr"];
                
        include_once './inc/db_open.php';
        $sql_EmployeeData = "select * from [OCHMedical].[dbo].[vNWEmployeeLookup] WHERE [EmployeeCode] = '$CompNr';";
        $Employee_list = odbc_exec($conn, $sql_EmployeeData);
            //link ODBC Values
            $EmpID = odbc_result($Employee_list, "EmployeeCode");
            $EmployeeDisplay = odbc_result($Employee_list, "EmployeeDisplay");
            $JobTitle = odbc_result($Employee_list, "JobTitle");
            $ContactDetails = odbc_result($Employee_list, "ContactDetails");

            if (odbc_num_rows($Employee_list) === 0){
                echo "<script>
                alert('Employee Number not found on Payroll or already registered.') 
                window.location.replace('menu.php');
                </script>";
            }
        }

    ?>
    </head>
    <body>
    <div class="container">  
      <form id="contact" action="#" method="post">
        <h3>Lookup Employee</h3>
        <h4>Please enter the Company Number</h4>
        <fieldset>
            <input name="CompNr" placeholder="Company Number" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
            <button type="submit" id="contact-submit" data-submit="...Sending">Find Employee</button>
        </fieldset>
        <fieldset>
            <button type="button" onclick="location.href = 'menu.php';">Cancel / Close</button>
        </fieldset>
      </form>
      <form id="contact" action="new_add.php" method="post">
        <h3>Add Employee</h3>
        <h4>Please Confirm Details</h4>
        <fieldset>
            Name: <input type="text" value="<?php echo $EmployeeDisplay;?>" readonly="readonly" required>
            <input name="CompNr" type="text" value="<?php echo $EmpID;?>" hidden="" required>
        </fieldset>
        <fieldset>
            Job Title: <input type="text" value="<?php echo $JobTitle;?>" readonly="readonly" required>
        </fieldset>
        <fieldset>
            Contact Details: <input type="text" value="<?php echo $ContactDetails;?>"readonly="readonly" required>
        </fieldset>
        <fieldset>
            Conditions: <br>
            <input type="checkbox" value="" name="Diabetics"><span class="checkBoxLabel">-Diabetics </span> 
            <input type="checkbox" value="" name="Hypertension"><span class="checkBoxLabel">-Hypertension </span>
            <input type="checkbox" value="" name="Epilepsy"><span class="checkBoxLabel">-Epilepsy </span><br>
            <input type="checkbox" value="" name="Asthma"><span class="checkBoxLabel">-Asthma </span>
            <input type="checkbox" value="" name="Weight"><span class="checkBoxLabel">-Weight </span>
        </fieldset>
        <fieldset>
            Conditions Other: <input type="text" value="" name="other" minlength="2" >
        </fieldset>
        <fieldset>
            <button type="submit" id="contact-submit" data-submit="...Sending">Add New</button>
        </fieldset>
        <fieldset>
            <button type="button" onclick="location.href = 'menu.php';">Cancel / Close</button>
        </fieldset>
        <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank" title="Dragoon Information Security">Dragoon Information Security</a></p>
      </form>  
    </div>
    </body>
</html>