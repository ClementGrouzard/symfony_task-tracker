<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function homepage(TaskRepository $taskRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        /* $tasks = [
            ['id' => 1, 'name' => 'Mock task', 'due_date' => 'Today'],
        ]; */
         
        $tasks = $taskRepository->findAll();

        // creates a task object and initializes some data for this example
        $task = new Task();
                       
        $form = $this->createForm(TaskType::class, $task);


        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $task = $form->getData();

            $taskRepository->add($task);

            $entityManager->persist($task);
            $entityManager->flush(); 

        }
        
        return $this->render('todo/index.html.twig', [
            'title' => 'My Task Manager',
            'tasks' => $tasks,
            'due_date' => $due_date,
            'form' => $form->createView(),
        ]);
        
        
    }
    

    #[Route('browse/{slug}', name: 'app_browse')]
    public function browse(string $slug = null): Response
    {

        $category = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        return $this->render('todo/browse.html.twig', [
            'category' => $category,
            'title' => 'My Task Manager',
        ]);
    }

    


}
