<?php

namespace WhichBrowser\Analyser\Header\Useragent;

use WhichBrowser\Analyser\Header\Useragent\Device\Appliance;
use WhichBrowser\Analyser\Header\Useragent\Device\Cars;
use WhichBrowser\Analyser\Header\Useragent\Device\Ereader;
use WhichBrowser\Analyser\Header\Useragent\Device\Gaming;
use WhichBrowser\Analyser\Header\Useragent\Device\Gps;
use WhichBrowser\Analyser\Header\Useragent\Device\Media;
use WhichBrowser\Analyser\Header\Useragent\Device\Mobile;
use WhichBrowser\Analyser\Header\Useragent\Device\Pda;
use WhichBrowser\Analyser\Header\Useragent\Device\Phone;
use WhichBrowser\Analyser\Header\Useragent\Device\Printer;
use WhichBrowser\Analyser\Header\Useragent\Device\Signage;
use WhichBrowser\Analyser\Header\Useragent\Device\Tablet;
use WhichBrowser\Analyser\Header\Useragent\Device\Television;

trait Device
{
    use Appliance, Cars, Gps, Gaming, Ereader,
        Mobile, Media, Television, Signage,
        Printer, Tablet, Phone, Pda;

    private function &detectDevice($ua)
    {
        $this->detectAppliance($ua);
        $this->detectCars($ua);
        $this->detectGps($ua);
        $this->detectEreader($ua);
        $this->detectGaming($ua);
        $this->detectTelevision($ua);
        $this->detectSignage($ua);
        $this->detectMedia($ua);
        $this->detectPda($ua);
        $this->detectPrinter($ua);
        $this->detectTablet($ua);
        $this->detectPhone($ua);
        $this->detectMobile($ua);

        return $this;
    }
}
