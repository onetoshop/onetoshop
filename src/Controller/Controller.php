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
use App\Entity\Nieuwsbrief;
use App\Form\AanmeldType;
use App\Form\CardType;
use App\Form\ContactType;
use App\Form\NieuwsbriefType;
use App\Form\UploadType;
use App\Repository\GegevenRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApplicationHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Twig\TwigFunction;

class Controller extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(){
        return $this->redirectToRoute('home');
    }
//    home pagina
    /**
     * @Route("/{_locale}/home", name="home")
     */
    public function homepage(Request $request)
    {

        $blog = $this->getDoctrine()->getRepository(Blog::class)->findBy(
            array(),
            array('id' => 'DESC'),
            3,
            0);


        $card = $this->getDoctrine()->getRepository(Card::class)->findAll();
        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();

        $em = $this->getDoctrine()->getManager();
        $contact = new Contact();


        $form = $this->createForm(ContactType::class, $contact);



        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em->persist($contact);
            $em->flush();
            $this->addFlash('succes', 'Bericht verstuurd!');

            return $this->redirectToRoute('home', ['_fragment' => 'contact-section']);
        }
        $em = $this->getDoctrine()->getManager();

        $nieuwsbrief = new Nieuwsbrief();

        $form2 = $this->createForm(NieuwsbriefType::class, $nieuwsbrief);
        $form2->handleRequest($request);


        if($form2->isSubmitted() && $form2->isValid()) {

            $em->persist($nieuwsbrief);
            $em->flush();
            $this->addFlash('nieuwsbrief', 'Succesvolle aanmelding!');

            return $this->redirectToRoute('home', ['_fragment' => 'news-section']);
        }


        return $this->render('homepage/homepage.html.twig',[
        'cards' => $card,
        'aanmeldingen' => $aanmeld,
            'form' => $form->createView(),
            'form2' => $form2->createView(),
            'blogs' => $blog
        ]);



    }

    // set description
    public function getFunctions()
    {
        return [
            new TwigFunction('beschrijving', [$this, 'beschrijving']),
        ];
    }

    /**
     * create a teaser from a large text
     *
     * @param string  $input  large text
     * @param integer $lenght number to cut large text down to
     * @return string         cut down string
     */
    public function beschrijving($input, $length = 184) : string
    {
        if(strlen($input) <= $length) {
            return str_replace(['<p>', '</p>'], '', $input);
        }

        $parts = explode(' ', $input);

        while(strlen(implode(' ', $parts)) > $length) {
            array_pop($parts);
        }

        return implode(' ', $parts);
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

}
