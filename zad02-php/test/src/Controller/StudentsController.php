<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/students')]
class StudentsController extends AbstractController
{
    #[Route('/getAll', methods: ['GET'])]
    public function index(StudentRepository $studentRepository): Response
    {
        $students = $studentRepository->findAll();
        $data = [];

        foreach ($students as $student) {
            $data[] = [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'age' => $student->getAge(),
                'hobby' => $student->getHobby(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/add', methods: ['POST'])]
    public function new(Request $request, StudentRepository $studentRepository): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $student = new Student();
        $student->setName($parameters['name']);
        $student->setSurname($parameters['surname']);
        $student->setAge($parameters['age']);
        $student->setHobby($parameters['hobby']);

        $studentRepository->save($student, true);
        return $this->json('Created new student with id ' . $student->getId());
    }

    #[Route('/get/{id}', methods: ['GET'])]
    public function show(StudentRepository $studentRepository, int $id): Response
    {
        $student = $studentRepository->find($id);

        if (!$student) {
            return $this->json('No student with this id found');
        } else {
            $data = [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'age' => $student->getAge(),
                'hobby' => $student->getHobby(),
            ];

            return $this->json($data);
        }
    }

    #[Route('/update/{id}', methods: ['PUT'])]
    public function edit(Request $request, StudentRepository $studentRepository, int $id): Response
    {
        $parameters = json_decode($request->getContent(), true);
        $tmpStudent = $studentRepository->find($id);

        if (!$tmpStudent) {
            return $this->json('No student found with id' . $id, 404);
        } else {
            $tmpStudent->setName($parameters['name']);
            $tmpStudent->setSurname($parameters['surname']);
            $tmpStudent->setAge($parameters['age']);
            $tmpStudent->setHobby($parameters['hobby']);

            $studentRepository->save( $tmpStudent, true);

            $data = [
                'id' => $tmpStudent->getId(),
                'name' => $tmpStudent->getName(),
                'surname' => $tmpStudent->getSurname(),
                'age' => $tmpStudent->getAge(),
                'hobby' => $tmpStudent->getHobby(),
            ];

            return $this->json($data);
        }
    }

    #[Route('/delete/{id}', methods: ['DELETE'])]
    public function delete(StudentRepository $studentRepository, int $id): Response
    {
        $student = $studentRepository->find($id);

        if (!$student){
            return $this->json('No student found with id' . $id, 404);
        } else {
            $studentRepository->remove($student, true);
            return $this->json('Succesfully deleted a student with id ' . $id);
        }
    }

}
