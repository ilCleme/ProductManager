<?php

namespace QwebCMS\CatalogoBundle\Naming;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;

class NomeNamer implements NamerInterface
{
    public function name(FileInterface $file)
    {

        return sprintf('%s', $file->getClientOriginalName());
    }
}