<?php

use Carbon\Carbon;

function humanize_date($date)
{
    return $date ? Carbon::parse($date)->format('d M Y') : null;
}
