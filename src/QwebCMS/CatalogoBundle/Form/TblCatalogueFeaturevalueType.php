<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
            ->add('img', 'hidden')
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
            ->addEventListener(FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )
        ;
    }

    public function onPreSetData(FormEvent $event)
    {
        $featurevalue = $event->getData();
        $form = $event->getForm();
        $featurevalue_parent = $featurevalue->getFeatures();

        if (method_exists($featurevalue_parent[0], "getInheritFrom")){
            $id = $featurevalue_parent[0]->getInheritFrom();
            if (null !== $id){
                $form->add('featurevalue_inherit', 'entity', array(
                    'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
                    'query_builder' => function (EntityRepository $er) use ($id){
                        return $er->createQueryBuilder('u')
                            //->where('u.id > ?1')
                            ->join('u.features', 'f', 'WITH')
                            ->where('f.id = ?1')
                            ->setParameter(1, $id);
                    },
                    'property' => 'title',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ));
            }
        }



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
        return 'featurevalues_form';
    }
}
