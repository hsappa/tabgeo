<?php
require 'logic.php';
?>
<!DOCTYPE html>
<html lang='en-US'>
<head>
    <meta charset='utf-8'>
    <title>Tabula Geographica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
</head>
<body>
<article class="site-header sticky-top py-3 px-3 text-light bg-dark" id="navbarHeader">
    <h5 class='row'>Search by</h5>
    <form method='GET' action='index.php' class='row'>
            <section class="col-sm-4 row"><h6>MapType:</h6>
                <label class='checkbox mx-1' for='original'>
                    <input type='checkbox'
                           name='mapType[]'
                           id='original'
                           value='original'<?= isMapTypeChecked('original') ?>
                           class='ml-2'>
                    Original
                </label>
                <label class='checkbox mx-1' for='reconstruction'>
                    <input type='checkbox'
                           name='mapType[]'
                           id='reconstruction'
                           value='reconstruction'<?= isMapTypeChecked('reconstruction') ?>
                           class='ml-2'>
                    Reconstruction
                </label>
                <label class='checkbox mx-1' for='reproduction'>
                    <input type='checkbox'
                           name='mapType[]'
                           id='reproduction'
                           value='reproduction'<?= isMapTypeChecked('reproduction') ?>
                           class='ml-2'>
                    Reproduction
                </label>
            </section>
            <section class="col-sm form-group"><h6><label for='rangeYearLower'>Year Start:</label></h6>
                <input type='text' name='rangeYearLower' id='rangeYearLower'
                    class='form-control<?php if(isInvalid('rangeYearLower')): ?> is-invalid<?php endif ?>'
                    value='<?= $gRangeYearLower ?>'>
                <?php if(isInvalid('rangeYearLower')): ?>
                    <p class="invalid-feedback">
                        Must be a number.
                    </p>
                <?php endif ?>
            </section>
            <section class="col-sm form-group"><h6><label for='rangeYearUpper'>Year End:</label></h6>
                <input type='text' name='rangeYearUpper' id='rangeYearUpper'
                    class='form-control<?php if(isInvalid('rangeYearUpper')): ?> is-invalid<?php endif ?>'
                    value='<?= $gRangeYearUpper ?>'>
                <?php if(isInvalid('rangeYearUpper')): ?>
                    <p class="invalid-feedback">
                        Must be a number.
                    </p>
                <?php endif ?>
            </section>
            <section class="form-group col-sm"><h6><label for='region'>Region</label></h6>
                <select name='region' id='region' class="form-control">
                    <option value='global'<?= isRegionSelected('global'); ?>>Global</option>
                    <option value='africa'<?= isRegionSelected('africa'); ?>>Africa</option>
                    <option value='asia'<?= isRegionSelected('asia'); ?>>Asia</option>
                    <option value='europe'<?= isRegionSelected('europe'); ?>>Europe</option>
                    <option value='babylon'<?= isRegionSelected('babylon'); ?>>Babylon</option>
                    <option value='egypt'<?= isRegionSelected('egypt'); ?>>Egypt</option>
                    <option value='rome'<?= isRegionSelected('rome'); ?>>Rome</option>
                    <option value='china'<?= isRegionSelected('china'); ?>>China</option>
                </select>
            </section>
            <section class="col-sm">
                <h6 class='align-bottom'>
                    <button type="submit" class="btn btn-secondary align-bottom">Submit</button>
                </h6>
            </section>

    </form>
</article>
<main>
    <h1 class='text-center'>Tabula Geographica</h1>
    <p class='text-center'>Use the search bar above to explore the collection of maps</p>
    <article class='album bg-light'>
        <h6 class='text-center pb-3 pt-3'>
            Showing <?= getResultsCount('Filtered'); ?> maps from our collection of <?= getResultsCount('All'); ?> ancient maps.
        </h6>
        <div class='container'>
            <?php $i = 0; ?>
            <?php $isTagOpen = true; ?>
            <?php foreach ($gMapStore->getFilteredResults() as $mapName => $map) : ?>
                <?php if ($i % 3 == 0): ?>
                    <?php $isTagOpen = true; ?>
                    <div class='row'>
                <?php endif ?>
                <div class='col-sm'>
                    <article class='card mb-4 box-shadow'>
                        <h6 class='font-weight-bold my-0 pt-2 px-3'><?= $mapName ?></h6>
                        <a href='<?= $map['url_map'] ?>'><img src='<?= $map['url_thumb'] ?>'
                                                              alt="Thumbprint of <?= $mapName ?>"
                                                              class='px-3 py-1'></a>
                        <div class='card-body my-0 py-0'>

                            <p class='my-0 py-0'>Created By: <?= $map['cartographer'] ?></p>
                            <p class='my-0 py-0'>Date: <?= $map['year_create'] ?></p>
                        </div>
                    </article>
                </div>
                <?php if ($i % 3 == 2): ?>
                    </div>
                    <?php $isTagOpen = false; ?>
                <?php endif ?>
                <?php $i++; ?>
            <?php endforeach ?>
            <?php if ($isTagOpen): ?>
                </div>
            <?php endif ?>
        </div>
    </article>
</main>
</body>
</html>