<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AbstractController {

      /**
     * @Route("/admin", name="admin.pages.home")
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index():Response
    {
        return $this->render('admin/pages/home.html.twig');
    }
}