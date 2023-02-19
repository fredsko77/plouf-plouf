<?php

namespace Core\File;

use Exception;


class FileException extends Exception
{

    public function __construct($path)
    {
        parent::__construct();
        $this->message = sprintf('Le fichier %s est introuvable', $path);
        $this->code = 404;
    }
}
