<?php

function remove_url_get_var($url, $var_name) {
    return preg_replace('/([?&])'.$var_name.'=[^&]+(&|$)/','$1',$url);
}

function json_to_providers_array($json) {
    $rules_obj = json_decode($json, FILE_USE_INCLUDE_PATH);
    $providers_array = $rules_obj['providers'];
    return $providers_array;
}

function clean_url($url) {
    // Validate URL
    if (
        !isset($url) ||
        (
            !filter_var($url, FILTER_VALIDATE_URL) &&
            !filter_var(base64_decode($url), FILTER_VALIDATE_URL)
        )
    )
    {
        $API_Obj = new stdClass();
        $API_Obj->original_url = $url;
        $API_Obj->cleaned_url = "Error: Invalid URL provided.";
        $result = json_encode($API_Obj);
        echo $result;
        exit;
    }

    // Decode if it's base64 URL
    if (filter_var(base64_decode($url), FILTER_VALIDATE_URL)) {
        $url = base64_decode($url);
    }

    // Get merged rules stored in local
    $merged_rule_filename = "./merged_rules.json";
    $handle = fopen($merged_rule_filename, "r");
    $rules_json = fread($handle, filesize($merged_rule_filename));
    fclose($handle);

    // Clean blacklisted variables in URL
    $providers_array = json_decode($rules_json, FILE_USE_INCLUDE_PATH);
    foreach($providers_array as $provider) {
        $pattern = "/" . $provider['urlPattern'] . "/";
        if (preg_match($pattern, $url)) {
            $rules = $provider['rules'];
            foreach($rules as $rule) {
                $url = remove_url_get_var($url, $rule);
            }
        }
    }

    return $url;
}