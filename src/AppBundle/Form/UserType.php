<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity("email")
 */
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name', null, array('required' => true))
                ->add('last_name', null, array('required' => true))
                ->add('email', EmailType::class, array('required' => true))
                ->add('birth_date', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'))
                ->add('password', PasswordType::class, array('required' => true))
                ->add('roles' , ChoiceType::class, [
                    'choices' => [
                            'ROLE_ADMIN' => 'ROLE_ADMIN', 
                            'ROLE_USER' => 'ROLE_USER', 
                            'ROLE_CUSTOMER' => 'ROLE_CUSTOMER'
                        ],
                    'expanded' => true,
                    'multiple' => true,
                ])
                ->add('gender', ChoiceType::class, array(
                    'choices'  => array(
                    ' ' => "",
                    'Male' => 'M',
                    'Female' => 'F',))
                );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }
}
