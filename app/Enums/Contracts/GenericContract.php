<?php

namespace App\Enums\Contracts;

/**
 * GenericContract interface
 */
interface GenericContract
{
    /**
     * all function
     *
     * @return array
     */
    public static function all(): array;

    /**
     * keyValueArray function
     *
     * @return array
     */
    public static function keyValueArray(): array;
}
