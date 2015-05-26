<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblCatalogueProduct','text')
            ->add('idTblLingua','text')
            ->add('title','text')
            ->add('description','text')
            ->add('cod','text')
            ->add('idTblPhotoCat','integer')
            ->add('pub','integer')
            ->add('position','integer')
            ->add('idOld','integer')
            ->add('priceList','integer')
            ->add('priceSale','integer')
            ->add('priceOffer','integer')
            ->add('puntoVendita','integer')
            ->add('categories', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true
              ))
            ->add('save', 'submit', array('label' => 'Crea Prodotto'));
    }

    public function getName()
    {
        return 'productType';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct',
        ));
    }
}