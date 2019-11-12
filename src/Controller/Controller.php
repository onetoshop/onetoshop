<?php
namespace App\Controller;

use App\Entity\Card;
use App\Entity\Categorie;
use App\Entity\File;
use App\Entity\Gegeven;
use App\Form\UploadType;
use App\Repository\GegevenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApplicationHandler;
use Symfony\Component\HttpFoundation\Request;

class Controller extends AbstractController
{
//    home pagina
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $card = $this->getDoctrine()->getRepository(Card::class)->findAll();

        return $this->render('homepage/homepage.html.twig',[
        'cards' => $card
        ]);
    }

//    service pagina
    /**
     * @Route("/service", name="service")
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

    // mogelijkheden pagina
    /**
     * @Route("/mogelijkheden", name="mogelijkheden",)
     */
    public function mogelijkheden()
    {
        return $this->render('mogelijkheden/mogelijkheden.html.twig');
    }

    /**
     * @Route("/functionaliteit/{slug}", name="article_show")
     */
    public function show($slug)
    {
//
        $gegeven = $this->getDoctrine()->getRepository(Gegeven::class)->findOneBy([
            'slug' => $slug
        ]);


        return $this->render('show.html.twig', [
            'gegeven' => $gegeven
        ]);
    }






    // functionaliteit
    /**
     * @Route("/functionaliteit", name="functionaliteit")
     */
    public function functionaliteit()
    {
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        return $this->render('functionaliteit/functionaliteit.html.twig', [
            'namen' => $categorie


        ]);
        
    }

    //categoriefunctionalteit
    /**
     *
     */

    // Gegeven pagina
    /**
     * @Route("/functionaliteit/{slug}", name="article_show")
     */
    public function gegeven($slug) {
//
        $categorie = $this->getDoctrine()->getRepository(Gegeven::class)->Findby([
            'group' => $slug
        ]);



        return $this->render('functionaliteit/klantbeheer.html.twig', [
            'gegevens' => $categorie
        ]);
    }





}
