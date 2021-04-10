<?php

namespace App\Controller;

use App\Form\PeselType;
use App\Value\Pesel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeselController extends Controller
{
    /**
     * @Route("/pesel", name="pesel_index")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(PeselType::class, new Pesel());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Pesel jest prawidłowy! 🙌');
        }

        return $this->render('pesel/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
