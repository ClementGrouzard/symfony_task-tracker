<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function homepage(TaskRepository $taskRepository): Response
    {
        $tasks = [
            ['id' => 1, 'name' => 'Work on my Angular/Symfony todolist'],
            ['id' => 2, 'name' => 'Study TypeScript documentation'],
            ['id' => 3, 'name' => 'Apply to the most recently published job ads'],
        ];
        
        return $this->render('todo/index.html.twig', [
            'title' => 'My Task Manager',
            'tasks' => $tasks,
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
