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
    $EmpID = '';
    $NameSurname = '';
    $Gender = '';

    //updating from SQL
    if (isset($_POST["CompNr"]) && !empty($_POST["CompNr"])) {
        $CompNr = $_POST["CompNr"];
                
        include_once './inc/db_open.php';
        $sql_EmployeeData = "select EmployeeCode,EmployeeDisplay, Gender from [OCHMedical].[dbo].[tWEmployeeLookup] WHERE [EmployeeCode] = '$CompNr';";
        $Employee_list = odbc_exec($conn, $sql_EmployeeData);
            //link ODBC Values
            $EmpID = odbc_result($Employee_list, "EmployeeCode");
            $NameSurname = odbc_result($Employee_list, "EmployeeDisplay");
            $Gender = odbc_result($Employee_list, "Gender");
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
        <form id="contact" action="Update_WalkinData.php" method="post">
            <h3>Update Employee Health </h3>
            <h4>Please Confirm Details</h4>
            <fieldset>
                Name: <input name="empNameSurname" type="text" value="<?php echo $NameSurname;?>" readonly="readonly"
                    required>
                <input name="CompNr" type="text" value="<?php echo $EmpID;?>" hidden="" required>
            </fieldset>
            <fieldset>
                Gender: <input name="empGender" type="text" value="<?php echo $Gender;?>" readonly="readonly" required>
            </fieldset>
            <fieldset>
                <button type="submit" id="contact-submit" data-submit="...Sending">Update Now</button>
            </fieldset>
            <fieldset>
                <button type="button" onclick="location.href = 'menu.php';">Cancel / Close</button>
            </fieldset>
            <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank"
                    title="Dragoon Information Security">Dragoon Information Security</a></p>
        </form>
    </div>
</body>

</html>