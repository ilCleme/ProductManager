<?php

namespace IlCleme\CatalogoBundle\Form;

use IlCleme\CatalogoBundle\Entity\Feature;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TblCatalogueFeatureType extends AbstractType
{
    private $lingua;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblLingua', HiddenType::class)
            ->add('title')
            ->add('description')
            ->add('typeInput', ChoiceType::class, array(
                'choices'   =>  array(
                    'select' => 'Insieme con selezione singola (select)',
                    'checkbox' => 'Insieme con selezione multipla (checkbox)'
                ),
                'choices_as_values' => true,
                'required'  =>  true
            ))
            ->add('compulsory', ChoiceType::class, array(
                'choices'   =>  array(
                    'Si' => '1',
                    'No' => '0'
                ),
                'choices_as_values' => true,
                'expanded'  =>  true,
                'multiple'  =>  false
            ))
            ->add('display', ChoiceType::class, array(
                'choices'   =>  array(
                    'Su unica riga' => 'float:left',
                    'Un valore per riga' => 'float:none'
                ),
                'choices_as_values' => true
            ))
            ->add('inheritFrom', EntityType::class, array(
                'class' => Feature::class,
                'choice_label' => 'title',
                'multiple' => false,
                'expanded' => false,
                'required' => false
            ))
            ->add('position', HiddenType::class)
            ->add('save', SubmitType::class, array('label' => 'Salva'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Feature::class
        ));

        $resolver->setRequired('language');
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'feature';
    }
}
