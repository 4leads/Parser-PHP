<?php

namespace WhichBrowser\Analyser\Header;

use WhichBrowser\Analyser\Header\Useragent\Application;
use WhichBrowser\Analyser\Header\Useragent\Bot;
use WhichBrowser\Analyser\Header\Useragent\Browser;
use WhichBrowser\Analyser\Header\Useragent\Device;
use WhichBrowser\Analyser\Header\Useragent\Engine;
use WhichBrowser\Analyser\Header\Useragent\Os;
use WhichBrowser\Analyser\Header\Useragent\Using;

class Useragent
{
    use Os, Device, Browser, Application, Using, Engine, Bot;

    private $data;

    private $options;

    public function __construct($header, &$data, &$options)
    {
        $this->data =& $data;
        $this->options =& $options;

        /* Make sure we do not have a duplicate concatenated useragent string */
  
        $header = preg_replace("/^(Mozilla\/[0-9]\.[0-9].{20,})\s+Mozilla\/[0-9]\.[0-9].*$/iu", '$1', $header);

        /* Detect the basic information */

        $this->detectOperatingSystem($header)
             ->detectDevice($header)
             ->detectBrowser($header)
             ->detectApplication($header)
             ->detectUsing($header)
             ->detectEngine($header);

         /* Detect bots */

        if (!isset($this->options->detectBots) || $this->options->detectBots === true) {
            $this->detectBot($header);
        }

        /* Refine some of the information */

        $this->refineBrowser($header)
             ->refineOperatingSystem($header);
    }

    private function removeKnownPrefixes($ua)
    {
        $ua = preg_replace('/^OneBrowser\/[0-9.]+\//', '', $ua);
        $ua = preg_replace('/^MQQBrowser\/[0-9.]+\//', '', $ua);
        return $ua;
    }
}
