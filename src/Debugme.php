<?php

namespace Sandysh\Debugme;


class Debugme
{

    public function boot()
    {
        $this->debugMode = env('DEBUG_ME');
        $this->debugUrls = env('DEBUG_URLS');
        $this->debugIps = env('DEBUG_IPS');

        if ($this->debugMode) {
            if ($this->checkIfIsDefined('debugIps')) {
               $this->processIps();
            } else {
                $this->processUrls();
            }
        }
    }

    public function checkIfIsDefined($var)
    {
        switch($var) {
            case 'debugIps': if($this->debugIps !== "") return true;
            case 'debugUrls': if ($this->debugUrls !== "") return true;
        }
    }

    public function setDebugTrue()
    {
        config(['app.debug'=>true]);
    }


    public function processUrls()
    {
        $segments = request()->segments();
        $fragments =  explode(',',$this->debugUrls);
        if (array_intersect($segments, $fragments)) {
            $this->setDebugTrue();
        }
    }

    public function processIps()
    {
        $clientIp = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        if ($this->debugIps !== "" ) {
            $fragments =  explode(',',$this->debugIps);
            if (in_array($clientIp, $fragments)) {
                $this->processUrls();
            } 
        } else {
            $this->setDebugTrue();
        }
    }

}
