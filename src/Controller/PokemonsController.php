<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Entity\Pokemons;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pokemons', name: 'app_pokemons_')]
class PokemonsController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('pokemons/index.html.twig', [
            'controller_name' => 'PokemonsController',
        ]);
    }

    #[Route('/insertar/{cat}/{nombre}/{altura}/{peso}/{sexo}', 
    name: 'insertarParams')]
    public function insertarParams(int $cat, string $nombre,
    int $altura, float $peso, bool $sexo, 
    ManagerRegistry $doctrine): Response
    {
        $gestorEntidades = $doctrine->getManager();

        $pokemon = new Pokemons();
        $pokemon->setNombre($nombre);
        $pokemon->setAltura($altura);
        $pokemon->setPeso($peso);   
        $pokemon->setSexo($sexo);

        // Gentileza Juan Carlos ;)
        $categoria = new Categorias();
        


        return $this->render('pokemons/index.html.twig', [
            'controller_name' => 'PokemonsController',
        ]);
    }
}
