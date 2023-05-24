<?php

namespace App\Controller;

use App\Repository\IntencaoCompraRepository;
use App\Service\IntencaoCompraService;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class IntencaoCompraController extends AbstractController
{
    #[Route('/intencao/compra', name: 'app_intencao_compra', methods: ['POST'])]
    public function intencaoCompra(Request $request, IntencaoCompraService $compraService): JsonResponse
    {
        $jsonContent = $request->getContent();
        $data = json_decode($jsonContent, true);
        try {
            $compraService->intencaoCompraService($data);
        } catch (Exception $exception) {
            return $this->json(['erro' => $exception]);
        }

        return $this->json([
            'data' => 'compra inserida'
        ]);
    }

    #[Route('/intencao/compra/lista', name: 'app_intencao_compra_lista', methods: ['GET'])]
    public function listaIntecaoCompra(IntencaoCompraRepository $intencaoCompraRepository): JsonResponse
    {
        $data = $intencaoCompraRepository->findByIntencaoCompra();

        return $this->json($data, Response::HTTP_OK,[],
            [AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($obj){return $obj->getId();}]);

    }
}
