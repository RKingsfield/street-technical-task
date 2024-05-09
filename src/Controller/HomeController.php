<?php
namespace App\Controller;

use \Slim\Exception\HttpInternalServerErrorException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeController extends BaseController
{
    public function index(Request $request, Response $response, array $args = []): Response
    {
        return $this->render($request, $response, 'index.twig');
    }

    public function uploadCSV(Request $request, Response $response, array $args = []): Response
    {
        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['homeowners'];
        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw new HttpInternalServerErrorException($request, "Invalid file format");
        }

        $userService = $this->container->get('UserService');
        return $this->render($request, $response, 'users.twig', ['users' => $userService->processCSVFile($uploadedFile)]);
    }
}
