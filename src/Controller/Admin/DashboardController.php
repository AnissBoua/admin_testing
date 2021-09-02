<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    private $repoUser;
    private $repoCat;
    private $repoProd;
    public function __construct(UserRepository $repoUser, CategoryRepository $repoCat, ProductRepository $repoProd)
    {
        $this->repoUser = $repoUser;
        $this->repoCat = $repoCat;
        $this->repoProd = $repoProd;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //$repo = $this->getDoctrine()->getRepository(User::class);
        //$allUsers = $repo->findAll();
        //$nbUsers = count($allUsers);
        //return parent::index();
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', ['users' => count($this->repoUser->findAll())]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My site');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
