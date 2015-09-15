<?php

namespace QwebCMS\CatalogoBundle\Naming;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;

class NomeNamer implements NamerInterface
{
    public function name(FileInterface $file)
    {
        $stringa = $file->getClientOriginalName();
        $stringa = str_replace(" ", "", $stringa);
        return sprintf('%s', $stringa);
    }
}