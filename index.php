<?php
require 'logic.php';
?>
<!doctype html>
<html lang='en'>
<head>
   <title>Tabula Geographica</title>
   <meta charset='utf-8'>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet"
         href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
         integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
         crossorigin="anonymous">
</head>
<body>
<nav class="site-header sticky-top py-3 px-3 text-light bg-dark" id="navbarHeader" >
   <form method='GET' action='index.php'>
      <p class='row'>
         <label class="col-sm-4">Map Type:<BR>
            <input type='checkbox'
                   name='mapType[]'
                   id='mapType'
                   value='original'<?= isMapTypeChecked('original') ?>> Original
            <input type='checkbox'
                   name='mapType[]'
                   id='mapType'
                   value='reconstruction'<?= isMapTypeChecked('reconstruction') ?>> Reconstruction
            <input type='checkbox'
                   name='mapType[]'
                   id='mapType'
                   value='reproduction'<?= isMapTypeChecked('reproduction') ?>> Reproduction
         </label>
         <label class="col-sm">Year Start:
            <input type='text' name='rangeYearLower' id='rangeYearLower' value='<?= $gRangeYearLower ?>'>
         </label>
         <label class="col-sm">Year End:
            <input type='text' name='rangeYearUpper' id='rangeYearUpper' value='<?= $gRangeYearUpper ?>'>
         </label>
         <label class="col-sm">Region<BR>
            <select name='region'>
               <option value='global'<?= isRegionSelected('global'); ?>>Global</option>
               <option value='africa'<?= isRegionSelected('africa'); ?>>Africa</option>
               <option value='asia'<?= isRegionSelected('asia'); ?>>Asia</option>
               <option value='europe'<?= isRegionSelected('europe'); ?>>Europe</option>
               <option value='babylon'<?= isRegionSelected('babylon'); ?>>Babylon</option>
               <option value='egypt'<?= isRegionSelected('egypt'); ?>>Egypt</option>
               <option value='rome'<?= isRegionSelected('rome'); ?>>Rome</option>
            </select>
         </label>
         <label class="col-sm">
            <input type='submit' value='Explore' class='btn btn-secondary my-2'>
         <label>
      </p>
   </form>
</nav>

<main role='main'>
<h1 class='text-center'>Tabula Geographica</h1>
<p class='text-center'>Use the search bar above to explore the collection of maps</p>
</main>
<div class='album py-5 bg-light'>
   <div class='container'>
<?php $i = 0; ?>
<?php foreach($mapStore->getFilteredResults() as $mapName => $map) : ?>
<?php if($i%3==0): ?>
      <div class='row'>
<?php endif?>
         <div class='col-sm'>
            <div class='card mb-4 box-shadow'>
               <a href='<?=$map['url_map'] ?>'><img src='<?=$map['url_thumb'] ?>' alt='Thumbprint of <?=$mapName ?>' class='px-3 py-1'></a>
               <div class='card-body my-0 py-0'>
                  <p class='font-weight-bold my-0 py-0'><?=$mapName?></p>
                  <p class='my-0 py-0'>Created By: <?=$map['cartographer']?></p>
                  <p class='my-0 py-0'>Date: <?=$map['year_create']?></p>
               </div>
            </div>
         </div>
<?php if($i%3==2): ?>
      </div>
<?php endif?>
<?php $i++; ?>
<?php endforeach ?>
<?php if($i>0 and $i%3<>0): ?>
      </div>
<?php endif ?>
   </div>
</div>
</body>
</html>