<?php

namespace IlCleme\CatalogoBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class CategoryType extends AbstractType
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
            ->add('pub')
            ->add('position',HiddenType::class)
            ->add('categoriesParent', EntityType::class, array(
                'class' => 'IlCleme\CatalogoBundle\Entity\Category',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.idTblLingua = '.$this->lingua);
                },
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ))
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
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IlCleme\CatalogoBundle\Entity\Category'
        ));

        $resolver->setRequired('language');
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'new_category';
    }
}
