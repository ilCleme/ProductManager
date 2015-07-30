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
        ->add('idTblCatalogueProduct','hidden')
        ->add('idTblLingua', 'hidden')
        ->add('title')
        ->add('description')
        ->add('cod')
        ->add('descriptionNotag', 'hidden')
        ->add('shortDescription')
        ->add('idTblPhotoCat', 'hidden')
        ->add('template', 'hidden')
        ->add('pub')
        ->add('position')
        ->add('categories', 'entity', array(
            'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
            'property' => 'title',
            'multiple' => true,
            'expanded' => false,
            'required' => false
        ))
        ->add('featurevalues', 'entity', array(
            'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
            'property' => 'title',
            'multiple' => true,
            'expanded' => false,
            'required' => false
        ))
        ->add('save', 'submit', array('label' => 'Salva'))
        ->add('saveAndContinue', 'submit', array('label' => 'Salva e continua'))
        ->add('saveAndExit', 'submit', array('label' => 'Salva ed Esci'))

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
        return 'product_new';
    }
}
