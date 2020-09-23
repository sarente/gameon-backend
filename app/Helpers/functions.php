<?php
function getCategories()
{
    $result = \App\Models\Category::where('type', '=', 'domestic')
        ->groupBy('from_city')
        ->get(['from_city']);

    return $result;
}

// strip out all whitespace
// convert the string to all lowercase
function stripLowercaseName($name_clean)
{
    return strtolower(str_replace(' ', '_', $name_clean));
}

function multi_implode($array, $glue) {
    $ret = '';

    foreach ($array as $key=>$value) {
        if (is_array($value)) {
            $ret .= $key.':'.multi_implode($value, $glue) . $glue;
        } else {
            $ret .= $key.':'.$value . $glue;
        }
    }

    $ret = substr($ret, 0, 0-strlen($glue));

    return $ret;
}
function getByKey($key)
{
    return \App\Models\Setting::where('key', $key)->first()->value ?? null;
}
