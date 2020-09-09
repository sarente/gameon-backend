<?php
function getCategories()
{
    $result = \App\Models\Category::where('type', '=', 'domestic')
        ->groupBy('from_city')
        ->get(['from_city']);

    return $result;
}
