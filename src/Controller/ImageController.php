<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class ImageController extends AbstractController
{
    #[Route('/image/new', name: 'app_image_new')]
    public function new(Request $request, SessionInterface $session, SluggerInterface $slugger): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
                
                $uploadDirectory = $this->getParameter('kernel.project_dir').'/public/uploads';
                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }
                
                try {
                    $file->move($uploadDirectory, $newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload du fichier.');
                    return $this->render('image/form.html.twig', [
                        'form' => $form->createView(),
                    ]);
                }
                
                $images = $session->get('images', []);
                
                $imageData = [
                    'id' => count($images) + 1,
                    'title' => $image->getTitle(),
                    'alt' => $image->getAlt(),
                    'description' => $image->getDescription(),
                    'categorie' => $image->getCategorie(),
                    'publishedAt' => $image->getPublishedAt(),
                    'file' => 'uploads/'.$newFilename,
                ];
                
                $images[] = $imageData;
                
                $session->set('images', $images);
                
                $this->addFlash('success', 'Image ajoutée avec succès !');
                
                return $this->redirectToRoute('app_image_list');
            }
        }

        return $this->render('image/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/image/list', name: 'app_image_list')]
    public function list(SessionInterface $session): Response
    {
        $images = $session->get('images', []);

        return $this->render('image/list.html.twig', [
            'images' => $images,
        ]);
    }
}

