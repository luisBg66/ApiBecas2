<?php

namespace App\Policies;

use App\Models\User;

class UsuarioPolicy
{
    /**
     * Create a new policy instance.
     */

     public function viewAny(User $user)
     {
        return $user->role === 'Precidente'; // Solo administradores
    }

    /**
     * Determina si el usuario puede ver un registro específico.
     */
    public function view(User $user, User $usuario)
    {
        return $user->role === 'Precidente' || $user->id === $usuario->id; // Admin o dueño
    }

    /**
     * Determina si el usuario puede crear un nuevo registro.
     */
    public function create(User $user)
    {
        return $user->role === 'Precidente'; // Solo administradores
    }

    /**
     * Determina si el usuario puede actualizar un registro.
     */
    public function update(User $user, User $usuario)
    {
        return $user->role === 'Precidente' || $user->id === $usuario->id; // Admin o dueño
    }

    /**
     * Determina si el usuario puede eliminar un registro.
     */
    public function delete(User $user, User $usuario)
    {
        return $user->role === 'Precidente'; // Solo administradores
    }
}
