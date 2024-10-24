<?php

namespace WhichBrowser;

use WhichBrowser\Analyser\Camouflage;
use WhichBrowser\Analyser\Corrections;
use WhichBrowser\Analyser\Derive;
use WhichBrowser\Analyser\Header;
use WhichBrowser\Constants;
use WhichBrowser\Model\Main;

class Analyser
{
    use Header, Derive, Corrections, Camouflage;

    private $data;

    private $options;

    private $headers = [];

    public function __construct($headers, $options = [])
    {
        $this->headers = $headers;
        $this->options = (object) $options;
    }

    public function setData(&$data)
    {
        $this->data =& $data;
    }

    public function &getData()
    {
        return $this->data;
    }

    public function analyse()
    {
        if (!isset($this->data)) {
            $this->data = new Main();
        }

        /* Start the actual analysing steps */

        $this->analyseHeaders()
             ->deriveInformation()
             ->applyCorrections()
             ->detectCamouflage()
             ->deriveDeviceSubType();
    }
}
