<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
//    home pagina
    /**
     * @Route("/", name="homepage",)
     */
    public function homepage()
    {
        return $this->render('homepage/homepage.html.twig');
    }

//    service pagina
    /**
     * @Route("/service", name="service",)
     */
    public function service()
    {
        return $this->render('service/service.html.twig');
    }

// contact pagina
    /**
     * @Route("/contact", name="contact",)
     */
    public function contact()
    {
        return $this->render('contact/contact.html.twig');
    }
}