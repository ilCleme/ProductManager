<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TblCatalogueProductEditType extends AbstractType
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
            ->add('planimetria', 'hidden')
            ->add('idTblPhotoCat', 'hidden')
            ->add('template', 'hidden')
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
            ->add('exit', 'submit', array('label' => 'Salva ed Esci'))
            ->add('save', 'submit', array('label' => 'Salva e Continua'))
            ->addEventListener(FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )
            ;
    }

    public function onPreSetData(FormEvent $event)
    {
        $product = $event->getData();
        $form = $event->getForm();
        $categorie = $product->getCategories();
        foreach($categorie as $categoria){
            $features = $categoria->getFeatures();
            foreach($features as $feature){

                if ($feature->getTypeInput() == 'select' ){
                    $expanded = false;
                    $multiple = false;
                } else {
                    $expanded = true;
                    $multiple = true;
                }

                if($feature->getCompulsory()){
                    $required = true;
                } else {
                    $required = false;
                }

                $idFeature = $feature->getIdTblCatalogueFeature();

                $form->add('featurevalues_'.$idFeature, 'entity', array(
                    'class'     =>  'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
                    'property'  =>  'title',
                    //'choices'   =>  $featurevalues,
                    'query_builder' => function (EntityRepository $er) use ($idFeature){
                        return $er->createQueryBuilder('u')
                            //->where('u.id > ?1')
                            ->join('u.features', 'f', 'WITH')
                            ->where('f.id = ?1')
                            ->setParameter(1, $idFeature);
                    },
                    'expanded'  =>  $expanded,
                    'multiple'  =>  $multiple,
                    'required'  =>  $required,
                    'mapped'    =>  false,
                    'placeholder' => 'Scegli un opzione',
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
