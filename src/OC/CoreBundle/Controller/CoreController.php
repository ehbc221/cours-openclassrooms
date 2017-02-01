<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CoreController extends Controller
{
	public function contactAction(Request $request)
	{
		$request->getSession()->getFlashBag()->add('info', 'La page de contact n’est pas encore disponible, merci de revenir plus tard.');
		return $this->redirectToRoute('oc_core_homepage');
	}

	public function indexAction()
	{
		// Ici, vu qu'on n'a pas encore de base de données, les 3 dernières annonces ont été saisies à la main
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
		return $this->render('OCCoreBundle:Core:index.html.twig', array(
			'listAdverts' => $listAdverts
		));
	}
}
