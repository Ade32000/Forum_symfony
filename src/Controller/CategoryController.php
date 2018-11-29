<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        $category = $this->getDoctrine()
        ->getRepository('App:Category')
        ->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category,
        ]);
    }
}
