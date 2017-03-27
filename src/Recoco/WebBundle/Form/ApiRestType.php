<?php

namespace Recoco\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Range;

class ApiRestType extends AbstractType
{

    const LATITUDE_MIN = -90;
    const LATITUDE_MAX = 90;
    const LONGITUDE_MIN = -180;
    const LONGITUDE_MAX = 180;


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude', NumberType::class, [
                'attr' => [
                    'min' => self::LATITUDE_MIN,
                    'max' => self::LATITUDE_MAX,
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new NotNull(),
                    new Range([
                        'min' => self::LATITUDE_MIN,
                        'max' => self::LATITUDE_MAX,
                    ]),
                ]
            ])
            ->add('longitude', NumberType::class, [
                'attr' => [
                    'min' => self::LONGITUDE_MIN,
                    'max' => self::LONGITUDE_MAX,
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new NotNull(),
                    new Range([
                        'min' => self::LONGITUDE_MIN,
                        'max' => self::LONGITUDE_MAX,
                    ]),
                ]
            ])
            ->add('distance', NumberType::class, [
                'empty_data'  => 100,
                'required' => true,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }

    public function getName() {
        return 'api_rest';
    }
}
