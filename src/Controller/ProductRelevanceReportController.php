<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductRelevanceReportController extends AbstractController
{
    /**
     * @Route("/admin/products/report", name="report")
     */
    public function report(EntityManagerInterface $em ,TagRepository $tagRepository)
    {
        $tags = $tagRepository->findAll();

        return $this->render('product_relevance_report/index.html.twig', compact('tags'));
    }

}
