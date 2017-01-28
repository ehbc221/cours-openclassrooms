<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    /*
        addAction
     */
    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :
        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            // Puis on redirige vers la page de visualisation de cette annonce
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }
    /*
        deleteAction
     */
    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

            // Ici, on gérera la suppression de l'annonce en question

            return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }
    /*
        editAction
     */
    public function editAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        /*
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }
    */

        $advert = array(
            'title' => 'Recherche developpeur Symfony',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. BlaBlaBla ...',
            'date' => new \Datetime()
        );

        return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert
        ));
    }
    /*
        indexAction
     */
    public function indexAction($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Notre liste en dur
    $listAdverts = array(
        array(
            'title'   => 'Recherche développpeur Symfony',
            'id'      => 1,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()),
        array(
            'title'   => 'Mission de webmaster',
            'id'      => 2,
            'author'  => 'Hugo',
            'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
            'date'    => new \Datetime()),
        array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime())
    );

        // Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
    /*
        menuAction
     */
    public function menuAction($limit)
    {
        // On préfixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la base de données
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'MIssion de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            // Tout l'intéret est ici, le controlleur passe
            // les variables nécessaires au template
            'listAdverts' => $listAdverts
        ));
    }
    /*
        viewAction
     */
    public function viewAction($id)
    {
        $advert = array(
            'title' => 'Recherche développeur Symfony 2',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony 2 débutant sur Lyon. bla bla bla ...',
            'date' => new \Datetime()
        );

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
                'advert' => $advert
            ));
    }
}
