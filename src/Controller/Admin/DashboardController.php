<?php

namespace App\Controller\Admin;

use App\Entity\Carrousel;
use App\Entity\Categories;
use App\Entity\Contact;
use App\Entity\Images;
use App\Entity\Orders;
use App\Entity\OrdersDetails;
use App\Entity\Products;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin_denied', name: 'admin_denied')]
    public function admin_denied()
    {
        return $this->redirectToRoute('main');

    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecommerce');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', Users::class);

        yield MenuItem::section('Products');
        yield MenuItem::linkToCrud('Categories', 'fa fa-tag', Categories::class);
        yield MenuItem::linkToCrud('Products', 'fa fa-industry', Products::class);

        yield MenuItem::section('Orders');
        yield MenuItem::linkToCrud('Orders', 'fa fa-shopping-bag', Orders::class);
        yield MenuItem::linkToCrud('OrdersDetails', 'fas fa-list', OrdersDetails::class);

        yield MenuItem::section('Carrousel');
        yield MenuItem::linkToCrud('Images', 'fas fa-images', Carrousel::class);

        yield MenuItem::section('Contact');
        yield MenuItem::linkToCrud('Contact', 'fa fa-envelope', Contact::class);
    }
}
