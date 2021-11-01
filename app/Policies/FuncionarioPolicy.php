<?php

namespace App\Policies;

use App\Models\Funcionario;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Access\Response;

class FuncionarioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create the model.
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Authenticatable $user)
    {
        return $user->getGuardName() === "administrador"
            ? Response::allow()
            : Response::deny("Você não possui permissão para acessar esta página");
    }

    /**
     * Determine whether the user can update the model.
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Authenticatable $user, Funcionario $funcionario = null)
    {
        return $user->getGuardName() === "administrador" || $user->id === $funcionario->id
            ? Response::allow()
            : Response::deny("Você não possui permissão para acessar esta página");
    }

    /**
     * Determine whether the user can delete the model.
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Authenticatable $user, Funcionario $funcionario = null)
    {
        return $user->getGuardName() === "administrador"
            ? Response::allow()
            : Response::deny("Você não possui permissão para acessar esta página");
    }
}
