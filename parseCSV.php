<?php

$csv = array_map('str_getcsv', file('products.csv'));


var_dump($csv);
die();