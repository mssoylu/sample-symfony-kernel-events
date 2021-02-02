<?php

namespace App\Controller;

use App\Entity\Sample;
use App\Form\SampleType;
use App\Repository\SampleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test/exception")
 */
class ExceptionTestController extends AbstractController
{
    /**
     * @Route("/{number}", name="test_exception_index", methods={"GET"})
     * @return Response
     */
    public function index(int $number): Response
    {
        if ($number < 1) {
            throw new Exception("Sayi 1'den buyuk olmali!!");
        }

        return new Response('Sectiginiz sayi <strong>' . $number . '</strong>');
    }
}
