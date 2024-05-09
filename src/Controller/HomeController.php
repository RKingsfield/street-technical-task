<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Service\User as UserService;

final class HomeController extends BaseController
{
    public function index(Request $request, Response $response, array $args = []): Response
    {
        $this->logger->info("Home page action dispatched");

        return $this->render($request, $response, 'index.twig');
    }

    public function uploadCSV(Request $request, Response $response, array $args = []): Response
    {
        $this->logger->info('processing CSV file');

        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['homeowners'];
        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            return $this->error($request, $response, $args);
        }

        // @todo services should be injected in this rather than instantiated this way so any dependencies can be injected later
        // (such as with the introduction of a repository)
        $userService = new UserService();
        $users = [];
        $file = $uploadedFile->getStream()->detach();

        fgetcsv($file, 10000, ",");
        while (($userString = fgetcsv($file, 10000, ",")) !== false) {
            $users = array_merge($users, $userService->convertStringToUsers($userString[0]));
        }

        $this->logger->info(json_encode($users));

        return $this->render($request, $response, 'users.twig', ['users' => array_filter($users)]);
    }

    public function error(Request $request, Response $response, array $args = []): Response
    {
        $this->logger->info("Error log");

        throw new \Slim\Exception\HttpInternalServerErrorException($request, "Try error handler");
    }
}
