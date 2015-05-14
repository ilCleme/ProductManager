<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblCatalogueCategory','text')
            ->add('idTblLingua','text')
            ->add('title','text')
            ->add('description','text')
            ->add('img','text')
            ->add('pub','integer')
            ->add('position','integer')
            ->add('categoriesParent', 'entity', array(
                'class' => 'Acme\DemoBundle\Entity\TblCatalogueCategory',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true
              ))
            ->add('save', 'submit', array('label' => 'Crea Categoria'));
    }

    public function getName()
    {
        return 'categoryType';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\TblCatalogueCategory',
        ));
    }
}