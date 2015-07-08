<?php

namespace QwebCMS\CatalogoBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use QwebCMS\CatalogoBundle\Entity\TblPhoto as Foto;


class UploadListener{

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
        //$this->container = $container;
    }

    public function onUpload(PostPersistEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();
        $id_album = $request->headers->get('id_album');

        /*
         * Estraggo il file dalla request e salvo i suoi dati su DB,
         * usando l'entità Foto
         */
        $file_upload = $event->getFile();

        /*$imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction(
                $request,         // http request
                'uploads/foo.jpg',      // original image you want to apply a filter to
                'my_thumb'              // filter defined in config.yml
            );

        // string to put directly in the "src" of the tag <img>
        $cacheManager = $this->container->get('liip_imagine.cache.manager');
        $srcPath = $cacheManager->getBrowserPath('uploads/foo.jpg', 'my_thumb');*/

        $foto = new Foto();
        $foto->setNome($file_upload->getFilename());
        $foto->setImg($file_upload->getPathname());
        $foto->setIdTblPhotoCat($id_album);

        $em = $this->doctrine->getManager();

        $em->persist($foto);
        $em->flush();

        /*
         * Torno dei dati informativi tramite la response
         */
        $response->offsetSet('id_album', $id_album );
        $response->offsetSet('config', $event->getConfig() );
        //$response->offsetSet('src_path', $srcPath );
    }

}