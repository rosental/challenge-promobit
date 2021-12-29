<?php

namespace App\Controller;


use App\Repository\EntityRepository\AbstractEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

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
}
