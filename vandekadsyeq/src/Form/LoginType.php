<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginType extends AbstractType
{
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Username', TextType::class, array('required'=>true))
            ->add('password', PasswordType::class, array('required'=>true))
            ->add('Login', SubmitType::class)
        ;
    }
}