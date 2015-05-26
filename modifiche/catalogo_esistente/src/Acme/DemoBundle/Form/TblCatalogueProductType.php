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
            ->add('img','file')
            //->add('img','elfinder', array('instance'=>'form', 'enable'=>true))
            ->add('idTblPhotoCat')
            ->add('template')
            ->add('pub')
            ->add('position')
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
        return 'product';
    }
}
