<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Rol extends Role
{
    /**
     * Busquedor General.
     */
    #[Scope]
    protected function buscador(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('name', "%{$search}%")
                ->orWhereLike('created_at', "%{$search}%");
        });
    }
}