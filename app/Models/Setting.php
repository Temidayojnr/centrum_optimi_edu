<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected const CACHE_KEY = 'settings.all';

    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * All settings as a key => value array, cached until a setting changes.
     */
    public static function allCached(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::pluck('value', 'key')->all();
        });
    }

    /**
     * Get the settings under a prefix (e.g. "about"), falling back to the given defaults.
     */
    public static function group(string $prefix, array $defaults = []): array
    {
        $stored = [];

        foreach (static::allCached() as $key => $value) {
            if (str_starts_with($key, $prefix . '.') && $value !== null && $value !== '') {
                $stored[substr($key, strlen($prefix) + 1)] = $value;
            }
        }

        return array_merge($defaults, $stored);
    }

    /**
     * Save several settings under a prefix and clear the cache.
     */
    public static function saveGroup(string $prefix, array $values): void
    {
        foreach ($values as $key => $value) {
            static::updateOrCreate(['key' => $prefix . '.' . $key], ['value' => $value]);
        }

        Cache::forget(self::CACHE_KEY);
    }
}
