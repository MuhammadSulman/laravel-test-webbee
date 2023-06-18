<?php

namespace App\Enums\Traits;

trait Generic
{
    /**
     * all static function
     *
     * @return array
     */
    public static function all(): array
    {
        return collect(self::cases())
            ->map(
                function (self $mediaType) {
                    return $mediaType->value;
                }
            )->toArray();
    }

          /**
     * keyValueArray static function
     *
     * @return array
     */
    public static function keyValueArray(): array
    {
        return collect(self::cases())
            ->map(
                function (self $record) {
                    $name = $record->name;

                    if (str_contains($name, '_')) {
                        $name = str_replace('_', ' ', $name);
                    }

                    return ['key' => $record->value , 'value' => $name];
                }
            )->toArray();
    }
}
