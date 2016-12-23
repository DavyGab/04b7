<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LyceenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('codePostal', 'text')
            ->add('ville')
            ->add('ecole')
            ->add('niveauDetude')
            ->add('offre', ChoiceType::class, array(
                'choices'  => array(
                    1 =>'Pack Light',
                    2 => 'Pack Full',
                    3 => 'Pack Sur mesure',
                ),
            ))
            ->add('bulletinsTempFile', 'file', array('required' => false))
            ->add('Envoyer', 'submit');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Utilisateurs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_lyceen';
    }


}
