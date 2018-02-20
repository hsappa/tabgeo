<?php

require('MapStore.php');
use TabGeo\MapStore;

$gMapTypes = (isset($_GET['mapType']) ? $_GET['mapType'] : null);
$gRangeYearLower = (isset($_GET['rangeYearLower']) ? $_GET['rangeYearLower'] : null);
$gRangeYearUpper = (isset($_GET['rangeYearUpper']) ? $_GET['rangeYearUpper'] : null);
$gRegion = (isset($_GET['region']) ? $_GET['region'] : null);

$mapStore = new MapStore('maps.json');

$gMapTypes<>null?$mapStore->filterByMapType($gMapTypes):null;
$gRangeYearLower<>null?$mapStore->filterByLowerRange($gRangeYearLower):null;
$gRangeYearUpper<>null?$mapStore->filterByUpperRange($gRangeYearUpper):null;
$gRegion<>null?$mapStore->filterByRegion($gRegion):null;


function isRegionSelected($lRegionName)
{
   global $gRegion;
   $lResult = '';
   if ($gRegion == $lRegionName) {
      $lResult = ' SELECTED ';
   }

   return $lResult;
}

function isMapTypeChecked($lMapType)
{
   global $gMapTypes;
   $lResult = '';
   if(isset($gMapTypes)) {
      if (in_array($lMapType, $gMapTypes)) {
         $lResult = ' CHECKED ';
      }
   }

   return $lResult;
}

