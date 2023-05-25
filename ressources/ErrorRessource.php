<?php

namespace Ressources;

use Core\Helper;
use Models\Country;

class ErrorRessource extends Ressource
{

    public function get404(): void
    {
        try {
            parent::get();
            $this->response_error(404, "This route doesn't exist . It didn't respect pattern");
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    
}
