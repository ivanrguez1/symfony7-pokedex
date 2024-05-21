<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/aleatorios', name: 'app_aleatorios_')]
class AleatoriosController extends AbstractController
{
    #[Route('/ej1', name: 'aleatorios1')]
    public function index(): Response
    {
        return $this->render('aleatorios/index.html.twig', [
            'controller_name' => 'Mis Aleatorios',
        ]);
    }

    #[Route('/ej2', name: 'aleatorios2')]
    public function index2(): Response
    {
        return $this->render('aleatorios/index.html.twig', [
            'controller_name' => 'Pagina2 Aleatorios',
        ]);
    }


    public function index3(): Response
    {
        return $this->render('aleatorios/index.html.twig', [
            'controller_name' => 'Pagina3 YAML',
        ]);
    }

    #[Route('/ej4/{num1}/{num2}', name: 'aleatorios4')]
    public function index4(int $num1, int $num2): Response
    {
        $aleatorio = rand($num1, $num2);

        return $this->render('aleatorios/index.html.twig', [
            'controller_name' => $aleatorio,
        ]);
    }

    public function index5(int $num1, int $num2): Response
    {
        $aleatorio = rand($num1, $num2);

        return $this->render('aleatorios/index.html.twig', [
            'controller_name' => $aleatorio,
        ]);
    }

    #[Route('/menu-blanca', name: 'menu')]
    public function menu(): Response
    {
        return $this->render('aleatorios/menu.twig', [
            'controller_name' => 'Menu',
        ]);
    }
}
