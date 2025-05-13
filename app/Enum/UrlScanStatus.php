<?php

namespace App\Enum;

enum UrlScanStatus: int {

    case Submitted  = 1;

    case Processing = 2;

    case Processed  = 3;

    case Failed     = 4;
}
