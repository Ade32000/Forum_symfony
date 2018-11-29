<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GeneralController extends AbstractController
{
    /**
     * @Route("/general", name="general")
     */
    // public function index()
    // {
    //     return $this->render('general/index.html.twig', [
    //         'controller_name' => 'GeneralController',
    //     ]);
    // }

    public function new(Request $request)
    {
        // creates a user and gives it some dummy data for this example
        $user = new User();
    
        $form = $this->createFormBuilder($user)
            ->add('userName', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Yeah!'))
            ->getForm();

        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $user = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_success');
    }

    return $this->render('general/index.html.twig', array(
        'form' => $form->createView(),
    ));
    }
}
