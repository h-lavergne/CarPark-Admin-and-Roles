<?php

namespace App\Controller;

use App\Entity\CarResearch;
use App\Form\CarResearchType;
use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/client/car", name="car.index")
     * @param CarRepository $carRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(CarRepository $carRepository, PaginatorInterface $paginator, Request $request)
    {
        $carResearch = new CarResearch();

        $form = $this->createForm(CarResearchType::class, $carResearch);
        $form->handleRequest($request);


        $cars = $paginator->paginate(
            $carRepository->findAllWithPagination($carResearch),
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView(),
            "admin" => false
        ]);
    }
}
