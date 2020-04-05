<?php

namespace App\Presentation\Services\Hash\Contracts;

/**
 * Interface HashInterface
 * @package App\Presentation\Services\Hash\Contracts
 */
interface HashInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function make(string $string): string;

    /**
     * @param string $string
     * @param string $hashedString
     * @return bool
     */
    public function check(string $string, string $hashedString): bool;
}
