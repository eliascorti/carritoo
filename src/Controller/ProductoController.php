<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductoController extends AbstractController
{
    #[Route('/', name: 'listar_productos')]
    public function listarProductos(ProductoRepository $productoRepository): Response
    {
        return $this->render('producto/lista.html.twig', [
            'productos' => $productoRepository->findAll(),
        ]);
    }
}
