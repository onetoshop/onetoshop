<?php
namespace App\Controller;
use App\Entity\Gegeven;
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

    /**
     * @Route("/functionaliteit/{slug}", name="article_show")
     */
    public function show($slug)
    {
//
        $gegeven = $this->getDoctrine()->getRepository(gegeven::class)->findOneBy([
            'slug' => $slug
        ]);


        return $this->render('show.html.twig', [
            'gegevens' => $gegeven
        ]);
    }



// functionaliteit

    /**
     * @Route("/functionaliteit", name="functionaliteit",)
     */
    public function index() {
        $gegeven = $this->getDoctrine()->getRepository(gegeven::class)->findAll();

        return $this->render('functionaliteit/functionaliteit.html.twig', [
            'gegevens' => $gegeven
        ]);
    }
}