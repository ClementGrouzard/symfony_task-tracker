<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;


class TaskController extends AbstractController
{
    #[Route('/api/tasks/{id<\d+>}', name:'app_tasks', methods: ['GET'])]
    public function getTask(int $id, LoggerInterface $logger): Response
    {
        // TODO query the database
        $task = [
            'id' => $id,
            'name' => 'Work on my Angular/Symfony todolist',
            'url' => 'https://pomofocus.io/'
        ];

        $logger->info('Returning API response for task {task}', [
            'task' => $id,
        ]);

        return $this->json($task);
    }

}
