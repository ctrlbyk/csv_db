<?php

function clean_value($value)
{
    if (strpos($value, "/"))
        return "'" .  date("Y-m-d", strtotime($value)) . "', ";
    else
        return "'" . str_replace("'", "", trim($value)) . "', ";
}

function consolidate($value)
{
    return substr($value, 0, -2) . ")";
}

function create_database($conn, $dbname)
{
    $conn->query("CREATE DATABASE IF NOT EXISTS " . $dbname);
    $conn->query("USE " . $dbname);
    print "Database " . $dbname . " created\n";
}

function create_table($conn, $table, $fieldNames, $primary, $indexs)
{
    $conn->query("DROP TABLE IF EXISTS " . $table);
    $createCommand = "CREATE TABLE " . $table . " (" . $primary . " UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, ";

    /* Get Fields and Index Values */
    $values = "";
    foreach ($fieldNames as $key => $field)
        $values .= $field[1] . ", ";

    foreach (explode(" ", $indexs) as $key)
        $values .= "KEY idx_" . $key . "(" . $key . "), ";

    $conn->query($createCommand . consolidate($values));
    print "\nTable: " . $table . " created.\n";
}

/* MAIN FUNCTION TO INSERT ALL DATA */
function insert_data($conn, $table, $fieldNames, $file_name, $primary = "", $indexs = "")
{
    $time_start = microtime(true);
    if ($primary != "")
        create_table($conn, $table, $fieldNames, $primary, $indexs);

    /* Insert Name Columns */
    $insertCommand = "INSERT INTO " . $table . " (";
    foreach ($fieldNames as $field)
        $insertCommand .= explode(" ", $field[1])[0] . ", ";

    $insertCommand = consolidate($insertCommand) . " VALUES (";

    $exit = 0;
    /* Insert Values */
    $file = fopen($file_name, "r");
    while (($row = fgetcsv($file, null, "~")) !== FALSE) {

        $values = "";
        foreach ($fieldNames as $field)
            $values .= clean_value($row[$field[0]]);

        $conn->query($insertCommand . consolidate($values));

        /* if ($exit == 10)
            break;
        $exit = $exit + 1; */
    }
    fclose($file);
    print "File: " . $file_name . " it's Ok. (" . end_time($time_start) . " mins)\n";
}

function end_time($start)
{
    $time_end = microtime(true);
    return round(($time_end - $start) / 60, 4);
}
