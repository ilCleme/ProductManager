<?php

namespace QwebCMS\CatalogoBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use QwebCMS\CatalogoBundle\Entity\TblPhoto as Foto;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct as Prodotto;


class UploadListener{

    public function __construct($doctrine, $container)
    {
        $this->doctrine = $doctrine;
        $this->container = $container;
    }

    public function onUpload(PostPersistEvent $event)
    {
        $type = $event->getType();

        if ($type == 'gallery'){
            $this->uploadGalleryType($event);
        } elseif ($type == 'planimetrie') {
            $this->uploadPlanimetriaType($event);
        }

        /*
         * Torno dei dati informativi tramite la response
         */
        //$response->offsetSet('id-album', $id_album );
        //$response->offsetSet('config', $event->getConfig() );
        //$response->offsetSet('src_path', $foto->getImg() );
        //$response->offsetSet('type', $event->getType() );
    }

    public function uploadGalleryType(PostPersistEvent $event){
        $request = $event->getRequest();
        $response = $event->getResponse();
        $id_album = $request->headers->get('id-album');

        $file_upload = $event->getFile();

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'img_preview');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'big_thumb');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'big_thumb_1');

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
    }

    public function uploadPlanimetriaType(PostPersistEvent $event){
        $request = $event->getRequest();
        $id_product = $request->headers->get('id-product');

        $file_upload = $event->getFile();

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'big_thumb');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'big_thumb_1');

        $em = $this->doctrine->getManager();

        $product = $em->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')->find($id_product);
        $product->setPlanimetria('/'.$file_upload->getPathname());

        $em->persist($product);
        $em->flush();
    }

}