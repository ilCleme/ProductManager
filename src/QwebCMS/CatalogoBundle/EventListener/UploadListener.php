<?php

namespace QwebCMS\CatalogoBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use QwebCMS\CatalogoBundle\Entity\TblPhoto as Foto;


class UploadListener {

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
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
    }

}