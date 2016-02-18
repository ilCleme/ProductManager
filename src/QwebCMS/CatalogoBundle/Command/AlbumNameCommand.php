<?php

namespace QwebCMS\CatalogoBundle\Command;


use QwebCMS\CatalogoBundle\Entity\TblPhotoCat;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AlbumNameCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('catalogo:rename:album')
            ->setDescription('Imposta il nome dell\'album come il nome del prodotto associato');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $products = $em
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->findAll();

        foreach($products as $product){
            $id_album = $product->getIdTblPhotoCat();
            $output->writeln($id_album);
            $album = $em
                ->getRepository('QwebCMSCatalogoBundle:TblPhotoCat')
                ->find($id_album);

            $output->writeln("Album con id ".$id_album." collegato al prodotto con nome ".$product->getTitle()." e rinominato come tale");

            $album->setNome($product->getTitle());
            $em->persist($album);
            $em->flush();
        }
    }
}