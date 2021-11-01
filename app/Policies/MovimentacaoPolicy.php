<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Access\Response;

class MovimentacaoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Authenticatable $user)
    {
        return $user->getGuardName() === "administrador"
            ? Response::allow()
            : Response::deny("Você não possui permissão para acessar esta página");
    }
}
