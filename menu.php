<?php
include_once './inc/AuthSession.php';
?>
<html>

<head>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container">
        <?php include_once './inc_header.php'; ?>
        <form id="contact" action="index.php" method="post">
            <h3>Menu</h3>
            <h4>Health Tracking Made Easy</h4>
            <?php
        if ($_SESSION["AuthLevel"] <= 2){ ?>
            <fieldset>
                <button type="button" onclick="location.href = 'new_lookup.php';">Add New Employee</button>
            </fieldset>
            <hr><br>
            <?php }
        if ($_SESSION["AuthLevel"] <= 4){  
       ?>
            <fieldset>
                <button type="button" onclick="location.href = 'Update_lookup.php';">Update Employee Health
                    Status</button>
            </fieldset>
            <fieldset>
                <button type="button" onclick="location.href = 'Walkin_lookup.php';">Add Walking Health
                    Status</button>
            </fieldset>
            <hr><br>
            <?php }
        if ($_SESSION["AuthLevel"] == 0){  
       ?>
            <fieldset>
                <button type="button" onclick="location.href = 'Deactivate_lookup.php';">Deactivate Employee</button>
            </fieldset>
            <fieldset>
                <button type="button" onclick="location.href = 'admin.php';">User Administration</button>
            </fieldset>
            <hr><br>
            <?php } ?>
            <fieldset>
                <button name="submit" type="button" onclick="location.href = 'index.php';">Logoff</button>
            </fieldset>
            <p class="copyright">Designed by <a href="http://dragoon.co.za" target="_blank"
                    title="Dragoon Information Security">Dragoon Information Security</a></p>
        </form>
    </div>
</body>

</html>