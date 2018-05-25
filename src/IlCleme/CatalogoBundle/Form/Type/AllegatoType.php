<?php

namespace IlCleme\CatalogoBundle\Form\Type;

use IlCleme\CatalogoBundle\Entity\Allegato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AllegatoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', TextType::class, array('disabled' => true))
            ->add('idTblLingua', HiddenType::class)
            ->add('nome')
            ->add('imageFile', VichFileType::class, array(
                'label'         => false,
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
            ))
            ->add('imageName', UrlType::class, array('disabled' => true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Allegato::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'allegato';
    }
}
