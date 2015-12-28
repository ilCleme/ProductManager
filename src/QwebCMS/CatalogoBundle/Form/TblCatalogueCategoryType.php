<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use QwebCMS\CatalogoBundle\Form\Type\GPSCoordinateType;

class TblCatalogueCategoryType extends AbstractType
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
            ->add('idTblCatalogueCategory', 'hidden')
            ->add('idTblLingua', 'hidden')
            ->add('title')
            ->add('description')
            ->add('pub')
            ->add('position','hidden')
            ->add('gender_code', new GPSCoordinateType(), array(
                'mapped'   => false,
            ))
            ->add('categoriesParent', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.idTblLingua = '.$this->lingua);
                },
                'property' => 'title',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ))
            ->add('features', 'entity', array(
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->where('f.idTblLingua = '.$this->lingua);
                },
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
            'data_class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'form_tblcataloguecategory';
    }
}
