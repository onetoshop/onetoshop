<?php
namespace App\Controller;

use App\Entity\Aanmeld;
use App\Entity\Aanmelding;
use App\Entity\Blog;
use App\Entity\Card;
use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\File;
use App\Entity\Gegeven;
use App\Form\AanmeldType;
use App\Form\CardType;
use App\Form\ContactType;
use App\Form\UploadType;
use App\Repository\GegevenRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApplicationHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Controller extends AbstractController
{
//    home pagina
    /**
     * @Route("/{_locale}/home", name="home")
     */
    public function homepage(Request $request, \Swift_Mailer $mailer)
    {

        $card = $this->getDoctrine()->getRepository(Card::class)->findAll();
        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();

        $em = $this->getDoctrine()->getManager();
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('homepage/homepage.html.twig',[
        'cards' => $card,
        'aanmeldingen' => $aanmeld,
            'form' => $form->createView()
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
     * @Route("/{_locale}/contact", name="contact",)
     */
    public function contact(Request $request)
    {
        $locale = $request->getLocale();
        $request->setLocale($locale);
        return $this->render('contact/contact.html.twig');
    }

    /**
     * @Route("/{_locale}/algemene-voorwaarden", name="algemene_voorwaarden",)
     */
    public function algemene_voorwaarden(Request $request)
    {
        return $this->render('policy/algemene_voorwaarden.html.twig');
    }

    /**
     * @Route("/{_locale}/privacy-statement", name="privacy_statement",)
     */
    public function privacy_statement(Request $request)
    {
        return $this->render('policy/privacy_statement.html.twig');
    }





//    /**
//     * @Route("/functionaliteit/{slug}", name="article_show")
//     */
//    public function show($slug)
//    {
////
//        $gegeven = $this->getDoctrine()->getRepository(Gegeven::class)->findOneBy([
//            'slug' => $slug
//        ]);
//
//
//        return $this->render('show.html.twig', [
//            'gegeven' => $gegeven
//        ]);
//    }

//    // functionaliteit
//    /**
//     * @Route("/functionaliteit", name="functionaliteit")
//     */
//    public function functionaliteit()
//    {
//        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
//
//        return $this->render('functionaliteit/functionaliteit.html.twig', [
//            'namen' => $categorie
//        ]);
//
//    }

    //categoriefunctionalteit
//    /**
//     *
//     */

    // Gegeven pagina
//    /**
//     * @Route("/functionaliteit/{slug}", name="article_show")
//     */
//    public function gegeven($slug) {
////
//        $categorie = $this->getDoctrine()->getRepository(Gegeven::class)->Findby([
//            'groep' => $slug
//        ]);
//
//
//
////        return $this->render('functionaliteit/klantbeheer.html.twig', [
////            'gegevens' => $categorie
////        ]);
//    }





}
