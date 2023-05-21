<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function (QueryExecuted $query) {
            $dumpQuery = [
                'SQL'   =>  $query->sql,
                'BINDINGS'  =>  $query->bindings,
                'TIME(ms)'  =>  $query->time,
            ];
            Log::channel('query')->info(print_r($dumpQuery,true));
            // Log::debug(print_r($dumpQuery,true));
        });
    }
}
