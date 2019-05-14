<?php
include_once './inc/AuthSession.php';
 if ($_SESSION["AuthLevel"]  >  0){ 
        header("Location: index.php");    
    }
?>
<html>

<head>
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="tables.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form id="contact" action="new_add.php" method="post">
            <h3>Users:</h3>
            <h4>The active users of OCH Health</h4>
            <fieldset>
                <table id="customers">
                    <thead>
                        <tr>
                            <th>User Name: </th>
                            <th>Login Name: </th>
                            <th>Access Level: </th>
                            <th>Password: </th>
                            <th>Maintenance: </th>
                        </tr>
                    </thead>
                    <?php 
                include_once './inc/db_open.php';
                $sql_UserData = "select [OCHMedical].[dbo].[tUserDetail].* from [OCHMedical].[dbo].[tUserDetail]";
                $User_list = odbc_exec($conn, $sql_UserData);
                while (odbc_fetch_row($User_list)) // while there are rows
                {  
                    //link ODBC Values
                    $Userlogin = odbc_result($User_list, "Userlogin");
                    $DomainAccount = odbc_result($User_list, "DomainAccount");
                    $UserName = odbc_result($User_list, "UserName");
                    $SecurityLevel = odbc_result($User_list, "SecurityLevel");
                    $ProgramPassword = odbc_result($User_list, "ProgramPassword");
                    
                    switch ($SecurityLevel) {
                        case 0:
                            $SecurityLevelText = "Admin";
                            break;
                        case 2:
                            $SecurityLevelText = "Add & Update";
                            break;
                        default:
                            $SecurityLevelText = "Update Only";
                    }

                    
                    echo "<tr>";
                    echo "    <td>$UserName</td>";
                    echo "    <td>$Userlogin</td>";
                    echo "    <td>$SecurityLevel = $SecurityLevelText</td>";
                    echo "    <td>$ProgramPassword</td>";
                    echo "    <td><a href='admin_del.php?LoginName=$Userlogin'><i class='fas fa-trash'></i></a> Delete";
                    echo "    <a href='admin_reset.php?LoginName=$Userlogin'><i class='fas fa-sync-alt'></i></a> Reset Pw</td>";
                    echo "</tr>";
                }  
                ?>
                </table>
            </fieldset>
        </form>

        <form id="contact" action="admin_add.php" method="post">
            <h3>Add User</h3>
            <h4>Please Fill Details</h4>
            <fieldset>
                User Name: <input name="UserName" type="text" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                Access Level:
                <select name="AccessLevel" type="text" required>
                    <option value="0">0 - Admin</option>
                    <option value="2">2 - Add & Update</option>
                    <option value="4">4 - Update Only</option>
                </select>
            </fieldset>
            <fieldset>
                Network Account: <input name="NetworkAccount" placeholder="network user aka PETRAGROUP\NameS"
                    type="text" required>
            </fieldset>
            <fieldset>
                LoginName: <input name="LoginName" type="text" placeholder="Username" required>
            </fieldset>
            <fieldset>
                Password: <input name="Password" type="text" required>
            </fieldset>
            <fieldset>
                <button type="submit" id="contact-submit" data-submit="...Sending">Add New</button>
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