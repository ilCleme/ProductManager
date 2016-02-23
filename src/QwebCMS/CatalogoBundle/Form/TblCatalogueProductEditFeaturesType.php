<?php

namespace QwebCMS\CatalogoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TblCatalogueProductEditFeaturesType extends AbstractType
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
                            ->where('u.idTblLingua = ?2')
                            ->join('u.features', 'f', 'WITH')
                            ->andwhere('f.idTblCatalogueFeature = ?1')
                            ->andwhere('f.idTblLingua = ?2')
                            ->setParameters(array('1' => $idFeature, '2' => $this->lingua));
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
