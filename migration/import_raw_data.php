<?php

$db = new mysqli("localhost", "root", "1234", "crime_data");


$insertClause = "INSERT INTO raw_crime_data ";
$insertClause .= "(dr_no, date_rptd, date_occ, time_occ, area, area_name, ";
$insertClause .= "rpt_dist_no, part_1_2, crm_cd, crm_cd_desc, mocodes, ";
$insertClause .= "vict_age, vict_sex, vict_descent, premis_cd, premis_desc, ";
$insertClause .= "weapon_used_cd, weapon_desc, status, status_desc, ";
$insertClause .= "crm_cd_1, crm_cd_2, crm_cd_3, crm_cd_4, location, cross_street, ";
$insertClause .= "lat, lon) VALUES ";

$fp = fopen('crime_data.csv', 'r');

$headers = fgetcsv($fp);
$count = count($headers);

$counter = 0;
while($row = fgetcsv($fp)) {
    $counter++;
    if($counter%100 === 0) {
        echo "$counter\n";
    }
    $valuesClause = "(";
    for($i = 0; $i < $count; $i++) {
        if($i === 1 || $i === 2) {
            $date = new DateTime();
            $date->setTimestamp(strtotime($row[$i]));
            $value = $date->format('Y-m-d H:i:s');
        } else {
            $value = trim($row[$i]);
        }
        $valuesClause .= "'$value',";
    }
    $valuesClause = rtrim($valuesClause, ',') . ')';
    $db->query($insertClause . $valuesClause);
}

fclose($fp);
