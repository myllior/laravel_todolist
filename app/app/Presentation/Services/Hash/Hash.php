<?php

namespace App\Presentation\Services\Hash;

use Illuminate\Hashing\HashManager;
use App\Presentation\Services\Hash\Contracts\HashInterface;

/**
 * Class Hash
 * @package App\Presentation\Services\Hash
 */
final class Hash implements HashInterface
{
    /**
     * @var HashManager
     */
    private HashManager $hash;

    /**
     * Hash constructor.
     * @param HashManager $hash
     */
    public function __construct(HashManager $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @param string $string
     * @return string
     */
    public function make(string $string): string
    {
        return $this->hash->make($string);
    }

    /**
     * @param string $string
     * @param string $hashedString
     * @return bool
     */
    public function check(string $string, string $hashedString): bool
    {
        return $this->hash->check($string, $hashedString);
    }
}
