<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ModelListType extends AbstractType
{

    public function getParent()
    {
        return 'text';
    }
}