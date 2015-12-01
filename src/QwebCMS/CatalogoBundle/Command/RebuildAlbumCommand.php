<?php
/**
 * Created by PhpStorm.
 * User: Daniele
 * Date: 01/12/2015
 * Time: 09:31
 */

namespace QwebCMS\CatalogoBundle\Command;


use Liip\ImagineBundle\Exception\Binary\Loader\NotLoadableException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RebuildAlbumCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('rebuild:album')
            ->setDescription('Rigenera le immagini caricate in web/upload/ per ogni filtro, eliminando quelle presenti attualmente')
            ->addArgument(
                'id',
                InputArgument::OPTIONAL,
                'Id album da rigenerare'
            )
            ->addOption(
                'filters',
                null,
                InputOption::VALUE_OPTIONAL,
                'Ricostruisce solo le immagini di un filtro specifico'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $languageManager = $this->getContainer()->get('language.manager');

        /* @var FilterManager filterManager */
        $filterManager = $this->getContainer()->get('liip_imagine.filter.manager');
        /* @var CacheManager cacheManager */
        $cacheManager = $this->getContainer()->get('liip_imagine.cache.manager');
        /* @var DataManager dataManager */
        $dataManager = $this->getContainer()->get('liip_imagine.data.manager');

        $id = $input->getArgument('id');
        $filters = array($input->getOption('filters'));
        if (empty($filters)) {
            $filters = array_keys($filterManager->getFilterConfiguration()->all());
        }

        $photos = $em
            ->getRepository('QwebCMSCatalogoBundle:TblPhoto')
            ->findBy(array('idTblPhotoCat' => $id, 'idTblLingua' => $languageManager->getSessionLanguage()));

        foreach($photos as $photo){
            //$output->writeln($photo->getNome());
            $cacheManager->remove($photo->getImg(), $filters);

            foreach ($filters as $filter) {
                try {
                    if (!$cacheManager->isStored($photo->getImg(), $filter)) {
                        $binary = $dataManager->find($filter, $photo->getImg());
                        $cacheManager->store(
                            $filterManager->applyFilter($binary, $filter),
                            $photo->getImg(),
                            $filter
                        );
                    }
                    $output->writeln($cacheManager->resolve($photo->getImg(), $filter));
                } catch (NotLoadableException $e){
                    $em->remove($photo);
                    $em->flush();
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }
        }
    }
}