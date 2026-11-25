<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * In-memory static cache for the current request lifecycle
     *
     * @var array<string, string|null>|null
     */
    protected static ?array $runtimeCache = null;

    /**
     * Load all settings into runtime cache in a single query with persistent caching
     *
     * @return array<string, string|null>
     */
    public static function allSettings(): array
    {
        if (static::$runtimeCache !== null) {
            return static::$runtimeCache;
        }

        try {
            static::$runtimeCache = Cache::remember('all_site_settings', 86400, function () {
                return static::pluck('value', 'key')->all();
            });
        } catch (\Throwable $e) {
            static::$runtimeCache = static::pluck('value', 'key')->all();
        }

        return static::$runtimeCache ?? [];
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        $settings = static::allSettings();

        return array_key_exists($key, $settings) && $settings[$key] !== null
            ? (string) $settings[$key]
            : $default;
    }

    public static function set(string $key, ?string $value, string $group = 'general'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        // Invalidate both in-memory and persistent cache
        static::$runtimeCache = null;
        try {
            Cache::forget('all_site_settings');
        } catch (\Throwable $e) {
            // ignore
        }

        return $setting;
    }
}
