<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\BlogType;
use App\Form\ImageType;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class MediaController extends AbstractController
{
    /**
     * @Route("/{_locale}/admin/media", name="media")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $media = $this->getDoctrine()->getRepository(Image::class)->findAll();

        return $this->render('admin/media/media.html.twig', [
            'media' => $media
        ]);

    }

    /**
     * @Route("/{_locale}/admin/media/edit/{id}", name="media_edit")
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $edit = $this->getDoctrine()->getRepository(Image::class)->findOneBy([
            'id' => $id,
        ]);
        $form = $this->createForm(ImageType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $edit = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($edit);
            $em->flush();

            return $this->redirectToRoute('media', [
                'id' => $edit->getId(),
            ]);
        }

        return $this->render('admin/media/editmedia.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{_locale}/admin/media/add", name="media_add")
     * @IsGranted("ROLE_USER")
     */
    public function add_blog(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(MediaType::Class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $media = $form->getData();

            $file = $media->getImage();

            $image = $file->getFile();
            dump($file);

                $fileName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('image'), $fileName);

                $file->setName($fileName);


            $manager->persist($media);
                $manager->flush();



//            return $this->redirectToRoute('media');
        }
        return $this->render('admin/media/addmedia.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
