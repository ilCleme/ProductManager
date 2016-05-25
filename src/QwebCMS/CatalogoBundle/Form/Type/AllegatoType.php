<?php

namespace QwebCMS\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('imageFile', 'vich_file', array(
                'required'      => false,
                'label'         => false,
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
            ))
            ->add('imageName', 'url', array('disabled' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => '\QwebCMS\CatalogoBundle\Entity\Allegato',
        ));
    }

    public function getName()
    {
        return 'allegato';
    }
}