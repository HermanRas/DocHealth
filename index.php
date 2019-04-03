<?php
session_start();
if (isset($_POST["User"]) && !empty($_POST["User"])) {
        $User = $_POST["User"];
        $Pass = $_POST["Pass"];
        $ACCLEVEL = "";
        
        include_once './inc/db_open.php';
        $sql_EmployeeData = "select top 1 [OCHMedical].[dbo].[tUserDetail].[SecurityLevel] from [OCHMedical].[dbo].[tUserDetail] WHERE [Userlogin] = '$User' AND [ProgramPassword] = '$Pass';";
        $Employee_list = odbc_exec($conn, $sql_EmployeeData);
            //link ODBC Values
            $ACCLEVEL = odbc_result($Employee_list, "SecurityLevel");
        if (is_numeric($ACCLEVEL)){
            $_SESSION["Login"] = true;
            $_SESSION["AuthLevel"] = $ACCLEVEL;
            header("Location: menu.php");
        }else{
            $_SESSION["Login"] = false;
        }
}
?>

<html>
    <head>
    <link rel="stylesheet" href="main.css">
    </head>
    <body>
    <div class="container">  
      <?php include_once './inc_header.php'; ?>
      <form id="contact" action="#" method="post">
          <h3><b>Doc-Health, </b><br>  Health and Wellness</h3>
        <h4>Please Login</h4>
        <fieldset>
            <input name="User" placeholder="Your user name" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
            <input name="Pass" placeholder="Your Password" type="password" tabindex="2" required>
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
        <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank" title="Dragoon Information Security">Dragoon Information Security</a></p>
      </form>
    </div>
    </body>
</html>