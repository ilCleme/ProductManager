<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TblCatalogueProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblCatalogueProduct')
            ->add('idTblLingua')
            ->add('title')
            ->add('description')
            ->add('descriptionNotag')
            ->add('shortDescription')
            ->add('cod')
            ->add('imgThumb')
            ->add('img')
            ->add('imgFiniture1')
            ->add('imgFiniture2')
            ->add('idTblPhotoCat')
            ->add('template')
            ->add('pub')
            ->add('featured')
            ->add('position')
            ->add('idOld')
            ->add('priceList')
            ->add('priceSale')
            ->add('priceOffer')
            ->add('puntoVendita')
            ->add('categories', 'entity', array(
                'class' => 'Acme\DemoBundle\Entity\TblCatalogueCategory',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true
              ))
            ->add('featurevalues', 'entity', array(
                'class' => 'Acme\DemoBundle\Entity\TblCatalogueFeaturevalue',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true
              ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\TblCatalogueProduct'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_demobundle_tblcatalogueproduct';
    }
}
