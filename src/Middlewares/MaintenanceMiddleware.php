<?php

namespace DGINX\LaravelMaintenance\Middlewares;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if($this->isMaintenanceActive()){
            $whitelistedIps = config('laravel_maintenance.whitelisted_ips', []);

            if(in_array($request->getClientIp(), $whitelistedIps)){
                return $next($request);
            }
            return response('Service down... Your Ip: ' . $request->getClientIp() , 503);
        } else {
            return $next($request);
        }
    }

    public function isMaintenanceActive() : bool
    {
        $settings = config('laravel_maintenance.type', "file");
        if($settings === "file"){
            if(file_exists(base_path(). '/.laravel-maintenance')){
                return true;
            }
        }

        return false;
    }

}
