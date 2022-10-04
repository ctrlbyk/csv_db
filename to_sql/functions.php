<?php

function clean_value($value)
{
    if (strpos($value, "/"))
        return "'" .  date("Y-m-d", strtotime($value)) . "', ";
    else
        return "'" . str_replace("'", "", trim($value)) . "', ";
}

function consolidate($value, $end = ",")
{
    return substr($value, 0, -2) . ")" . $end;
}

function create_database($file, $dbname)
{
    $createCommand = "-- Create database " . $dbname . "\n";
    $createCommand .= "CREATE DATABASE IF NOT EXISTS " . $dbname . ";\n";
    $createCommand .= "USE " . $dbname . ";\n\n";

    fwrite($file, $createCommand);
}

function create_table($file, $table, $fieldNames, $primary, $indexs)
{
    $createCommand = "-- Table structure for table " . $table . "\n";
    $createCommand .= "DROP TABLE IF EXISTS " . $table . ";\n";
    $createCommand .= "CREATE TABLE " . $table . " (\n" . $primary . " UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,\n";

    /* Get Fields and Index Values */
    $values = "";
    foreach ($fieldNames as $key => $field)
        $values .= $field[1] . ",\n";

    foreach (explode(" ", $indexs) as $key)
        $values .= "KEY idx_" . $key . "(" . $key . "),\n";

    fwrite($file, $createCommand . consolidate($values, ";") . "\n\n");
}

/* MAIN FUNCTION TO INSERT ALL DATA */
function insert_data($file, $table, $fieldNames, $file_name, $primary = "", $indexs = "")
{
    $time_start = microtime(true);

    if ($primary != "")
        create_table($file, $table, $fieldNames, $primary, $indexs);

    fwrite($file, "-- Dumping data for table " . $table . "\n");
    fwrite($file, "LOCK TABLES " . $table . " WRITE;\n");

    /* Insert Name Columns */
    $insertCommand = "INSERT INTO " . $table . " (";

    foreach ($fieldNames as $field)
        $insertCommand .= explode(" ", $field[1])[0] . ", ";

    $insertCommand = consolidate($insertCommand, "") . " VALUES ";
    fwrite($file, $insertCommand);

    $exit = 0;
    $file_csv = fopen($file_name, "r");
    $line = "";
    while (($row = fgetcsv($file_csv, null, "~")) !== FALSE) {

        $values = "(";
        foreach ($fieldNames as $field)
            $values .= clean_value($row[$field[0]]);

        $line .= consolidate($values);

        if ($exit == 50)
            break;
        $exit = $exit + 1;
    }

    fwrite($file, consolidate($line, ";"));
    fwrite($file, "\nUNLOCK TABLES;\n\n");
    print "File: " . $file_name . " it's Ok. (" . end_time($time_start) . " mins)\n";
}

function end_time($start)
{
    $time_end = microtime(true);
    return round(($time_end - $start) / 60, 4);
}
