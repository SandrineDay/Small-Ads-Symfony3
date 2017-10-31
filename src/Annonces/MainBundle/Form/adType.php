<?php

namespace Annonces\MainBundle\Form;

use Annonces\MainBundle\AnnoncesMainBundle;
use Annonces\MainBundle\Entity\picture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class adType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class, array('label'=>'Titre'))
            ->add('description', TextareaType::class, array('label'=>'Description'))
            ->add('price', NumberType::class, array('label'=>'Prix'))
            ->add('category',EntityType::class,array('class'=>'Annonces\MainBundle\Entity\category','choice_label'=>'name','multiple'=>true,'expanded'=>true,'label'=>'Catégorie'))
            ->add('pictures',pictureType::class)
//            ->add('pictures', EntityType::class, array('class'=>'Annonces\MainBundle\Entity\picture','label'=>'Photos','choice_label'=>'path','multiple'=>true))
//            ->add('pictures', CollectionType::class, array('entry_type'=>FileType::class, 'allow_add'=>true,'allow_delete'=>true))
            ->add('valider',SubmitType::class, array('attr'=>array('class'=>'btn btn-primary pull-right')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Annonces\MainBundle\Entity\ad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'annonces_mainbundle_ad';
    }


}
