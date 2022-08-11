<?php
namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;


class TaskController extends AbstractController
{
    #[Route('/api/tasks/{id<\d+>}', methods: ['GET'], name:'api_tasks_get_one')]
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
