<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{

    #[Route('/list-images', name: 'app_images')]
    public function list(): Response
    {

        $now = (new \DateTime());
        $images = [
            [
                'id'        => 1,
                'title'     => '1',
                'src'       => 'assets/images/img1.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 2,
                'title'     => '2',
                'src'       => 'assets/images/img2.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 3,
                'title'     => '3',
                'src'       => 'assets/images/img3.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 4,
                'title'     => '4',
                'src'       => 'assets/images/img4.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 5,
                'title'     => '5',
                'src'       => 'assets/images/img5.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 6,
                'title'     => '6',
                'src'       => 'assets/images/img6.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 7,
                'title'     => '7',
                'src'       => 'assets/images/img7.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 8,
                'title'     => '8',
                'src'       => 'assets/images/img8.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 9,
                'title'     => '9',
                'src'       => 'assets/images/img9.jpg',
                'createdAt' => $now
            ],
            [
                'id'        => 10,
                'title'     => '10',
                'src'       => 'assets/images/img10.jpg',
                'createdAt' => $now
            ],
        ];

        return $this->render(
            'list-images.html.twig',
            ['images' => $images]
        );
    }
}
