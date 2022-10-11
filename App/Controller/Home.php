<?php
namespace App\Controller;

use App\Model\Article;

class Home
{
    public function indexAction()
    {
       /* // you could add the twig package 'composer require "twig/twig:^2.0"'
        // and use it as "echo $twig->render('index', ['name' => 'Fabien']);"
        $allArticle = Article::all();
        echo $tw
        $gaga = json_decode(json_encode(Article::all()), true);
         var_dump($gaga);
       // echo 'Hello World';
    }*/

    try {
        // le dossier ou on trouve les templates
        $loader = new Twig\Loader\FilesystemLoader('templates');
    
        // initialiser l'environement Twig
        $twig = new Twig\Environment($loader);
    
        // load template
        $template = $twig->load('Menu.html');
    
        // set template variables
        // render template
        echo $template->render(array(
            'lundi' => 'Steak Frites',
            'mardi' => 'Raviolis',
            'mercredi' => 'Pot au Feu',
            'jeudi' => 'Couscous',
            'vendredi' => 'Poisson',
        ));
    
    } catch (Exception $e) {
        die ('ERROR: ' . $e->getMessage());
    }
    
    
}
