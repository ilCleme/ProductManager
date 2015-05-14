<?php

namespace Acme\DemoBundle\Form;

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
            ->add('idTblCatalogueFeature')
            ->add('idTblLingua')
            ->add('title')
            ->add('description')
            ->add('typeInput')
            ->add('compulsory')
            ->add('display')
            ->add('position')
            //->add('featurevalues')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\TblCatalogueFeature'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_demobundle_tblcataloguefeature';
    }
}
