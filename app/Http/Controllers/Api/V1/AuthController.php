<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Connexion administrateur
     *
     * Retourne un token Sanctum pour les comptes administrateurs.
     *
     * @group Authentification
     * @unauthenticated
     *
     * @bodyParam email string required Adresse email de l'utilisateur. Example: admin@jss-gn.com
     * @bodyParam password string required Mot de passe du compte. Example: password
     *
     * @response 200 {
     *   "token": "1|xxxxxxxxxxxxxxxx",
     *   "user": {
     *     "id": 1,
     *     "name": "Admin",
     *     "email": "admin@jss-gn.com",
     *     "is_admin": true
     *   }
     * }
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $user = User::query()->where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Identifiants invalides.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (! $user->is_admin) {
            return response()->json([
                'message' => 'Ce compte n\'a pas les permissions administrateur.',
            ], Response::HTTP_FORBIDDEN);
        }

        $token = $user->createToken('admin-panel-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
            ],
        ]);
    }

    /**
     * Profil connecté
     *
     * Retourne les informations de l'utilisateur connecté.
     *
     * @group Authentification
     * @authenticated
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /**
     * Déconnexion
     *
     * Invalide le token Sanctum actuellement utilisé.
     *
     * @group Authentification
     * @authenticated
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json([
            'message' => 'Déconnecté.',
        ]);
    }
}
