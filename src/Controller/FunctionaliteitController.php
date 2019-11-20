<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class FunctionaliteitController extends AbstractController
{
    /**
     * @Route("/functionaliteit", name="functionaliteit")
     *  @IsGranted("ROLE_USER")
     */
    public function index()
    {
        return $this->render('functionaliteit/functionaliteit.html.twig');
    }

    /**
     * @Route("/admin/functionaliteit", name="functionaliteitadmin")
     */
    public function adminfunctionaliteit()
    {
        return $this->render('admin/functionaliteit.html.twig');
    }
}
