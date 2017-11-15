<?php

$csvs = array_map('str_getcsv', file('products.csv'));

$row = 1;
if (($uchwyt = fopen ("products.csv","r")) !== FALSE) {
while (($data = fgetcsv($uchwyt, 1000, ",")) !== FALSE)  {
    $num = count($data);
    echo "<p> $num pól w lini $row: <br /></p>\n";
    $row++;
    for ($c=1; $c < $num; $c++) {
    echo $data[$c] . "<br />\n";
    $tab = explode(";",$data[$c]);
    echo "INSERT INTO products (long_title, title, description, ean, tags, image_id, crteated_at, updated_at)
    VALUES ($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8]) ";

    }
}
fclose ($uchwyt);
}
