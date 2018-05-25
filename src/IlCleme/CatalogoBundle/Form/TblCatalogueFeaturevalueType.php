<?php

namespace IlCleme\CatalogoBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TblCatalogueFeaturevalueType extends AbstractType
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
            ->add('idTblLingua', HiddenType::class)
            ->add('title')
            ->add('imageFile', VichImageType::class, array(
                'required'      => false,
                'label'         => 'Icona',
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
            ))
            ->add('position', HiddenType::class)
            ->add('features', EntityType::class, array(
                'class' => 'IlCleme\CatalogoBundle\Entity\Feature',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->where('f.idTblLingua = '.$this->lingua);
                },
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ))
            ->add('save', SubmitType::class, array('label' => 'Salva'))
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
                $form->add('featurevalue_inherit', EntityType::class, array(
                    'class' => 'IlCleme\CatalogoBundle\Entity\Featurevalue',
                    'query_builder' => function (EntityRepository $er) use ($id){
                        return $er->createQueryBuilder('u')
                            ->join('u.features', 'f', 'WITH')
                            ->andwhere('f.id = ?1')
                            ->andwhere('f.idTblLingua = ?2')
                            ->setParameters(array('1' => $id, '2' => $this->lingua));
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
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IlCleme\CatalogoBundle\Entity\Featurevalue'
        ));

        $resolver->setRequired('language');
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'featurevalues_form';
    }
}
