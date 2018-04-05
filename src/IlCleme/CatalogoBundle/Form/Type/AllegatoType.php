<?php

namespace IlCleme\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
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
            ->add('id', 'text', array('disabled' => true))
            ->add('idTblLingua', 'hidden')
            ->add('nome')
            ->add('imageFile', VichFileType::class, array(
                'label'         => false,
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
            ))
            ->add('imageName', 'url', array('disabled' => true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => '\IlCleme\CatalogoBundle\Entity\Allegato',
        ));
    }

    public function getName()
    {
        return 'allegato';
    }
}
