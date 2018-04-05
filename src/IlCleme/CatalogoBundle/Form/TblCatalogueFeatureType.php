<?php

namespace IlCleme\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TblCatalogueFeatureType extends AbstractType
{
    private $lingua;

    public function __construct($lingua)
    {
        $this->lingua = $lingua;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                'choices'   =>  array('float:left' => 'Su unica riga', 'float:none' => 'Un valore per riga')
            ))
            ->add('inheritFrom', 'entity', array(
                'class' => 'IlCleme\CatalogoBundle\Entity\Feature',
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
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IlCleme\CatalogoBundle\Entity\Feature'
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
