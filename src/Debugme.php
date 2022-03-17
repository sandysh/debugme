<?php

namespace Sandysh\Debugme;

use Illuminate\Support\Facades\Route;

class Debugme
{

    public static function boot()
    {
        $debugMode = env('DEBUG_ME');
        $debugRoutes = env('DEBUG_ROUTES');
        $debugUrls = env('DEBUG_URLS');
        $debugIps = env('DEBUG_IPS');

        if ($debugMode) {
            if (self::checkIfIsDefined('debugIps')) {
               self::processIps($debugIps);
            } if (self::checkIfIsDefined('DEBUG_ROUTES')) {
                self::processRoutes($debugRoutes);
            } if (self::checkIfIsDefined('DEBUG_URLS')) {
                self::processUrls($debugUrls);
            }
        }
    }

    public function setVariables()
    {
        $this->debugMode = env('DEBUG_ME');
        $this->debugRoutes = env('DEBUG_ROUTES');
        $this->debugUrls = env('DEBUG_URLS');
        $this->debugIps = env('DEBUG_IPS');
    }


    public function checkIfIsDefined($var)
    {
        if ($var !== "" ) {
            return true;
        }
    }
    public function checkIfRoutesIsDefined()
    {
        if ($this->debugRoutes !== "" ) {
            return true;
        }
    }
    public function checkIfUrlsIsDefined()
    {
        if ($this->debugRoutes !== "" ) {
            return true;
        }
    }

    public function setDebugTrue()
    {
        config(['app.debug'=>true]);
    }


    public function processRoutes($debugRoutes)
    {
        $currentRoute = request()->route()->getName();
        $fragments =  explode(',',$debugRoutes);
        if (in_array($currentRoute, $fragments)) {
            self::setDebugTrue();
        }
    }

    public function processUrls($debugUrls)
    {
        $segments = request()->segments();
        $fragments =  explode(',',$debugUrls);
        if (array_intersect($segments, $fragments)) {
            self::setDebugTrue();
        }
    }

    public function processIps($debugIps)
    {
        $clientIps = request()->ips();
        if ($debugIps !== "" ) {
            $fragments =  explode(',',$debugIps);
            if (!array_intersect($clientIps, $fragments)) {
                return;
            }
        }
    }

}

$debugMe = new Debugme();
$debugMe->boot();
