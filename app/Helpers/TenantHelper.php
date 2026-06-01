<?php

namespace App\Helpers;

use App\Models\Toko;
use Illuminate\Support\Facades\Cache;

class TenantHelper
{
    /**
     * Get current toko based on domain
     * 
     * @return Toko|null
     */
    public static function getCurrentToko()
    {
        $domain = request()->getHost();
        
        // Cache toko data for 1 hour to reduce database queries
        return Cache::remember("toko_{$domain}", 3600, function () use ($domain) {
            // Try to find toko by domain first
            $toko = Toko::where('domain', $domain)->first();
            
            // If not found by domain, get the first toko (for single tenant setup)
            if (!$toko) {
                $toko = Toko::first();
            }
            
            return $toko;
        });
    }
    
    /**
     * Clear toko cache
     * 
     * @param string|null $domain
     * @return void
     */
    public static function clearCache($domain = null)
    {
        $domain = $domain ?? request()->getHost();
        Cache::forget("toko_{$domain}");
    }
}
