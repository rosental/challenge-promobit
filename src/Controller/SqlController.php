<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\EntityRepository\AbstractEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SqlController extends AbstractController
{
    private $abstractEntityRepository;

    public function __construct(AbstractEntityRepository $abstractEntityRepository)
    {
        $this->abstractEntityRepository = $abstractEntityRepository;
    }

    /**
     * @Route("/procedure/first/create", name="create_first_create")
     */
    public function postAction(): JsonResponse
    {
        $firstInsert = $this->abstractEntityRepository->createProcedureFirstInsert();
        return new JsonResponse(["result" => $firstInsert], 200);
    }

    /**
     * @Route("/procedure/first/insert", name="get_first_insert")
     */
    public function getAction()
    {
        $callFirstInsert = $this->abstractEntityRepository->callProcedureFirstInsert();
        return new JsonResponse(["result" => $callFirstInsert], 200);
    }

    /**
     * @Route("/first/user", name="get_first_user")
     */
    public function firstUser( EntityManagerInterface $em,UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $user->setName("Cristiane Rosental");
        $user->setUsername("Rosental");
        $user->setEmail("cristiane.rosental@gmail.com");
        $password = $passwordEncoder->encodePassword($user, "123456");
        $user->setPassword($password);
        $user->setImage('23d38a7a67e705b154f803df50f58f08.jpg');
        $user->setRoles("ROLE_ADMIN");

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('login');
    }
}
