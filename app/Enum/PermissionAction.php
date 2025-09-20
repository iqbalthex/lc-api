<?php

namespace App\Enum;

use Illuminate\Database\Eloquent\Model;

enum PermissionAction: string
{
    case List = 'list';

    case View = 'view';

    case Create = 'create';

    case Update = 'update';

    public function getNameForModel(Model | string $model): string
    {
        return strtolower(class_basename($model)) . ':' . $this->value;
    }
}
