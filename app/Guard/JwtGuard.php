<?php


namespace App\Guard;

use App\Exceptions\UserModelNotFoundException;
use App\Exceptions\Token\TokenInvalidException;
use App\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Keychain;

class JwtGuard implements Guard
{
    use GuardHelpers;

    /**
     * @var mixed
     */
    protected $request;
    /**
     * @var mixed
     */
    protected $provider;
    /**
     * @var mixed
     */
    protected $user;

    /**
     * Create a new authentication guard.
     * @param \Illuminate\Contracts\Auth\UserProvider $provider
     * @param \Illuminate\Http\Request $request
     * @param string $key
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request, $key = 'token')
    {
        $this->key = $key;
        $this->request = $request;
        $this->provider = $provider;
        $this->user = null;
    }

    /**
     * Get the Request params from the current request
     * @return string
     */
    public function getRequestParams()
    {
        return $this->request->all();
    }

    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }
        //
    }

    public function validate(array $credentials = [])
    {
        if (empty($credentials['email']) || empty($credentials['password'])) {
            if (!$credentials = $this->getRequestParams()) {
                return false;
            }
        }
        $user = $this->provider->retrieveByCredentials($credentials);

        if (!is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
            $this->setUser($user);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the token for the current request.
     * @return string
     */
    public function getTokenForRequest()
    {
        $token = $this->request->query($this->key);

        if (empty($token)) {
            $token = $this->request->input($this->key);
        }

        if (empty($token)) {
            $token = $this->request->bearerToken();
        }

        if (empty($token)) {
            $token = $this->request->getPassword();
        }

        return $token;
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get the ID for the currently authenticated user.
     * @return string|null
     */
    public function id()
    {
        if ($user = $this->user()) {
            return $this->user()->getAuthIdentifier();
        }
    }

    public function check()
    {
        return !is_null($this->user());
    }

    /**
     * Determine if the current user is a guest.
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    public function getUserFromToken(string $bearerToken)
    {
        $token = (new Parser())->parse((string)$bearerToken);
        $valid = $token->verify(new \Lcobucci\JWT\Signer\Rsa\Sha256(), (new Keychain())->getPublicKey(config('jwt.public')));
        if ($valid) {
            if ($token->hasClaim('sub')) {
                $id = $token->getClaim('sub');
                $user = User::find($id);
                if (!is_null($user)) {
                    $this->setUser($user);
                } else {
                    throw new UserModelNotFoundException();
                }
            } else {
                throw new TokenInvalidException();
            }
        }
    }
}

