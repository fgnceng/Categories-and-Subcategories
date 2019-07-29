<?php

namespace App\Controller;

use App\Form\PosttType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class SubcategoryController extends AbstractController
{
    /**
     * @Route("/", name="subcategory")
     */
    public function index()
    {
        $post=new Post();
        $form=$this->createForm(PostType::class,$post);
        return $this->render('subcategory/index.html.twig', [
             'post'=>$post,
            'form'=>$form->createView(),
        ]);
    }
}
