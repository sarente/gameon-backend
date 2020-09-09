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
