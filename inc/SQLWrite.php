<?php

include_once './inc/db_open.php';
include_once './getData.php';

//get all the devices to upload.
$sql_deviceID = "select [GroupSupportReport].[dbo].[tPRTG-Tags].[tagID] from [GroupSupportReport].[dbo].[tPRTG-Tags] WHERE [sensortype] = 'FIREWALL'";
$devices_list = odbc_exec($conn, $sql_deviceID);

while (odbc_fetch_row($devices_list)) // while there are rows
{  
    $tagId = odbc_result($devices_list, "tagID");
    //get data in OBJ format.
    $fromDate = date("Y-m-d-h-i-s-00 a e",strtotime("-2 days"));
    $toDate = date("Y-m-d-h-i-s-00 a e");
    $obj_deviceList = get_data($tagId, $fromDate, $toDate, "OBJ");
    
    //for each record of device.
    foreach($obj_deviceList->{"histdata"} AS $record){

        //debug
//            echo "<b>$tagId</b><br />";
//            if (property_exists( $record ,"datetime")){echo $record->{"datetime"}."<br />"; };  
//            if (property_exists( $record ,"Traffic Total (volume)")){echo $record->{"Traffic Total (volume)"} ."<br />"; }; 
//            if (property_exists( $record ,"Traffic Total (speed)")){echo $record->{"Traffic Total (speed)"} ."<br />"; }; 
//            if (property_exists( $record ,"Traffic In (volume)")){echo $record->{"Traffic In (volume)"} ."<br />"; }; 
//            if (property_exists( $record ,"Traffic In (speed)")){echo $record->{"Traffic In (speed)"} ."<br />"; }; 
//            if (property_exists( $record ,"Traffic Out (volume)")){echo $record->{"Traffic Out (volume)"} ."<br />"; }; 
//            if (property_exists( $record ,"Traffic Out (speed)")){echo $record->{"Traffic Out (speed)"} ."<br />"; }; 
//            if (property_exists( $record ,"Ping Time")){echo $record->{"Ping Time"} ."<br />"; }; 
//            if (property_exists( $record ,"Minimum")){echo $record->{"Minimum"} ."<br />"; }; 
//            if (property_exists( $record ,"Maximum")){echo $record->{"Maximum"} ."<br />"; }; 
//            if (property_exists( $record ,"Packet Loss")){echo $record->{"Packet Loss"} ."<br />"; }; 
//            if (property_exists( $record ,"Downtime")){echo $record->{"Downtime"} ."<br />"; }; 
//            if (property_exists( $record ,"coverage")){echo $record->{"coverage"} ."<br />"; }; 
            
            $stattime = "";
            $Traffic_Total_volume  = "";
            $Traffic_Total_speed  = "";
            $Traffic_In_volume  = "";
            $Traffic_In_speed  = "";
            $Traffic_Out_volume  = "";
            $Traffic_Out_speed  = "";
            $PingTime  = "";
            $Minimum  = "";
            $Maximum  = "";
            $PacketLoss  = "";
            $Downtime  = "";
            $coverage  = "";    
        
            if (property_exists( $record ,"datetime")){$stattime = $record->{"datetime"}; };  
            if (property_exists( $record ,"Traffic Total (volume)")){$Traffic_Total_volume = $record->{"Traffic Total (volume)"}; }; 
            if (property_exists( $record ,"Traffic Total (speed)")){$Traffic_Total_speed = $record->{"Traffic Total (speed)"}; };  
            if (property_exists( $record ,"Traffic In (volume)")){$Traffic_In_volume = $record->{"Traffic In (volume)"}; };   
            if (property_exists( $record ,"Traffic In (speed)")){$Traffic_In_speed = $record->{"Traffic In (speed)"}; };  
            if (property_exists( $record ,"Traffic Out (volume)")){$Traffic_Out_volume = $record->{"Traffic Out (volume)"}; };   
            if (property_exists( $record ,"Traffic Out (speed)")){$Traffic_Out_speed = $record->{"Traffic Out (speed)"}; };  
            if (property_exists( $record ,"Ping Time")){$PingTime = $record->{"Ping Time"}; };   
            if (property_exists( $record ,"Minimum")){$Minimum = $record->{"Minimum"}; };   
            if (property_exists( $record ,"Maximum")){$Maximum = $record->{"Maximum"}; };  
            if (property_exists( $record ,"Packet Loss")){$PacketLoss = $record->{"Packet Loss"}; };   
            if (property_exists( $record ,"Downtime")){$Downtime = $record->{"Downtime"}; };   
            if (property_exists( $record ,"coverage")){$coverage = $record->{"coverage"}; };   

        //setup varubles
            $value =   "'".$tagId."','".
                           substr($stattime,0,22)."','".
                           $Traffic_Total_volume."','".
                           $Traffic_Total_speed."','".
                           $Traffic_In_volume."','".
                           $Traffic_In_speed."','".
                           $Traffic_Out_volume."','".
                           $Traffic_Out_speed."','".
                           $PingTime."','".
                           $Minimum."','".
                           $PacketLoss."','".
                           $Downtime."','".
                           $coverage."' ";
        //setup Headers
            $headers = "[tagId],"
                    ."[stattime],"
                    ."[Traffic_Total_volume],"
                    ."[Traffic_Total_speed],"
                    ."[Traffic_In_volume],"
                    ."[Traffic_In_speed],"
                    ."[Traffic_Out_volume],"
                    ."[Traffic_Out_speed],"
                    ."[PingTime],"
                    ."[Minimum],"
                    ."[PacketLoss],"
                    ."[Downtime],"
                    ."[coverage]";
        //build statment
            $sql = "INSERT INTO [GroupSupportReport].[dbo].[tPRTG-data] ($headers) VALUES ($value)";

        //debug sql santax
            //echo "$sql <br />";  //for debuging

        //insert to SQL
            $result = odbc_exec($conn, $sql);
            //if ($result == FALSE) die ("could not execute statement $sql<br />");
    }
    
}

include_once './inc/db_close.php';





