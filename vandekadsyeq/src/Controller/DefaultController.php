<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\LoginType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function index()
    {
        $form = $this->createForm(LoginType::class);

        return $this->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
