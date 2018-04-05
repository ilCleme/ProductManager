<?php

namespace IlCleme\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class FeaturevalueChoiceType extends AbstractType
{
    protected $choice;
    protected $required;
    protected $multiple;

    /*public function __construct($choice, $multiple, $required, $expanded)
    {
        $this->choice = $choice;
        $this->multiple = $multiple;
        $this->required = $required;
        $this->expanded = $expanded;
    }*/

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTblCatalogueFeaturevalue', 'hidden')
            ->add('idTblLingua', 'hidden')
            ->add('title', 'hidden')
            ->add('img', 'hidden')
            ->add('position', 'hidden')
            ->add('features', 'entity', array(
                'class' => 'IlCleme\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
                'property' => 'title',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->join('u.features', 'f', 'WITH', 'f.id = 2');
                },
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ))
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $product = $event->getData();
            $form = $event->getForm();

            /*$form->add('featurevalues', 'entity', array(
                'class'     =>  'IlCleme\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
                'property'  =>  'title',
                'choices'   =>  $featurevalues,
                'expanded'  =>  $expanded,
                'multiple'  =>  $multiple,
                'required'  =>  $required,
                'mapped'    =>  false
            ));*/

        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IlCleme\CatalogoBundle\Entity\TblCatalogueFeaturevalue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'FeaturevalueChoiceType';
    }
}
