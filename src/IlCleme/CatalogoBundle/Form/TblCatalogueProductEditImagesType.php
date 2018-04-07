<?php

namespace IlCleme\CatalogoBundle\Form;

use IlCleme\CatalogoBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TblCatalogueProductEditImagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('idTblPhotoCat', HiddenType::class)
        ->add('save', SubmitType::class, array('label' => 'Salva ed Esci'))
        ->add('saveAndContinue', SubmitType::class, array('label' => 'Salva e Continua'))
        ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'product_edit';
    }
}
