<?php
// Create a cron job to run this script to update "merged_rules.json"

// Functions
require_once ("functions.php");

// Rules from external source
$external_rule_url = "https://rules2.clearurls.xyz/data.minify.json";
$external_rule_json = file_get_contents($external_rule_url);

// Extended rules stored in local
$local_rule_filename = "./local_rules.json";
$handle = fopen($local_rule_filename, "r");
$local_rule_json = fread($handle, filesize($local_rule_filename));
fclose($handle);

// Merge rules
$rules_json = json_encode(
    array_merge(
        json_to_providers_array($external_rule_json),
        json_to_providers_array($local_rule_json)
    )
);

// Write to file
$merged_rule_file = fopen("merged_rules.json", "w") or die("Unable to open file!");
fwrite($merged_rule_file, $rules_json);
fclose($merged_rule_file);
