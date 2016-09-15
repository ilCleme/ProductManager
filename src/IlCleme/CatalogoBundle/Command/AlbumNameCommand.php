<?php

namespace IlCleme\CatalogoBundle\Command;


use IlCleme\CatalogoBundle\Entity\TblPhotoCat as Album;
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
            ->getRepository('IlClemeCatalogoBundle:TblCatalogueProduct')
            ->findAll();

        foreach($products as $product){
            $id_album = $product->getIdTblPhotoCat();
            if ($id_album != 0){
                $album = $em
                    ->getRepository('IlClemeCatalogoBundle:TblPhotoCat')
                    ->find($id_album);

                $album->setNome($product->getTitle());
            } else {
                $output->writeln("Prodotto senza album, creo album nuovo");
                $album = new Album();
                $album->setIdTblLingua(4);
                $album->setNome($product->getTitle());
                $album->setFotoBig("");
            }

            $em->persist($album);
            $em->flush();

            if ($id_album == 0){
                $product->setIdTblPhotoCat($album->getIdTblPhotoCat());
                $em->persist($product);
                $em->flush();
            }

            $output->writeln("Album con id ".$album->getId()." collegato al prodotto con nome ".$product->getTitle()." e rinominato come tale");
        }
    }
}