<?php

namespace Oro\Bundle\FormBundle\Form\Extension;

use Oro\Bundle\FormBundle\Form\Extension\Traits\FormExtendedTypeTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataTransformerExtension extends AbstractTypeExtension
{
    use FormExtendedTypeTrait;

    /** @var ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['data_transformer']);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!empty($options['data_transformer'])) {
            $builder->addViewTransformer($this->container->get($options['data_transformer']));
        }
    }
}
