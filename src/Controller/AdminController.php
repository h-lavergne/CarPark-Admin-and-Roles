<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\CarResearch;
use App\Form\CarResearchType;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/car", name="admin.car.index")
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
            "admin" => true
        ]);
    }


    /**
     * @Route("/admin/car/create", name="admin.car.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {

        $form = $this->createForm(CarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute("admin.car.index");
        }

        return $this->render('admin/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/car/edit/{id}", name="admin.car.edit")
     * @param Car $car
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Car $car, Request $request, EntityManagerInterface $em)
    {

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($car);
            $em->flush();
            return $this->redirectToRoute("admin.car.index");
        }

        return $this->render('admin/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/delete/car/{id}", name="admin.car.delete", methods="delete")
     * @param Car $car
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Car $car, EntityManagerInterface $em, Request $request): RedirectResponse
    {
        if ($this->isCsrfTokenValid("delete" . $car->getId(), $request->get("_token"))){
            $em->remove($car);
            $em->flush();
            return $this->redirectToRoute("admin.car.index");
        }
        return $this->redirectToRoute("admin.car.index");
    }

}
