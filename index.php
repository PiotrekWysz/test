<?php

include 'database.php';

$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$matches = array();

if (preg_match('#article/([0-9]+)#', $requestUrl, $matches)) {
    $controller = new Controller;
    $controller->article($matches[1]);
} else {
    $controller = new Controller;
    $controller->index();
}


class Controller
{


    public function index()
    {
        $db = Database::getInstance();
        $articles = $db->getArray('SELECT a.id,a.title, a.description, c.name
        FROM ((articles as a INNER JOIN article_category as ac ON ac.article_id = a.id)
        INNER JOIN categories as c ON c.id = ac.category_id )');

        foreach($articles as $article) {
            $id = $article['id'];
            $title = $article['title'];
            echo '<a href='.'"http://'.$_SERVER[HTTP_HOST].'/index.php/article/'.$id.'">'.$title.'</a>';
            echo "<br>";
        }

    }

    public function article($number)
    {

        $db = Database::getInstance();
        $articles = $db->getArray('SELECT a.id,a.title, a.description
        FROM articles as a where a.id ='.$number);

        $title = $articles[0]['title'];
        $description = $articles[0]['description'];
        echo 'title: ';
        echo $title;
        echo "<br>";
        echo 'description: ';
        echo $description;
        echo "<br>";
    }

}