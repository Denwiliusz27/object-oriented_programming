<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/films')]
class FilmsController extends AbstractController
{
    #[Route('/getAll', methods: ['GET'])]
    public function index(FilmRepository $filmsRepository): Response
    {
        $films = $filmsRepository->findAll();
        $data = [];

        foreach ($films as $film) {
            $data[] = [
                'id' => $film->getId(),
                'name' => $film->getName(),
                'director' => $film->getDirector(),
                'year' => $film->getYear(),
                'rating' => $film->getRating(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/add', methods: ['POST'])]
    public function new(Request $request, FilmRepository $filmsRepository): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $film = new Film();
        $film->setName($parameters['name']);
        $film->setDirector($parameters['director']);
        $film->setYear($parameters['year']);
        $film->setRating($parameters['rating']);

        $filmsRepository->save($film, true);
        return $this->json('Created new film with id ' . $film->getId());
    }

    #[Route('/get/{id}', methods: ['GET'])]
    public function show(FilmRepository $filmsRepository, int $id): Response
    {
        $film = $filmsRepository->find($id);

        if (!$film) {
            return $this->json('No film with this id found');
        } else {
            $data = [
                'id' => $film->getId(),
                'name' => $film->getName(),
                'director' => $film->getDirector(),
                'year' => $film->getYear(),
                'rating' => $film->getRating(),
            ];

            return $this->json($data);
        }
    }

    #[Route('/update/{id}', methods: ['PUT'])]
    public function edit(Request $request, FilmRepository $filmsRepository, int $id): Response
    {
        $parameters = json_decode($request->getContent(), true);
        $tmpFilm = $filmsRepository->find($id);

        if (!$tmpFilm) {
            return $this->json('No film found with id' . $id, 404);
        } else {
            $tmpFilm->setName($parameters['name']);
            $tmpFilm->setDirector($parameters['director']);
            $tmpFilm->setYear($parameters['year']);
            $tmpFilm->setRating($parameters['rating']);

            $filmsRepository->save( $tmpFilm, true);

            $data = [
                'id' => $tmpFilm->getId(),
                'name' => $tmpFilm->getName(),
                'director' => $tmpFilm->getDirector(),
                'year' => $tmpFilm->getYear(),
                'rating' => $tmpFilm->getRating(),
            ];

            return $this->json($data);
        }
    }

    #[Route('/delete/{id}', methods: ['DELETE'])]
    public function delete(FilmRepository $filmsRepository, int $id): Response
    {
        $film = $filmsRepository->find($id);

        if (!$film){
            return $this->json('No film found with id' . $id, 404);
        } else {
            $filmsRepository->remove($film, true);
            return $this->json('Succesfully deleted the film with id ' . $id);
        }
    }
}
