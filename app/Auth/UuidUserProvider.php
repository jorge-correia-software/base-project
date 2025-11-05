<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;

class UuidUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * Validates UUID format before querying database to prevent SQL errors.
     */
    public function retrieveById($identifier): ?Authenticatable
    {
        // Validate UUID format
        if (!$this->isValidUuid($identifier)) {
            Log::warning('Invalid UUID format in authentication', [
                'identifier' => $identifier,
                'type' => gettype($identifier),
            ]);

            return null;
        }

        return parent::retrieveById($identifier);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * Validates UUID format before querying database.
     */
    public function retrieveByToken($identifier, $token): ?Authenticatable
    {
        // Validate UUID format
        if (!$this->isValidUuid($identifier)) {
            Log::warning('Invalid UUID format in remember token authentication', [
                'identifier' => $identifier,
                'type' => gettype($identifier),
            ]);

            return null;
        }

        return parent::retrieveByToken($identifier, $token);
    }

    /**
     * Validate UUID format.
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidUuid($value): bool
    {
        // Must be a string
        if (!is_string($value)) {
            return false;
        }

        // Check UUID v4 format: xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
        $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';

        return (bool) preg_match($pattern, $value);
    }
}
