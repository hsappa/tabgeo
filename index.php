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
<nav class="site-header sticky-top py-3 px-3 text-light bg-dark" id="navbarHeader">
    <form method='GET' action='index.php'>
        <header class='row'>
            <h6 class="col-sm-4 row">Map Type:
                <label class='mx-1' for='original'>
                    <input type='checkbox'
                           name='mapType[]'
                           id='original'
                           value='original'<?= isMapTypeChecked('original') ?>
                           class='ml-2'>
                    Original
                </label>
                <label class='mx-1' for='reconstruction'>
                    <input type='checkbox'
                           name='mapType[]'
                           id='reconstruction'
                           value='reconstruction'<?= isMapTypeChecked('reconstruction') ?>
                           class='ml-2'>
                    Reconstruction
                </label>
                <label class='mx-1' for='reproduction'>
                    <input type='checkbox'
                           name='mapType[]'
                           id='reproduction'
                           value='reproduction'<?= isMapTypeChecked('reproduction') ?>
                           class='ml-2'>
                    Reproduction
                </label>
            </h6>
            <h6 class="col-sm"><label for='rangeYearLower'>Year Start:</label>
                <input type='text' name='rangeYearLower' id='rangeYearLower' value='<?= $gRangeYearLower ?>'>
            </h6>
            <h6 class="col-sm"><label for='rangeYearUpper'>Year End:</label>
                <input type='text' name='rangeYearUpper' id='rangeYearUpper' value='<?= $gRangeYearUpper ?>'>
            </h6>
            <h6 class="col-sm"><label for='region'>Region</label>
                <select name='region' id='region'>
                    <option value='global'<?= isRegionSelected('global'); ?>>Global</option>
                    <option value='africa'<?= isRegionSelected('africa'); ?>>Africa</option>
                    <option value='asia'<?= isRegionSelected('asia'); ?>>Asia</option>
                    <option value='europe'<?= isRegionSelected('europe'); ?>>Europe</option>
                    <option value='babylon'<?= isRegionSelected('babylon'); ?>>Babylon</option>
                    <option value='egypt'<?= isRegionSelected('egypt'); ?>>Egypt</option>
                    <option value='rome'<?= isRegionSelected('rome'); ?>>Rome</option>
                    <option value='china'<?= isRegionSelected('china'); ?>>China</option>
                </select>
            </h6>
            <h6 class="col-sm">
                <input type='submit' value='Explore' class='btn btn-secondary my-2'>
            </h6>
        </header>
    </form>
</nav>
<main>
    <h1 class='text-center'>Tabula Geographica</h1>
    <p class='text-center'>Use the search bar above to explore the collection of maps</p>
    <article class='album py-5 bg-light'>
        <section class='container'>
<?php $i = 0; ?>
<?php $isTagOpen = True; ?>
<?php foreach ($mapStore->getFilteredResults() as $mapName => $map) : ?>
<?php if ($i % 3 == 0): ?>
<?php $isTagOpen = True; ?>
            <section class='row'>
<?php endif ?>
                <section class='col-sm'>
                    <section class='card mb-4 box-shadow'>
                        <a href='<?= $map['url_map'] ?>'><img src='<?= $map['url_thumb'] ?>'
                                                              alt="Thumbprint of <?= $mapName ?>"
                                                              class='px-3 py-1'></a>
                        <section class='card-body my-0 py-0'>
                            <p class='font-weight-bold my-0 py-0'><?= $mapName ?></p>
                            <p class='my-0 py-0'>Created By: <?= $map['cartographer'] ?></p>
                            <p class='my-0 py-0'>Date: <?= $map['year_create'] ?></p>
                        </section>
                    </section>
                </section>
<?php if ($i % 3 == 2): ?>
            </section>
<?php $isTagOpen = False; ?>
<?php endif ?>
<?php $i++; ?>
<?php endforeach ?>
<?php if ($isTagOpen): ?>
            </section>
<?php endif ?>
        </section>
    </article>
</main>
</body>
</html>