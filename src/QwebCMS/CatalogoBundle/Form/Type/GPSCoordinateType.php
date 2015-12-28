<?php

namespace QwebCMS\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GPSCoordinateType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'gps_coordinate';
    }
}