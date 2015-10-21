<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TblCatalogueFeatureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblCatalogueFeature','hidden')
            ->add('idTblLingua','hidden')
            ->add('title')
            ->add('description')
            ->add('typeInput', 'choice', array(
                'choices'   =>  array('select' => 'Insieme con selezione singola (select)', 'checkbox' => 'Insieme con selezione multipla (checkbox)'),
                'required'  =>  true
            ))
            ->add('compulsory', 'choice', array(
                'choices'   =>  array('1' => 'Si', '0' => 'No'),
                'expanded'  =>  true,
                'multiple'  =>  false
            ))
            ->add('display', 'choice', array(
                'choices'   =>  array('float:left' => 'Su unica riga', '' => 'Un valore per riga')
            ))
            ->add('inheritFrom', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature',
                'property' => 'title',
                'multiple' => false,
                'expanded' => false,
                'required' => false
            ))
            ->add('position', 'hidden')
            //->add('featurevalues')
            ->add('save', 'submit', array('label' => 'Salva'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'feature';
    }
}
