<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Entity\Pokemons;
use App\Repository\PokemonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Json;

#[Route('/pokemons', name: 'app_pokemons_')]
class PokemonsController extends AbstractController
{
    // Plantilla para métodos
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('pokemons/index.html.twig', [
            'controller_name' => 'PokemonsController',
        ]);
    }

    // 04. Inserción 1 registro con parámetros y FK
    #[Route(
        '/insertar/{cat}/{nombre}/{altura}/{peso}/{sexo}',
        name: 'insertarParams'
    )]
    public function insertarParams(
        int $cat,
        string $nombre,
        int $altura,
        float $peso,
        bool $sexo,
        ManagerRegistry $doctrine
    ): Response {
        $gestorEntidades = $doctrine->getManager();

        $pokemon = new Pokemons;
        $pokemon->setNombre($nombre);
        $pokemon->setAltura($altura);
        $pokemon->setPeso($peso);
        $pokemon->setSexo($sexo);

        // Gentileza Juan Carlos ;)
        // Para claves foráneas, se introduce el objeto ENTERO
        $categoria = new Categorias();
        // Obtengo el repo de categorias
        $repoCategorias =
            $gestorEntidades->getRepository(Categorias::class);
        // Saco el objeto categoria completo
        $categoria = $repoCategorias->find($cat);
        $pokemon->setIdCategoria($categoria);

        $gestorEntidades->persist($pokemon);
        $gestorEntidades->flush();

        return new Response("Pokemon insertado con ID: "
            . $pokemon->getId());
    }

    // 05. Consulta completa (findAll)
    #[Route('/verPokemons', name: 'verpokemons')]
    public function verPokemons(EntityManagerInterface $gestorEntidades): Response
    {
        $repoPokemons = $gestorEntidades->getRepository(Pokemons::class);
        $pokemons = $repoPokemons->findAll();

        return $this->render('pokemons/index.html.twig', [
            'controller_name' => 'PokemonsController',
            'Bichos' => $pokemons,
        ]);
    }

    // 06. Consulta completa, salida array JSON
    #[Route('/verPokemonsJSON', name: 'verpokemonsjson')]
    public function verPokemonsJSON(PokemonsRepository $repoPokemons): Response
    {
        $pokemons = $repoPokemons->findAll();
        $datos = [];
        foreach ($pokemons as $pokemon) {
            $datos[] = [
                "idPokemon" => $pokemon->getId(),
                "nombre" => $pokemon->getNombre(),
                "altura" => $pokemon->getAltura(),
                "peso" => $pokemon->getPeso(),
                "sexo" => $pokemon->isSexo(),
                "categoria" => $pokemon->getIdCategoria()->getCategoria()
            ];
        }

        return new JsonResponse($datos);
    }


    // 07. Consulta por parámetro, salida array JSON
    #[Route('/verPokemonsJSON/{sexo}', name: 'verpokemonsjsonparam')]
    public function verPokemonsJSONParam(PokemonsRepository $repoPokemons, bool $sexo): Response
    {
        // Consultar pokemons por sexo
        $pokemons = $repoPokemons->findBy(["sexo" => $sexo,]);

        $datos = [];
        foreach ($pokemons as $pokemon) {
            $datos[] = [
                "idPokemon" => $pokemon->getId(),
                "nombre" => $pokemon->getNombre(),
                "altura" => $pokemon->getAltura(),
                "peso" => $pokemon->getPeso(),
                "sexo" => $pokemon->isSexo(),
                "categoria" => $pokemon->getIdCategoria()->getCategoria()
            ];
        }

        //return new JsonResponse($datos);
        return $this->json($datos);
    }

    // 08. Consulta por parámetro y ordenación, salida array JSON
    #[Route('/verPokemonsOrdenadosJSON/{sexo}', 
        name: 'verpokemonsOrdenadosjsonparam')]
    public function verPokemonsOrdenadosJSONParam
    (PokemonsRepository $repoPokemons, bool $sexo): Response
    {
        // Consultar pokemons por sexo
        // Y ordenarlos por altura de mayor a menor
        $pokemons = 
            $repoPokemons->findBy(
                ["sexo" => $sexo,],["altura" => "DESC"]);

        $datos = [];
        foreach ($pokemons as $pokemon) {
            $datos[] = [
                "idPokemon" => $pokemon->getId(),
                "nombre" => $pokemon->getNombre(),
                "altura" => $pokemon->getAltura(),
                "peso" => $pokemon->getPeso(),
                "sexo" => $pokemon->isSexo(),
                "categoria" => $pokemon->getIdCategoria()->getCategoria()
            ];
        }

        //return new JsonResponse($datos);
        return $this->json($datos);
    }
}
