<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
    public $hashAlgorithm = PASSWORD_BCRYPT;
    public $hashOptions = ['cost' => 12];
    public $sessionName = 'voting_system_session';
    public $sessionTimeout = 1800; // 30 minutes
    public $loginRoute = '/login';
    public $afterLoginRoute = '/dashboard';
    public $logoutRoute = '/logout';
}
