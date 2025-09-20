<?php

namespace App\Http\Controllers;

use App\Enum\PermissionAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function alertSuccess(string $message): void
    {
        session()->flash('alert', ['type' => 'success', 'message' => $message]);
    }

    protected function alertError(string $message): void
    {
        session()->flash('alert', ['type' => 'error', 'message' => $message]);
    }

    protected function authorizeList($model): void
    {
        $this->authorize(PermissionAction::List, $model);
    }

    protected function authorizeView($model): void
    {
        $this->authorize(PermissionAction::View, $model);
    }

    protected function authorizeCreate($model): void
    {
        $this->authorize(PermissionAction::Create, $model);
    }

    protected function authorizeUpdate($model): void
    {
        $this->authorize(PermissionAction::Update, $model);
    }

    protected function authorize(PermissionAction $action, Model | string $model): void
    {
        /** @var User */
        $user = Auth::user();
        $can = $user->can($action->getNameForModel($model));

        if (! $can) {
            abort(403);
        }
    }
}
