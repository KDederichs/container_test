<?php


namespace App\Controller;


use App\Entity\SomeTestDto;
use App\Form\Type\SomeTestType;
use App\Services\SomeTestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    /**
     * @Route("/test", methods={"GET", "POST"})
     */
    public function testAction(SomeTestService $service, Request $request)
    {
        $testObj = new SomeTestDto();
        $form = $this->createForm(SomeTestType::class, $testObj);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $service->sayTest();
            return $this->render('view.htm.twig');
        }

        return $this->render('test_view.htm.twig', ['form' => $form->createView()]);
    }
}
