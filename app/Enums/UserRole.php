<?php

namespace App\Enums;


enum UserRole : String
{
    //
    case super_admin = 'super_admin';
    case admin = 'admin';
    case user = 'user';
}
