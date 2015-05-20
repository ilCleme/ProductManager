<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TblCatalogueCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblCatalogueCategory')
            ->add('idTblLingua')
            ->add('title')
            ->add('description')
            ->add('img')
            ->add('pub')
            ->add('position')
            //->add('products')
            ->add('categoriesParent', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true
              ))
            //->add('categoriesParent')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_demobundle_tblcataloguecategory';
    }
}
