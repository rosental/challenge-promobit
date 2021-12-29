<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/tags", name="admin_tags_")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * Security("is_granted('ROLE_ADMIN')")
     * IsGranted("ROLE_USER")
     */
    public function index(TagRepository $tagRepository)
    {
        //$this->denyAccessUnlessGranted('ROLE_USER');

        $tags = $tagRepository->findAll();
//        dump($tags);die;

        return $this->render('tag/index.html.twig', compact('tags'));
    }

    /**
     * @Route("/rrp", name="rrp")
     * Security("is_granted('ROLE_ADMIN')")
     * IsGranted("ROLE_USER")
     */
    public function relatorio(TagRepository $tagRepository)
    {
        //$this->denyAccessUnlessGranted('ROLE_USER');

        $sql = $this->createQueryBuilder('s')
            ->select('SUM(s.expenses) AS total')
            ->groupBy('s.keyval')
        ;

//        return $sql->getQuery()->**getSingleScalarResult**();


        return $this->render('tag/index.html.twig', compact('tags'));
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TagType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $tag = $form->getData();

            $tag->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));


            $em->persist($tag);
            $em->flush();

            $this->addFlash('success', 'Produto criado com sucesso!');

            return $this->redirectToRoute('admin_tags_index');
        }

        return $this->render('tag/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{tag}", name="edit")
     */
    public function edit(Tag $tag, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $tag = $form->getData();

            $em->flush();

            $this->addFlash('success', 'Produto atualizado com sucesso!');

            return $this->redirectToRoute('admin_tags_edit', ['tag' => $tag->getId()]);
        }

        return $this->render('tag/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remove/{tag}", name="remove")
     */
    public function remove(Tag $tag)
    {
        try{
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($tag);
            $manager->flush();

            $this->addFlash('success', 'Produto removido com sucesso!');

            return $this->redirectToRoute('admin_tags_index');

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}