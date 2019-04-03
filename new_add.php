<?php
include_once './inc/AuthSession.php';
if ($_SESSION["AuthLevel"]  > 2){ 
    header("Location: index.php ");
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
            $EmployeeCode = odbc_result($Employee_list, "EmployeeCode"); //Pat & Comp
            $IDPassport = odbc_result($Employee_list, "IDPassport"); //Pat
            $EmployeeDisplay = odbc_result($Employee_list, "EmployeeDisplay"); //Pat
            $JobTitle = odbc_result($Employee_list, "JobTitle"); //Comp
            $DisciplineDepartment = odbc_result($Employee_list, "DisciplineDepartment");  //Comp
            $CostCentre = odbc_result($Employee_list, "CostCentre"); 
            $ShiftType = odbc_result($Employee_list, "ShiftType"); //Comp
            $ReportsToEmployee = odbc_result($Employee_list, "ReportsToEmployee"); 
            $ReportToEmployeeCode = odbc_result($Employee_list, "ReportToEmployeeCode"); //Comp
            $Gender = odbc_result($Employee_list, "Gender");  //Pat
            $HomeCityTown = odbc_result($Employee_list, "HomeCityTown");  //Comp
            $SurfaceUnderground = odbc_result($Employee_list, "SurfaceUnderground");  //Comp
            $Age = odbc_result($Employee_list, "Age");  //Pat
            $PermanentContractor = odbc_result($Employee_list, "PermanentContractor"); //Comp
            $Employer = odbc_result($Employee_list, "Employer"); //Comp
            $ContactDetails = odbc_result($Employee_list, "ContactDetails"); //Comp
        
        //Build Vars for PerData
        $Colmns =  "(CompanyNumber,NameSurname,IDPassport,Gender,AgeAtRegistration)";
        $Values =  "('$EmployeeCode','$EmployeeDisplay','$IDPassport','$Gender','$Age')";
        //Insert to SQL
        $sql_PerData = "INSERT INTO [OCHMedical].[dbo].[tWPatientDetails] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_PerData);
            
        //Build Vars For CompData
        $Colmns =  "(CompanyNumber,CompanyName,PermanentContract,JobTitle,DisciplineDepartment,SurfaceUG,ShiftType,ManagerCompanyNumber,HomeAddress,ContactNumber)";
        $Values =  "('$EmployeeCode','$Employer','$PermanentContractor','$JobTitle','$DisciplineDepartment','$SurfaceUnderground','$ShiftType','$ReportToEmployeeCode','$HomeCityTown','$ContactDetails')";
        //Insert to SQL
        $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientWorkDetails] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_CompData);

        if (isset($_POST["Diabetics"])){
        //Build Vars For CompData
        $Colmns =  "(CompanyNumber,MedicalConditions)";
        $Values =  "('$EmployeeCode','Diabetics')";
        //Insert to SQL
        $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientMedicalConditions] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_CompData);
        }

        if (isset($_POST["H"])){
        //Build Vars For CompData
        $Colmns =  "(CompanyNumber,MedicalConditions)";
        $Values =  "('$EmployeeCode','H')";
        //Insert to SQL
        $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientMedicalConditions] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_CompData);
        }

        if (isset($_POST["Haarts"])){
        //Build Vars For CompData
        $Colmns =  "(CompanyNumber,MedicalConditions)";
        $Values =  "('$EmployeeCode','Haarts')";
        //Insert to SQL
        $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientMedicalConditions] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_CompData);
        }

        if (isset($_POST["Hypertension"])){
        //Build Vars For CompData
        $Colmns =  "(CompanyNumber,MedicalConditions)";
        $Values =  "('$EmployeeCode','Hypertension')";
        //Insert to SQL
        $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientMedicalConditions] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_CompData);
        }

        if (isset($_POST["Sputum"])){
        //Build Vars For CompData
        $Colmns =  "(CompanyNumber,MedicalConditions)";
        $Values =  "('$EmployeeCode','Sputum')";
        //Insert to SQL
        $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientMedicalConditions] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_CompData);
        }

        if (isset($_POST["Weight"])){
        //Build Vars For CompData
        $Colmns =  "(CompanyNumber,MedicalConditions)";
        $Values =  "('$EmployeeCode','Weight')";
        //Insert to SQL
        $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientMedicalConditions] $Colmns VALUES $Values;";
        odbc_exec($conn, $sql_CompData);
        }

        if (isset($_POST["other"])){
            if (strlen($_POST["other"]) > 2 ){
                $custom = $_POST["other"];
                //Build Vars For CompData
                $Colmns =  "(CompanyNumber,MedicalConditions)";
                $Values =  "('$EmployeeCode','$custom')";
                //Insert to SQL
                $sql_CompData = "INSERT INTO [OCHMedical].[dbo].[tWPatientMedicalConditions] $Colmns VALUES $Values;";
                odbc_exec($conn, $sql_CompData);
            }
        }

        }
    ?>
    </head>
    <body>
    <div class="container">  
      <form id="contact" action="#" method="post">
        <h3>Employee Added!</h3>
        <h4>The Employee Has been added to the system</h4>
        <fieldset>
            <button type="button" onclick="location.href = 'menu.php';">Close</button>
        </fieldset>
        <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank" title="Dragoon Information Security">Dragoon Information Security</a></p>
      </form>
    </div>
    </body>
</html>