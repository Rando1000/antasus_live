<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CacheInspector
{
    /**
     * Liefert das Pattern für Besucherstatistik-Keys inklusive Prefix.
     */
    public static function statsPattern()
    {
        $prefix = config('cache.prefix');
        // Falls Prefix gesetzt, IMMER mit Unterstrich abschließen!
        if ($prefix && !str_ends_with($prefix, '_')) {
            $prefix .= '_';
        }
        return $prefix . 'visitors_stats:%';
    }

    /**
     * Listet alle Einträge aus der Cache-Tabelle nach Pattern.
     */
    public static function list($pattern = null)
    {
        if (!$pattern) $pattern = self::statsPattern();

        return DB::table('cache')
            ->where('key', 'like', $pattern)
            ->select(['key', 'value', 'expiration'])
            ->orderByDesc('expiration')
            ->get()
            ->map(function ($item) {
                return [
                    'key'        => $item->key,
                    'value'      => self::parseValue($item->value),
                    'expiration' => $item->expiration,
                ];
            });
    }

    /**
     * Holt den Wert für einen gegebenen Key aus der Datenbank (nicht aus dem Cache!).
     */
    public static function get($key)
    {
        $row = DB::table('cache')->where('key', $key)->first();
        return $row ? self::parseValue($row->value) : null;
    }

    /**
     * Löscht einen einzelnen Eintrag direkt aus der Cache-Tabelle.
     */
    public static function delete($key)
    {
        // Immer direkt DB: Key kommt mit Prefix an!
        return DB::table('cache')->where('key', $key)->delete();
    }

    /**
     * Löscht ALLE Besucherstatistik-Keys (mit Prefix) aus der Datenbank.
     */
    public static function deleteAllVisitorStats()
    {
        $pattern = self::statsPattern();
        return DB::table('cache')->where('key', 'like', $pattern)->delete();
    }

    /**
     * Löscht alle Einträge nach Pattern aus der Cache-Tabelle (z. B. Bulk-Delete für Filter).
     */
    public static function deleteLike($pattern)
    {
        return DB::table('cache')->where('key', 'like', $pattern)->delete();
    }

    /**
     * Wert dekodieren: versuche JSON, sonst Serialisierung, sonst String.
     */
    protected static function parseValue($value)
    {
        if (is_null($value)) return '';
        if (self::isJson($value)) return json_decode($value, true);
        if (self::isSerialized($value)) return unserialize($value);
        return $value;
    }

    protected static function isJson($string)
    {
        if (!is_string($string)) return false;
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    protected static function isSerialized($value)
    {
        if (!is_string($value)) return false;
        return (@unserialize($value) !== false || $value === 'b:0;');
    }
}
