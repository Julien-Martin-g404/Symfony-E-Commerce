<?php

namespace App\Controller\Admin;

use App\Entity\Carrousel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarrouselCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carrousel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('realname'),
            ImageField::new('name')->setUploadedFileNamePattern('[uuid].png')->setUploadDir('public/assets/uploads/carrousel')->onlyOnForms(),
            TextField::new('name')->onlyOnDetail()->onlyOnIndex(),
        ];
    }
    
}
