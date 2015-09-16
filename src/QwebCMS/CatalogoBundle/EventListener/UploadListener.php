<?php

namespace QwebCMS\CatalogoBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use QwebCMS\CatalogoBundle\Entity\TblPhoto as Foto;


class UploadListener{

    public function __construct($doctrine, $container)
    {
        $this->doctrine = $doctrine;
        $this->container = $container;
    }

    public function onUpload(PostPersistEvent $event)
    {

        $request = $event->getRequest();
        $response = $event->getResponse();
        $id_album = $request->headers->get('id-album');

        /*
         * Estraggo il file dalla request e salvo i suoi dati su DB,
         * usando l'entità Foto
         */
        $file_upload = $event->getFile();

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'img_preview');

        // string to put directly in the "src" of the tag <img>
        //$cacheManager = $this->container->get('liip_imagine.cache.manager');
        //$srcPath = $cacheManager->getBrowserPath($file_upload, 'img_preview');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'big_thumb');

        // string to put directly in the "src" of the tag <img>
        //$cacheManager = $this->container->get('liip_imagine.cache.manager');
        //$srcPath = $cacheManager->getBrowserPath($file_upload, 'big_thumb');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'big_thumb_1');

        // string to put directly in the "src" of the tag <img>
        //$cacheManager = $this->container->get('liip_imagine.cache.manager');
        //$srcPath = $cacheManager->getBrowserPath($file_upload, 'big_thumb_1');

        $foto = new Foto();
        $foto->setNome($file_upload->getFilename());
        $foto->setImg('/'.$file_upload->getPathname());
        $foto->setIdTblPhotoCat($id_album);

        $em = $this->doctrine->getManager();

        $em->persist($foto);
        $em->flush();

        $foto->setIdTblPhoto($foto->getId());
        $em->persist($foto);
        $em->flush();

        /*
         * Torno dei dati informativi tramite la response
         */
        //$response->offsetSet('id-album', $id_album );
        //$response->offsetSet('config', $event->getConfig() );
        //$response->offsetSet('src_path', $foto->getImg() );
    }

}