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



//// functionaliteit fout
//
//    /**
//     * @Route("/", name="",)
//     */
//    public function index() {
//        $gegeven = $this->getDoctrine()->getRepository(gegeven::class)->findAll();
//
//        return $this->render('functionaliteit/.html.twig', [
//            'gegevens' => $gegevenfff
//        ]);
//    }


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
     * @Route("{slug}", name="article_show")
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


    public function groupquery()
    {
        $result = $em->getRepository(gegeven::class)->createQueryBuilder('g')
            ->where('g.group = :klantbeheer')
//            ->andWhere('o.Product LIKE :product')
//            ->setParameter('email', 'some@mail.com')
//            ->setParameter('product', 'My Products%')
            ->getQuery()
            ->getResult();

    }


}
