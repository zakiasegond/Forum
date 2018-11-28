<?php

namespace App\Controller;

use App\Entity\Commentaires;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index()
    {
    	$article = $this->getDoctrine()
      	->getRepository('App:Articles')
      	->findall();  

      	$commentaire = $this->getDoctrine()
      	->getRepository('App:Commentaires')
      	->findall(); 

    	$comment = new Commentaires();

    	$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $comment);

   
    	$formBuilder
	      ->add('pseudo',    TextType::class)
	      ->add('avis',      TextareaType::class)
	      ->add('Envoyer',   SubmitType::class)
    	  ->getForm(); 

        // Si la requête est en POST

    if ($re->isMethod('POST')) {
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
      $form->handleRequest($re);

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->isValid()) {
        // On enregistre notre objet $advert dans la base de données, par exemple
        $commentaire = $this->getDoctrine()->getManager();
        $commentaire->persist($comment);
        $commentaire->flush();
        $re->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('oc_platform_view', array('id' => $comment->getId()));

      }


      	return $this->render('articles/index.html.twig', [
          'articles' => $article,
          'commentaires' => $commentaire,
          'form' => $form->createView()
        ]);
    }            
    }
}





      	