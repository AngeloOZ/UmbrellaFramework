<?php
class Flasher
{
    private $valid_types = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    private $default = 'primary';
    private $type;
    private $msg;

    public static function new($sms, $type = null)
    {
        $type = strtolower($type);
        $self = new self();
        if ($type == null) {
            $self->type = $self->default;
        }
        $self->type = in_array($type, $self->valid_types) ? $type : $self->default;
        //Guardar las notificaciones
        if (is_array($sms)) {
            foreach ($sms as $sm) {
                $_SESSION[$self->type][] = $sm;
            }
            return true;
        }
        $_SESSION[$self->type][] = $sms;
        return true;
    }

    public static function flash()
    {
        $self = new self();
        $output = '';

        foreach ($self->valid_types as $type) {
            if (isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
                foreach ($_SESSION[$type] as $m) {
                    $output .= '<div class="alert alert-' . $type . ' alert-dismissible show fade" role="alert">';
                    $output .= $m;
                    $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                    </button>';
                    $output .= '</div>';
                }
                unset($_SESSION[$type]);
            }
        }
        return $output;
    }
}
