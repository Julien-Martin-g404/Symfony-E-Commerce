<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('origin_name'),
            ImageField::new('name')->setUploadedFileNamePattern('[uuid].png')->setUploadDir('public/assets/uploads/products')->onlyOnForms(),
            TextField::new('name')->onlyOnDetail()->onlyOnIndex(),
        ];
    }


    public function configureActions(Actions $actions): Actions
    {
        $viewInvoice = Action::new('Uplaod Image', 'fas fa-file-invoice');

        return $actions;
    }

}
