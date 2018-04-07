<?php

namespace IlCleme\CatalogoBundle\Form;

use IlCleme\CatalogoBundle\Entity\Featurevalue;
use IlCleme\CatalogoBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TblCatalogueProductEditFeaturesType extends AbstractType
{
    private $lingua;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->lingua = $options['language'];
        $builder
            ->add('exit', SubmitType::class, array('label' => 'Salva ed Esci'))
            ->add('save', SubmitType::class, array('label' => 'Salva e Continua'))
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

                $idFeature = $feature->getId();

                $form->add('featurevalues_'.$idFeature, EntityType::class, array(
                    'class'     =>  Featurevalue::class,
                    'choice_label'  =>  'title',
                    'query_builder' => function (EntityRepository $er) use ($idFeature){
                        return $er->createQueryBuilder('u')
                            ->where('u.idTblLingua = ?2')
                            ->join('u.features', 'f', 'WITH')
                            ->andwhere('f.id = ?1')
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
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class
        ));

        $resolver->setRequired('language');
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'product_edit';
    }
}
