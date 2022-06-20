<?php

namespace App\Form;

use App\Entity\Feedback;
use App\Entity\Assignment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grade', NumberType::class, 
            [
                'label'=>'Grade',
                'attr' => [
                    'min' => 0,
                    'max' => 10
                ]
            ])
            ->add('comment', TextType::class, 
            [
                'label'=> 'Comment',
                'required' => true
            ])
            ->add('DateFeedback', DateType::class,
            [
                'label' => 'Date Feedback',
                'widget' => 'single_text'
            ])
            ->add('assignment', EntityType::class, 
            [
                'label' => 'Assignment',
                'required' => true,
                'class' => Assignment::class,
                'choice_label' => 'title',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'date_class' => Feedback::class
        ]);
    }
}
