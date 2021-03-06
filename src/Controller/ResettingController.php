<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewPasswordType;
use App\Form\PasswordRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ResettingController extends AbstractController
{
    /**
     * @Route("/reset_password", name="reset_password", methods={"GET", "POST"})
     */
    public function resetPassword(Request $request, EntityManagerInterface $entityManager, \Swift_Mailer $mailer) {
        $form = $this->createForm(PasswordRequestType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $token = bin2hex(random_bytes(32));
            $bericht = 'Klik hieronder om je wachtwoord te veranderen';
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
            $gebruiker = $user->Getusername();
            if ($user instanceof User) {
                $user->setPasswordRequestToken($token);
                $entityManager->flush();
                // send your email with SwiftMailer or anything else here
                $message = (new \Swift_Message('Bericht van Onetoshop'))
                    ->setFrom('dummyonetoshop@gmail.com')
                    ->setSubject('Wachtwoord veranderen')
                    ->setTo($email)
                    ->setBody('Hallo ' . $gebruiker  . '<br>' .
                            $bericht  . '<br>' .
                        'http://10.0.6.17:8000/reset_password/confirm/' . $token, 'text/html');
                $mailer->send($message);
                $this->addFlash('success', "Check uw inbox");
                return $this->redirectToRoute('reset_password');
            }
        }
        return $this->render('security/reset-password.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/reset_password/confirm/{token}", name="reset_password_confirm", methods={"GET", "POST"})
     */
    public function resetPasswordCheck(
        Request $request,
        string $token,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $encoder,
        TokenStorageInterface $tokenStorage,
        SessionInterface $session
    ) {
        $user = $entityManager->getRepository(User::class)->findOneBy(['passwordRequestToken' => $token]);
        if (!$token || !$user instanceof User) {
            $this->addFlash('danger', "Gebruiker niet gevonden");
            return $this->redirectToRoute('reset_password');
        }
        $form = $this->createForm(NewPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $password = $encoder->encodePassword($user, $password);
            $user->setPassword($password);
            $user->setPasswordRequestToken(null);
            $entityManager->flush();
            $token = new UsernamePasswordToken($user, $password, 'main');
            $tokenStorage->setToken($token);
            $session->set('_security_main', serialize($token));
            $this->addFlash('success', "Wachtwoord succesvol gewijzigd");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/reset-password-confirm.html.twig', ['form' => $form->createView()]);
    }

}
