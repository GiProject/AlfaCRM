<?

namespace AlfaCRM;

class Client{

    public $subdomain;
    public $login;
    public $password;

    public function __construct($subdomain, $login, $password )
    {
        $this->subdomain = $subdomain;
        $this->login = $login;
        $this->password = $password;
    }
}
?>