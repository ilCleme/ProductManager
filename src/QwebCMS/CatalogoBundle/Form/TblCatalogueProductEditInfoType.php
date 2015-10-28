<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TblCatalogueProductEditInfoType extends AbstractType
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
        ->add('classeEnergetica')
        ->add('prezzo')
        ->add('idTblPhotoCat', 'hidden')
        ->add('pub', 'checkbox', array(
            'required'  => false,
        ))
        ->add('position')
        ->add('categories', 'entity', array(
            'class'     => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
            'property'  => 'title',
            'multiple'  => true,
            'expanded'  => false,
            'required'  => true,
            'mapped'    => true
        ))
        ->add('save', 'submit', array('label' => 'Salva ed Esci'))
        ->add('saveAndContinue', 'submit', array('label' => 'Salva e Continua'))
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
        return 'product_edit';
    }
}
