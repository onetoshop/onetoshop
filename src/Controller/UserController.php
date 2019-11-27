<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{
    /**
     * @Route("/{_locale}/admin/user", name="user")
     * @IsGranted("ROLE_USER")
     */
    public function gebruiker(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $aanmeld = new User();

        $form = $this->createForm(UserType::class, $aanmeld);

//        $password = $this->getDoctrine()->getRepository(User::class)->Findby([
//            'password' => $encoder
//        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($aanmeld, $aanmeld->getPassword());
            $aanmeld->setPassword($password);

            $em->persist($aanmeld);
            $em->flush();


            return  $this->redirectToRoute('user');


        }
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/user/user.html.twig', [
            'users' => $user,
            'form' => $form->createView()
        ]);


    }


    /**
     * @Route("/usersettings", name="usersettings")
     * @IsGranted("ROLE_USER")
     */
    public function settings()
    {
        return $this->render('admin/user/usersettings.html.twig');
    }

}