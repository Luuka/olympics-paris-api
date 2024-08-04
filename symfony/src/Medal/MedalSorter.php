<?php

namespace App\Medal;

class MedalSorter
{
    public function sort($medals): array
    {
        uasort($medals, function($a, $b) {
            // Compare gold medals
            if ($a['gold'] > $b['gold']) {
                return -1;
            } elseif ($a['gold'] < $b['gold']) {
                return 1;
            } else {
                // Gold medals are the same, compare silver medals
                if ($a['silver'] > $b['silver']) {
                    return -1;
                } elseif ($a['silver'] < $b['silver']) {
                    return 1;
                } else {
                    // Silver medals are the same, compare bronze medals
                    if ($a['bronze'] > $b['bronze']) {
                        return -1;
                    } elseif ($a['bronze'] < $b['bronze']) {
                        return 1;
                    } else {
                        return 0; // All medals are the same
                    }
                }
            }
        });

        return $medals;
    }
}