<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Reply;
use App\Form\ReplyType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class MailController extends AbstractController
{

    /**
     * @Route("/{_locale}/mailen", name="mailen")
     */
    public function indexAction()
    {

        $blog = $this->getDoctrine()->getRepository(Blog::class)->findBy(
            array(),
            array('id' => 'DESC'),
            3,
            0);


        return $this->render('mailtesten.html.twig', [
            'blogs' => $blog
        ]);
    }
}
