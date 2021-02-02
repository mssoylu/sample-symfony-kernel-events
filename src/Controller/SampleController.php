<?php

namespace App\Controller;

use App\Entity\Sample;
use App\Form\SampleType;
use App\Repository\SampleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sample")
 */
class SampleController extends AbstractController
{
    /**
     * @Route("/", name="sample_index", methods={"GET"})
     */
    public function index(SampleRepository $sampleRepository): Response
    {
        return $this->render('sample/index.html.twig', [
            'samples' => $sampleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sample_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sample = new Sample();
        $form = $this->createForm(SampleType::class, $sample);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sample);
            $entityManager->flush();

            return $this->redirectToRoute('sample_index');
        }

        return $this->render('sample/new.html.twig', [
            'sample' => $sample,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sample_show", methods={"GET"})
     */
    public function show(Sample $sample): Response
    {
        return $this->render('sample/show.html.twig', [
            'sample' => $sample,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sample_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sample $sample): Response
    {
        $form = $this->createForm(SampleType::class, $sample);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sample_index');
        }

        return $this->render('sample/edit.html.twig', [
            'sample' => $sample,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sample_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sample $sample): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sample->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sample);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sample_index');
    }
}
