<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ImageController extends AbstractController
{
    #[Route('/image/new', name: 'app_image_new')]
    public function new(Request $request): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($image);
        }

        return $this->render('image/new-image.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

