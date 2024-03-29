<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Class name',
                'required' => true
            ])
            ->add('StdQuantity', IntegerType::class, [
                'label' => 'Student Quantity',
                'required' => true,
                'attr' => [
                    'min' => 20,
                    'max' => 25
                ]
            ])
            ->add('studentList', EntityType::class, [
                'label' => 'List student',
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('student', FileType::class,
            [
                'label' => 'Add File',
                'data_class' => null,
                'required' => is_null($builder->getData()->getStudent())
            ])
            ->add('submit', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}
