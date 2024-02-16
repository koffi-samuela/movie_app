<?php

namespace App\Form;
use Symfony\Component\Validator\Constraints  as Assert;
use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType ;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Nom du film',
                'attr'=>[
                    'require'  => true,
                    'placeholder' => "Entrez le nom du film",
                    'class'=>'nom',                   

                ],


            ])
            ->add('description',TextareaType::class,[
                'label'=>'Description',
                'attr'=>[
                    'placeholder' => "Entrez la descrption du film",
                    'class'=>'description',                   

                ],


            ])
            ->add('rate',IntegerType::class,[
                'label'=>'Note du film',
                'attr'=>[
                    'placeholder' => "Entrez la note du film",
                    'class'=>'custom', 
                    'min'=>0,
                    'max'=>10         

                ],
            ])
            ->add('release_date',DateTimeType::class,[
                'label'=>'Date de sortie',
                'attr'=>[
                    // 'placeholder' => "Entrez le nom du film",
                    'class'=>'custom',                   

                ],


            ])
            ->add('image',TextType::class,[
                'label'=>'Image du film',
                'attr'=>[
                    // 'placeholder' => "Entrez le nom du film",
                    'class'=>'custom',                   

                ],


            ])
            // ->add('created_at')
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'name',
            ])
            ->add('actors', EntityType::class, [
                'class' => Actor::class,
'choice_label' => 'name',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
