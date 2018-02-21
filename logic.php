<?php

require('MapStore.php');

use TabGeo\MapStore;

$gMapTypes = (isset($_GET['mapType']) ? $_GET['mapType'] : null);
$gRangeYearLower = (isset($_GET['rangeYearLower']) ? sanitize($_GET['rangeYearLower']) : null);
$gRangeYearUpper = (isset($_GET['rangeYearUpper']) ? sanitize($_GET['rangeYearUpper']) : null);
$gRegion = (isset($_GET['region']) ? $_GET['region'] : null);

$gMapStore = new MapStore('maps.json');

$gMapTypes <> null ? $gMapStore->filterByMapType($gMapTypes) : null;
$gRangeYearLower <> null ? $gMapStore->filterByLowerRange($gRangeYearLower) : null;
$gRangeYearUpper <> null ? $gMapStore->filterByUpperRange($gRangeYearUpper) : null;
$gRegion <> null ? $gMapStore->filterByRegion($gRegion) : null;



function isRegionSelected($lRegionName)
{
    global $gRegion;
    $lResult = '';
    if ($gRegion == $lRegionName)
    {
        $lResult = ' SELECTED ';
    }

    return $lResult;
}

function isMapTypeChecked($lMapType)
{
    global $gMapTypes;
    $lResult = '';
    if (isset($gMapTypes))
    {
        if (in_array($lMapType, $gMapTypes))
        {
            $lResult = ' CHECKED ';
        }
    }

    return $lResult;
}

function getResultsCount($allOrFiltered = 'All')
{
    global $gMapStore;
    $result = 0;
    if ($allOrFiltered =='All')
    {
        $result = count($gMapStore->getAll());
    }
        else
    {
        $result = count($gMapStore->getFilteredResults());
    }

    return $result;
}

function sanitize($str)
{
    return htmlentities($str, ENT_QUOTES, "UTF-8");
}

function isInvalid($inputName)
{
    $result = false;
    global $gRangeYearLower;
    global $gRangeYearUpper;

    switch($inputName) {
        case 'rangeYearLower':
            if(!is_numeric($gRangeYearLower))
            {
                if($gRangeYearLower <> '')
                {
                    $result = true;
                }
            }
            break;
        case 'rangeYearUpper':
            if(!is_numeric($gRangeYearUpper))
            {
                if($gRangeYearUpper <> '')
                {
                    $result = true;
                }
            }
            break;
        default:
            $result = false;
    }

    return $result;
}