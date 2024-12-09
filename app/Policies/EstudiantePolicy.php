<?php

namespace App\Policies;

use App\Models\Estudiante;
use App\Models\User;

class EstudiantePolicy
{
    public function delete(User $user, Estudiante $estudiante)
    {
        return $user->role === 'Precidente'; 
    }
}
