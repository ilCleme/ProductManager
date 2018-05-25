<?php

namespace IlCleme\CatalogoBundle\Form;

use IlCleme\CatalogoBundle\Entity\Category;
use IlCleme\CatalogoBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use IlCleme\CatalogoBundle\Form\Type\AllegatoType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TblCatalogueProductType extends AbstractType
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
            ->add('description')
            ->add('cod')
            ->add('allegatiProgetto', CollectionType::class, array(
                'entry_type' => AllegatoType::class,
                'allow_add'    => true,
                'allow_delete'  => true,
                'by_reference' => false,
                'label' => false,
            ))
            ->add('imageFile', VichImageType::class, array(
                'required'      => false,
                'label'         => 'Logo',
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
            ))
            ->add('logoPath', HiddenType::class, array(
                'required'  =>  false
            ))
            ->add('position')
            ->add('featured', CheckboxType::class, array(
                'required'  => false,
            ))
            ->add('idTblPhotoCat', HiddenType::class)
            ->add('pub', CheckboxType::class, array(
                'required'  => false,
            ))
            ->add('categories', EntityType::class, array(
                'class'     => Category::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.idTblLingua = '.$this->lingua);
                },
                'choice_label'  => 'title',
                'multiple'  => true,
                'expanded'  => false,
                'required'  => true,
                'mapped'    => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Salva'))
            ->add('saveAndContinue', SubmitType::class, array('label' => 'Salva e continua'))
        ;
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
        return 'product_new';
    }
}
