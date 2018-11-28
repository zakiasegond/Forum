<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentairesController extends AbstractController
{
    /**
     * @Route("/commentaires", name="commentaires")
     */

    

  
    public function index()
    {
       	$commentaire = $this->getDoctrine()
      	->getRepository('App:Commentaires')
      	->findall();        

      	return $this->render('commentaires/index.html.twig', [
          'commentaires' => $commentaire,
        ]);
    }


}
