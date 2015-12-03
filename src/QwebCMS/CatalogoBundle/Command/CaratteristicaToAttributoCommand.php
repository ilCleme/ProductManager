<?php

namespace QwebCMS\CatalogoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CaratteristicaToAttributoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('catalogo:copy:caratteristica')
            ->setDescription('Copia il valore di una caratteristica associata al prodotto e lo inserisco in un campo del singolo prodotto sovrascrivendone il contenuto')
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'id della categoria di caratteristiche da cui recuperare il valore'
            )
            ->addArgument(
                'field',
                InputArgument::REQUIRED,
                'campo del prodotto da popolare con valore recuperato'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $languageManager = $this->getContainer()->get('language.manager');

        $id = $input->getArgument('id');
        $field = $input->getArgument('field');

        $products = $em
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->findBy(array('idTblLingua' => $languageManager->getSessionLanguage()));

        $set = 'set'.$field;

        foreach($products as $product){
            //$output->writeln($product->getTitle());

            $featurevalues = $product->getFeaturevalues();
            foreach ($featurevalues as $featurevalue) {
                //$output->writeln($featurevalue->getTitle());
                $features = $featurevalue->getFeatures();
                foreach ($features as $feature){
                    //$output->writeln($feature->getTitle());
                    if($feature->getIdTblCatalogueFeature() == $id){
                        $output->writeln("Copio in [".$product->getTitle()."] la caratteristica [".$featurevalue->getTitle()."] nel campo [".$field."]");
                        $product->$set($featurevalue->getTitle());

                        $em->persist($product);
                        $em->flush();
                    }
                }
            }

        }
    }
}