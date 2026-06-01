<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class DatabaseHelper
{
    /**
     * Get database-specific DATE() function
     * 
     * @param string $column
     * @return string
     */
    public static function date($column)
    {
        $driver = config('database.default');
        $connection = config("database.connections.{$driver}.driver");
        
        switch ($connection) {
            case 'sqlite':
                return "DATE({$column})";
            case 'mysql':
                return "DATE({$column})";
            case 'pgsql':
                return "DATE({$column})";
            case 'sqlsrv':
                return "CAST({$column} AS DATE)";
            default:
                return "DATE({$column})";
        }
    }
    
    /**
     * Get database-specific YEAR() function
     * 
     * @param string $column
     * @return string
     */
    public static function year($column)
    {
        $driver = config('database.default');
        $connection = config("database.connections.{$driver}.driver");
        
        switch ($connection) {
            case 'sqlite':
                return "strftime('%Y', {$column})";
            case 'mysql':
                return "YEAR({$column})";
            case 'pgsql':
                return "EXTRACT(YEAR FROM {$column})";
            case 'sqlsrv':
                return "YEAR({$column})";
            default:
                return "YEAR({$column})";
        }
    }
    
    /**
     * Get database-specific MONTH() function
     * 
     * @param string $column
     * @return string
     */
    public static function month($column)
    {
        $driver = config('database.default');
        $connection = config("database.connections.{$driver}.driver");
        
        switch ($connection) {
            case 'sqlite':
                return "strftime('%m', {$column})";
            case 'mysql':
                return "MONTH({$column})";
            case 'pgsql':
                return "EXTRACT(MONTH FROM {$column})";
            case 'sqlsrv':
                return "MONTH({$column})";
            default:
                return "MONTH({$column})";
        }
    }
    
    /**
     * Get database-specific DAY() function
     * 
     * @param string $column
     * @return string
     */
    public static function day($column)
    {
        $driver = config('database.default');
        $connection = config("database.connections.{$driver}.driver");
        
        switch ($connection) {
            case 'sqlite':
                return "strftime('%d', {$column})";
            case 'mysql':
                return "DAY({$column})";
            case 'pgsql':
                return "EXTRACT(DAY FROM {$column})";
            case 'sqlsrv':
                return "DAY({$column})";
            default:
                return "DAY({$column})";
        }
    }
}
