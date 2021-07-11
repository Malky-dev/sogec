<?php

namespace App\Controller;

use App\Repository\CitationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CitationController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @IsGranted("ROLE_USER")
     */
    public function index(CitationRepository $citationRepository): Response
    {
        return $this->render('citation/index.html.twig', [
            'controller_name' => 'CitationController',
            'citations' => $citationRepository->findAll()
        ]);
    }
    
    /**
     * Undocumented function
     * @Route("/citation/{id}", name="app_citation")
     * @IsGranted("ROLE_USER")
     * @param [type] $id
     * @param CitationRepository $citationRepository
     * @return Response
     */
    public function show(CitationRepository $citationRepository, $id): Response
    {
        $citation = $citationRepository->findOneById($id);

        return $this->render('citation/show.html.twig', [
            'controller_name' => 'CitationController',
            'citation' => $citation,
        ]);
    }
}
