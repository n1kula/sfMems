<?php
namespace Mems\MemsBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class AddRatingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('rating', 'choice', array(
    'choices' => array('1' => '1', '2' => '2')
))
            
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mems\MemsBundle\Entity\Rating'
        ));
    }
    /**
     * @return integer
     */
    public function getName()
    {
        return 'mems_memsbundle_add_rating';
    }
}