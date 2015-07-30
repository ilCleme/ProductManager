<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TblCatalogueFeaturevalueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblCatalogueFeaturevalue', 'hidden')
            ->add('idTblLingua', 'hidden')
            ->add('title')
            ->add('img')
            ->add('link')
            ->add('link2')
            ->add('position', 'hidden')
            //->add('productsWithFeaturevalue')
            ->add('features', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true,
                'required' => false
              ))
            ->add('save', 'submit', array('label' => 'Salva'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_demobundle_tblcataloguefeaturevalue';
    }
}