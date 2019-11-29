<?php

namespace App\Controller;

use App\Entity\Reply;
use App\Form\ReplyType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MailController extends AbstractController
{
//
//    /**
//     * @Route("/{_locale}/mailen", name="mailen")
//     */
//    public function index(Request $request, \Swift_Mailer $mailer)
//    {
//
//
//        $form = $this->createForm(ReplyType::class);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $form = $form->getData();
//
//            $message = (new \Swift_Message('Bericht van Onetoshop'))
//                ->setFrom('dummyonetoshop@gmail.com')
//                ->setSubject($form['Onderwerp'])
//                ->setTo($form['Geadresseerde'])
//                ->setBody($form['Bericht'], 'text/html');
//            $mailer->send($message);
//
//
//
//            return $this->redirectToRoute('mailen');
//    }
//        return $this->render('mailtesten.html.twig',[
//        'form' => $form->createView()]);
//    }
}
