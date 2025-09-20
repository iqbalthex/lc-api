<?php

namespace App\Enum;

enum PermissionAction: string
{
    case List = 'list';

    case View = 'view';

    case Create = 'create';

    case Update = 'update';
}
