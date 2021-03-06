<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {

        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            // Add your dependencies
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            // If you haven't already, add the storage bundle
            // This example uses SonataDoctrineORMAdmin but
            // it works the same with the alternatives
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            // Then add SonataAdminBundle
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Skaphandrus\AppBundle\SkaphandrusAppBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new Lexik\Bundle\TranslationBundle\LexikTranslationBundle(),
            // new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            // You have 2 options to initialize the SonataUserBundle in your AppKernel,
            // you can select which bundle SonataUserBundle extends
            // Most of the cases, you'll want to extend FOSUserBundle though ;)
            // extend the ``FOSUserBundle``
            new FOS\UserBundle\FOSUserBundle(),
            //new Skaphandrus\AppBundle\UserBundle(),
            //new FOS\UserBundle\UserBundle(),
            //
            //
            //new UserBundle\UserBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new PUGX\AutocompleterBundle\PUGXAutocompleterBundle(),
            // FosCommentBundle, and dependencies
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\CommentBundle\FOSCommentBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            //new PUGX\AutocompleterBundle\PUGXAutocompleterBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            //new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            //new Application\Sonata\UserBundle\ApplicationSonataUserBundle()
            //new Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle(),
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            new FOS\MessageBundle\FOSMessageBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new BeSimple\I18nRoutingBundle\BeSimpleI18nRoutingBundle(),
            new Oneup\UploaderBundle\OneupUploaderBundle(),
//            new Skaphandrus\MadeiraBundle\SkaphandrusMadeiraBundle(),
            
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
