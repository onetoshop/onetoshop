<?php

namespace App\Controller;

use App\Entity\Reply;
use App\Form\ReplyType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class MailController extends AbstractController
{
//
//    /**
//     * @Route("/{_locale}/mailen", name="mailen")
//     */
//    public function indexAction()
//    {
//        $pieChart = new PieChart();
//        $pieChart->getData()->setArrayToDataTable(
//            [['Task', 'Hours per Day'],
//                ['Work',     11],
//                ['Eat',      2],
//                ['Commute',  2],
//                ['Watch TV', 2],
//                ['Sleep',    7]
//            ]
//        );
//        $pieChart->getOptions()->setTitle('My Daily Activities');
//        $pieChart->getOptions()->setHeight(500);
//        $pieChart->getOptions()->setWidth(900);
//        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
//        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
//        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
//        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
//        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
//
//        return $this->render('mailtesten.html.twig', array('piechart' => $pieChart));
//    }
}
