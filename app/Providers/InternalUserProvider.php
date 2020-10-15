<?php


namespace App\Providers;

use App\Exceptions\Token\TokenInvalidException;
use App\Exceptions\UserModelNotFoundException;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class InternalUserProvider implements UserProvider
{

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return (Hash::check($credentials['password'], $user->getAuthPassword()));
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            throw new UserModelNotFoundException();
        }
        $user = User::query()->where('email', $credentials['email']);

        if ($user->exists()) {
            return $user->first();
        }
        throw new UserModelNotFoundException();
    }

    public function retrieveById($identifier)
    {
        // TODO: Implement retrieveById() method.
    }

    public function retrieveByToken($identifier, $token)
    {
        $bearer = (new Parser())->parse((string)$token);
        $valid = $bearer->verify(new Sha256(), (new Keychain())->getPublicKey(config('jwt.public')));

        $user = null;
        if ($valid) {
            if ($token->hasClaim('sub')) {
                // New Token
                $id = $token->getClaim('sub');
                $user= User::find($id);
                if(!$user){
                    throw new UserModelNotFoundException();
                }
            }
            $this->auth->setUser($user);
        }else{
            throw new TokenInvalidException();
        }
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }
}
