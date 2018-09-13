<?php
namespace App\Form;

use App\Entity\Authoriz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorizType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
            ->add('login')
            ->add('password')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        //parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver->setDefaults([
            'data_class' => Authoriz::class,
        ]);
    }
}