<?php

namespace App\Constants;

class ResponseStatusCodeConstants
{
    public const SUCCESS = 0;

    // User related error codes (1000-1999)
    public const USER_CREATE_FAILED = 1001;
    public const USER_UPDATE_FAILED = 1002;
    public const USER_DELETE_FAILED = 1003;
    public const USER_NOT_FOUND = 1004;

    // Authentication error codes (2000-2999)
    public const AUTH_FAILED = 2001;
    public const TOKEN_INVALID = 2002;

    // Validation error codes (3000-3999)
    public const VALIDATION_FAILED = 3001;

    // General error codes (9000-9999)
    public const GENERAL_ERROR = 9001;

    // Add corresponding messages
    public static array $messages = [
        self::SUCCESS => '',
        self::USER_CREATE_FAILED => 'Create User Failed',
        self::USER_UPDATE_FAILED => 'Update User Failed',
        self::USER_DELETE_FAILED => 'Delete User Failed',
        self::USER_NOT_FOUND => 'Failed to get data',
        self::AUTH_FAILED => 'Authentication Failed',
        self::TOKEN_INVALID => 'Invalid Token',
        self::VALIDATION_FAILED => 'Validation Failed',
        self::GENERAL_ERROR => 'An Error Occurred',
    ];
}
