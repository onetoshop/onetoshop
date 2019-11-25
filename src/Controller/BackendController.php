<?php

namespace App\Controller;

use App\Entity\Aanmeld;
use App\Entity\Blog;
use App\Entity\Card;
use App\Entity\Contact;
use App\Entity\Gegeven;
use App\Entity\Nieuwsbrief;
use App\Entity\User;
use App\Form\BlogType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AanmeldType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\GegevenType;

class BackendController extends AbstractController
{

    /**
     * @Route("/{_locale}/admin", name="admin")
     */
    public function index()
    {
        # get amount of signups
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Aanmeld::class);
        $totaleaanmeld = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get all signups
        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();

        # get amount of articles
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Gegeven::class);
        $gegeven = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get amount of users
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(User::class);
        $users = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get amount of cads
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Card::class);
        $cards = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();


        return $this->render('admin/index.html.twig', [
            'totaleaanmeld' => $totaleaanmeld,
            'aanmeldingen' => $aanmeld,
            'gegeven' => $gegeven,
            'users' => $users,
            'cards' => $cards
        ]);
    }

    /**
     * @Route("/{_locale}/admin/aanmeldingen", name="aanmeldingen")
     *  @IsGranted("ROLE_USER")
     */
    public function mogelijkheden(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $aanmeld = new Aanmeld();

        $form = $this->createForm(AanmeldType::class, $aanmeld);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em->persist($aanmeld);
            $em->flush();


            return $this->redirectToRoute('aanmeldingen');
        }

        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();

        return $this->render('admin/aanmeldingen.html.twig', [
            'aanmeldingen' => $aanmeld,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/{_locale}/admin/informatie", name="informatie")
     *  @IsGranted("ROLE_USER")
     */
    public function informatie(Request $request)
    {


        $gegeven = $this->getDoctrine()->getRepository(Gegeven::class)->findAll();

        $em = $this->getDoctrine()->getManager();
        $gegeven1 = new Gegeven();

        $form = $this->createForm(GegevenType::class, $gegeven1);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em->persist($gegeven1);
            $em->flush();


            return $this->redirectToRoute('informatie');
        }

        return $this->render('admin/informatie.html.twig', [
                'gegeven' => $gegeven,
                'form' => $form->createView()
            ]);



    }
    /**
     * @Route("/{_locale}/admin/inbox", name="inbox")
     *  @IsGranted("ROLE_USER")
     */
    public function inbox()
    {
        $gegeven = $this->getDoctrine()->getRepository(Contact::class)->findAll();

        return $this->render('admin/inbox.html.twig', [
            'gegeven' => $gegeven
        ]);

    }

    /**
     * @Route("/{_locale}/admin/inbox/{slug}", name="show_mail")
     * @IsGranted("ROLE_USER")
     */
    public function show_mail($slug)
    {
        $app1 = $this->getDoctrine()->getRepository(Contact::class)->findBy([
            'id' => $slug
        ]);

        return $this->render('admin/show_mail.html.twig', [
            'app1' => $app1
        ]);
    }
    /**
     * @Route("/{_locale}/admin/inbox/delete_mail/{id}", name="delete_mail")
     * @IsGranted("ROLE_USER")
     */
    public function delete_mail(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $app = $em->getRepository(Contact::class)->find($id);

        $em->remove($app);
        $em->flush();

        return $this->redirectToRoute('inbox4');
    }
    /**
     * @Route("/{_locale}/admin/nieuwsbrief", name="nieuwsbrief")
     *  @IsGranted("ROLE_USER")
     */
    public function nieuwsbrief()
    {
        $gegeven = $this->getDoctrine()->getRepository(Nieuwsbrief::class)->findAll();

        return $this->render('admin/nieuwsbrief.html.twig', [
            'gegeven' => $gegeven
        ]);

    }


}


