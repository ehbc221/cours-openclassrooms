<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
	public function addAction(Request $request)
	{
		// Création de l'entité
		$advert = new Advert();
		$advert->setTitle('Recherche développeur Symfony');
		$advert->setAuthor('Alexandre');
		$advert->setContent('Nous recherchons un développeur Symfony débutant sur Lyon. BlaBlaBla...');
		// On peut ne pas définir ni la date, ni la publication,
		// car ces attributs sont défiis automatiquement dans le controlleur

		// On récupère l'EntityManager
		$em = $this->getDoctrine()->getManager();

		// Etape 1 : On « persiste » l'entité
		$em->persist($advert);

		// Etape 2 : On « flush » tout ce qui a été persisté avant
		$em->flush();

		// Reste de la méthode qu'on avait déjà écrit
		if ($request->isMethod('POST')) {
			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

			// Puis on redirige vers la page de visualisation de cette annonce
			return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));
		}

		// Si on n'est pas en POST, alors on affiche le formulaire
		return $this->render('OCPlatformBundle:Advert:add.html.twig');
	}
	public function deleteAction($id)
	{
		return $this->render('OCPlatformBundle:Advert:delete.html.twig');
	}
	public function editAction($id, Request $request)
	{
		if ($request->isMethod('POST')) {
			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

			return $this->redirectToRoute('oc_platform_view', array('id' => 5));
		}
		$advert = array(
			'title'   => 'Recherche développpeur Symfony',
			'id'      => $id,
			'author'  => 'Alexandre',
			'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
			'date'    => new \Datetime()
		);
		return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
			'advert' => $advert
		));
	}
	public function indexAction($page)
	{
		// Vérifier qu'il a saisi un argument de page valide
		if ($page < 1) {
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}

		// Notre liste d'annonce en dur
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

		// Retouner la liste de nos annonces dans notre vue index
		return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
			'listAdverts' => $listAdverts,
		));
	}
	public function menuAction($limit)
	{
		// On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
		$listAdverts = array(
			array('id' => 2, 'title' => 'Recherche développeur Symfony'),
			array('id' => 5, 'title' => 'Mission de webmaster'),
			array('id' => 9, 'title' => 'Offre de stage webdesigner')
		);

		// Retourner la vue correspondant au menu
		return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
			// Tout l'intérêt est ici : le contrôleur passe les variables nécessaires au template !
			'listAdverts' => $listAdverts
		));
	}
	public function viewAction($id)
	{
		// On récupère le repository
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('OCPlatformBundle:Advert')
		;

		// On récupère l'entité correspondant à l'id $id
		$advert = $repository->find($id);

		// $advert est donc une instance de OC\PlatformBundle\Entity\Advert
		// ou null si l'id $id n'extiste pas, d'où ce if :
		if (null === $advert) {
			throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
		}

		// Le render ne change pas, on passait avant un tableau, maintenant un objet
		return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
			'advert' => $advert
		));
	}
}
