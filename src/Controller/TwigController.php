<?php

namespace App\Controller;

use Joomla\Plugin\Schemaorg\Person\Extension\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Defino una clase persona (da igual que esté en el controlador)
class Persona {
    public String $nombre;
    public int $edad;
    public bool $sexo;

    public function __construct(string $nombre, int $edad, bool $sexo)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->sexo = $sexo;
    }
}

class TwigController extends AbstractController
{
    #[Route('/twig/{nombre}/{edad}/{sexo}', name: 'app_twig')]
    // Ej: localhost:8000/twig/Iván Rodríguez Ruiz/47/0
    // Ej2: localhost:8000/twig/Blanca Soler/25/1
    public function index(string $nombre, int $edad, bool $sexo): Response
    {
        // Creamos un objeto persona
        $persona = new Persona($nombre, $edad, $sexo);

        return $this->render('twig/index.html.twig', [
            'controller_name' => 'TwigController',
            "TwigPersona" => $persona,
        ]);
    }
}
