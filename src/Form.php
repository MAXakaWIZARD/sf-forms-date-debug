<?php
namespace App;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Date;

class Form extends AbstractType implements FormTypeInterface
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', [
                'label' => 'Title',
                'required' => true,
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('dt', 'date', [
                'label' => 'Date',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',
                'required' => false,
                'constraints' => [
                    new Date()
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'csrf_protection' => false,
                'allow_extra_fields' => true,
                'attr' => [
                    'id' => 'photoset_edit_form'
                ]
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
