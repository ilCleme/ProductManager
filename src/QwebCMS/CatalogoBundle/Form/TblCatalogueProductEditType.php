<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TblCatalogueProductEditType extends AbstractType
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
        ->add('coordinate')
        ->add('indirizzo')
        ->add('idTblPhotoCat', 'hidden')
        ->add('template', 'hidden')
        ->add('pub', 'checkbox', array(
                'required'  => false,
            ))
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
            'group_by' => 'featureTitle',
            'multiple' => false,
            'expanded' => false,
            'required' => false
        ))
        ->add('exit', 'submit', array('label' => 'Salva ed Esci'))
        ->add('save', 'submit', array('label' => 'Salva e Continua'));
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
        return 'product_edit';
    }
}
