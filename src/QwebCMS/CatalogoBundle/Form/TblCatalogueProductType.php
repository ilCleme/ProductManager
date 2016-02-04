<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use QwebCMS\CatalogoBundle\Form\Type\GPSCoordinateType;

class TblCatalogueProductType extends AbstractType
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
        ->add('idTblCatalogueProduct','hidden')
        ->add('idTblLingua', 'hidden')
        ->add('title')
        ->add('description')
        ->add('cod')
        ->add('descriptionNotag', 'hidden')
        ->add('shortDescription')
        ->add('coordinate', new GPSCoordinateType())
        ->add('indirizzo')
        ->add('classeEnergetica')
        ->add('prezzo')
        ->add('comfort')
        ->add('accessori')
        ->add('valoreCatastale')
        ->add('parcheggio')
        ->add('featured', 'checkbox', array(
            'required'  => false,
        ))
        ->add('download', 'hidden')
        ->add('idTblPhotoCat', 'hidden')
        ->add('template', 'hidden')
        ->add('pub', 'checkbox', array(
            'required'  => false,
        ))
        ->add('position')
        ->add('categories', 'entity', array(
            'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->where('u.idTblLingua = '.$this->lingua);
            },
            'property' => 'title',
            'multiple' => false,
            'expanded' => false,
            'required' => true
        ))
        ->add('save', 'submit', array('label' => 'Salva'))
        ->add('saveAndContinue', 'submit', array('label' => 'Salva e continua'))
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
        return 'product_new';
    }
}
