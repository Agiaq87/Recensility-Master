<?php
/**
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */

echo "ok";
$cats = $A->getCategoriesAvg(ALL);
        print_r($cats);
?>
<div class="recensility-system-body-container">
    <?php $CHARTS->drawCategoriesChart($A->getCategoriesAvg(ALL), $A->getNumOfCategories()); ?>
</div>