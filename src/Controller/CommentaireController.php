<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $comment = new Commentaire();

        $form = $this->createForm(CommentaireType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash(
                "success",
                "le commentaire a bien été posté"
            );

            return $this->redirectToRoute("app_citation", ["id"=> $comment->getId()]);
        }

        return $this->render('commentaire/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
