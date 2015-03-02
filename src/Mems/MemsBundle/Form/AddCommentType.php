<?php
namespace Mems\MemsBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class AddCommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', 'textarea', array(
                'label'     => false,
                'attr'      => array('placeholder' => "Treść komentarza")
            ))
            ->add('save', 'submit', array(
                'label'     => 'Dodaj komentarz',
                'attr'      => array(
                'class'     => 'btn btn-info',)))
        ;
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mems\MemsBundle\Entity\Comment'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'mems_memsbundle_add_comment';
    }
}