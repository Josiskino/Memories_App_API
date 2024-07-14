<?php

// app/Services/UserEntityService.php

namespace App\Services;

use App\Models\Tourist;
use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;

class UserEntityService
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Crée un utilisateur et une entrée associée dans la table spécifique.
     *
     * @param array $data Les données de l'utilisateur.
     * @param string $role Le rôle de l'utilisateur.
     * @param string $modelClass Le modèle pour la table spécifique (Tourist ou Agency).
     * @param array $additionalData Les données supplémentaires pour la table spécifique.
     * @return Model L'utilisateur créé ou le modèle associé.
     */
    public function createUserEntity(array $data, string $role, string $modelClass, array $additionalData): Model
    {
        // Crée l'utilisateur
        $user = $this->authService->createUser($data, $role);

        // Crée l'entrée associée dans la table spécifique
        $modelClass::create(array_merge([
            'user_id' => $user->id,
        ], $additionalData));

        return $user;
    }
}
