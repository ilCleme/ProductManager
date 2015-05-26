<?php

namespace QwebCMS\CatalogoBundle\Form;

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
            ->add('idTblLingua', 'hidden')
            ->add('title')
            ->add('description')
            ->add('descriptionNotag')
            ->add('shortDescription')
            ->add('img','image')
            //->add('img','elfinder', array('instance'=>'form', 'enable'=>true))
            ->add('idTblPhotoCat')
            ->add('template', 'hidden')
            ->add('pub')
            ->add('position')
            ->add('categories', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
                'property' => 'title',
                'multiple' => true,
                'expanded' => false
              ))
            ->add('featurevalues', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
                'property' => 'title',
                'multiple' => true,
                'expanded' => false
              ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct'
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
