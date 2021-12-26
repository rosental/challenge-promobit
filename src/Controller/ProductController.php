<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/products", name="admin_products_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * Security("is_granted('ROLE_ADMIN')")
     * IsGranted("ROLE_USER")
     */
    public function index(ProductRepository $productRepository)
    {
        //$this->denyAccessUnlessGranted('ROLE_USER');

        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', compact('products'));
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ProductType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();

            $product->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Produto criado com sucesso!');

            return $this->redirectToRoute('admin_products_index');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{product}", name="edit")
     */
    public function edit(Product $product, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();

            $em->flush();

            $this->addFlash('success', 'Produto atualizado com sucesso!');

            return $this->redirectToRoute('admin_products_edit', ['product' => $product->getId()]);
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remove/{product}", name="remove")
     */
    public function remove(Product $product)
    {
        try{
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($product);
            $manager->flush();

            $this->addFlash('success', 'Produto removido com sucesso!');

            return $this->redirectToRoute('admin_products_index');

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}