<?php

class Csrf
{
    private $length = 32; // longitud de nuestro token
    private $token; // token
    private $token_expiration = null; // tiempo de expiración
    private $expiration_time; // 5 minutos de expiración

    /*
	* Crear nuestro token si no existe y es el primer ingreso al sitio
	*/
    public function __construct($newToken = false, $timeExpiration = false)
    {
        if ($newToken !== false) {
            unset($_SESSION['csrf_token']);
        }
        if (!isset($_SESSION['csrf_token'])) {
            $this->generate($timeExpiration);
            $_SESSION['csrf_token'] =
                [
                    'token'      => $this->token,
                    'expiration' => $this->token_expiration
                ];
            return $this;
        }
        $this->token            = $_SESSION['csrf_token']['token'];
        $this->token_expiration = $_SESSION['csrf_token']['expiration'];
        setcookie("XSRF_umbrella",$this->token,0,'/','',true, true);
        return $this;
    }

    /*
	* Método para generar un nuevo token
	*/
    private function generate($timeExpiration)
    {
        if (function_exists('bin2hex')) {
            $this->token = password_hash(bin2hex(random_bytes($this->length)), PASSWORD_BCRYPT);
        } else {
            $this->token = password_hash(bin2hex(openssl_random_pseudo_bytes($this->length)), PASSWORD_BCRYPT);
        }
        setcookie("XSRF_umbrella",$this->token,0,'/','',true, true);
        if ($timeExpiration !== false && is_numeric($timeExpiration)) {
            $this->expiration_time = $timeExpiration;
            $this->token_expiration = time() + $this->expiration_time;
        }
        return;
    }

    /*
	* Validar el token de la petición con el del sistema
	*/
    public static function validate($csrf_token, $validate_expiration = false)
    {
        $self = new self();
        // Validando el tiempo de expiración del token
        if ($self->get_expiration() != null) { //entonces existe un tiempo de expiracion
            if ($validate_expiration && $self->get_expiration() < time()) {
                return false;
            }
        }

        if ($csrf_token !== $self->get_token()) {
            return false;
        }
        return true;
    }

    /* }
	* Método para obtener el token 
	*/
    public function get_token()
    {
        return $this->token;
    }

    /*
	* Método para obtener la expiración del token
	*/
    public function get_expiration()
    {
        return $this->token_expiration;
    }
}
