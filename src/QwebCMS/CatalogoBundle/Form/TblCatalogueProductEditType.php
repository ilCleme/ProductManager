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
                'class' => 'QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory',
                'property' => 'title',
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ))
            ->add('featurevalues', 'entity', array(
                'class'     =>  'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
                'property'  =>  'title',
                'group_by'  =>  'featureTitle',
                'expanded'  =>  false,
                'multiple'  =>  true,
                'required'  =>  false,
            ))
            ;


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $product = $event->getData();
            $form = $event->getForm();

            $categorie = $product->getCategories();
            foreach($categorie as $categoria){
                $features = $categoria->getFeatures();
                foreach($features as $feature){

                    $featurevalues = $feature->getFeaturevalues();

                    if ($feature->getTypeInput() == 'select' ){
                        $expanded = (bool) false;
                        $multiple = (bool) false;
                    } else {
                        $expanded = (bool) true;
                        $multiple = (bool) true;
                    }

                    if($feature->getCompulsory()){
                        $required = true;
                    } else {
                        $required = false;
                    }

                    //var_dump($feature->getId());
                    /*$form->add('featurevalues', 'collection', array(
                        'type'      =>  'entity',
                        'options'   =>  array(
                            'class'         =>  'QwebCMSCatalogoBundle:TblCatalogueFeaturevalue',
                            'data_class'    => null,
                            'property'      =>  'title',
                            'group_by'       =>  'featureTitle',
                            'choices'       =>  $featurevalues,
                            'expanded'      =>  $expanded,
                            'required'      =>  $required,
                            'multiple'      =>  $multiple,
                            //'mapped'    =>  false
                        ),
                        'allow_add' =>  true,
                    ));*/

                    /*$form->add('featurevalues', 'collection', array(
                        'type'      =>  new TblCatalogueProductFeaturevalueType($featurevalues),
                        'allow_add' =>  true,
                    ));*/

                    /*$form->add('featurevalues', 'entity', array(
                        'class'     =>  'QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue',
                        'property'  =>  'title',
                        'group_by'  =>  'featureTitle',
                        'choices'   =>  $featurevalues,
                        'expanded'  =>  $expanded,
                        'multiple'  =>  $multiple,
                        'required'  =>  $required,
                        'mapped'    =>  false
                    ));*/
                }
            }
        });

        $builder
            ->add('exit', 'submit', array('label' => 'Salva ed Esci'))
            ->add('save', 'submit', array('label' => 'Salva e Continua'));
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
