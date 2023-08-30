<?php

namespace App\Controller\Admin;

use App\Entity\OrdersDetails;
use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrdersDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrdersDetails::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('orders', 'Orders (id - référence)'),
            AssociationField::new('products', 'Products'),
            NumberField::new('quantity'),
            NumberField::new('price'),       
            
        ];
    }
    
}
