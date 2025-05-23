<?php

namespace App\Services;

use App\Models\User;
use App\Enum\UserRole;
use App\Enum\StatisticsKey;
use App\Repositories\User\IUsersRepository;
use App\Exceptions\API\UnauthorizedAccessException;

use App\Exceptions\API\EntityNotFoundException;
use App\Exceptions\API\EntityAlreadyExistsException;
use App\Exceptions\API\InvalidCredentialsException;

use Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

final class UsersService {

    public final function __construct(
        
        private IUsersRepository  $db,
        private UserRolesService  $userRoles,
        private StatisticsService $statistics
    ) {}

    /**
     * @throws EntityAlreadyExistsException If the specified email already in se by other user.
     */
    public final function signup(string $name, string $email, string $plainPassword, int|UserRole $userRole = UserRole::User): User {

        // Check if the user role exists
        $userRoleId = is_int($userRole) ? $userRole : $userRole->value;
        $this->userRoles->getUserRoleById($userRoleId);

        if (!is_null($this->getUserByEmail($email, throwIfNotFound: false))) {

            throw new EntityAlreadyExistsException('User', 'email');
        }

        $user = $this->db->createUser($name, $email, Hash::make($plainPassword), $userRoleId);

        $this->statistics->increment(StatisticsKey::UsersCount);

        return $user;
    }

    /**
     * @throws EntityNotFoundException If the specified user not found and the $throwIfNotFound parameter is set to true.
     */
    public final function getUserById(int $id, bool $throwIfNotFound = true): ?User {

        if (!is_null($user = $this->db->getById($id))) {

            return $user;
        }

        if ($throwIfNotFound) {

            throw new EntityNotFoundException('User');
        }
        
        return null;
    }

    /**
     * @throws EntityNotFoundException If the specified user not found and the $throwIfNotFound parameter is set to true.
     */
    public final function getUserByEmail(string $email, bool $throwIfNotFound = true): ?User {

        if (!is_null($user = $this->db->getUserByEmail($email))) {

            return $user;
        }

        if ($throwIfNotFound) {

            throw new EntityNotFoundException('User');
        }
        
        return null;
    }

    /**
     * @throws InvalidCredentialsException If the specified credentials are invalid.
     */
    public final function generateAccessToken(string $email, string $plainPassword): string {

        if ($token = JWTAuth::attempt([ 'email' => $email, 'password' => $plainPassword ])) {
            
            return $token;
        }
        
        throw new InvalidCredentialsException();
    }

    public final function assertUserOfType(int $userId, int|UserRole $userRole): void {

        $user = $this->getUserById($userId);

        $userRole = is_int($userRole) ? UserRole::from($userRole) : $userRole;

        if ($user->userRole->enumCase !== $userRole) {

            throw new UnauthorizedAccessException();
        }
    }
}
