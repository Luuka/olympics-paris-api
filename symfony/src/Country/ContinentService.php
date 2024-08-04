<?php

namespace App\Country;

class ContinentService
{
    const COUNTRY_CONTINENTS = [
        'ALG' => 'AF', 'ANG' => 'AF', 'BEN' => 'AF', 'BOT' => 'AF', 'BUR' => 'AF',
        'BDI' => 'AF', 'CMR' => 'AF', 'CPV' => 'AF', 'CAF' => 'AF', 'CHA' => 'AF',
        'COM' => 'AF', 'CGO' => 'AF', 'COD' => 'AF', 'CIV' => 'AF', 'DJI' => 'AF',
        'EGY' => 'AF', 'ERI' => 'AF', 'SWZ' => 'AF', 'ETH' => 'AF', 'GAB' => 'AF',
        'GAM' => 'AF', 'GHA' => 'AF', 'GUI' => 'AF', 'GBS' => 'AF', 'GEQ' => 'AF',
        'KEN' => 'AF', 'LES' => 'AF', 'LBR' => 'AF', 'LBA' => 'AF', 'MAD' => 'AF',
        'MAW' => 'AF', 'MLI' => 'AF', 'MAR' => 'AF', 'MRI' => 'AF', 'MTN' => 'AF',
        'MOZ' => 'AF', 'NAM' => 'AF', 'NIG' => 'AF', 'NGR' => 'AF', 'UGA' => 'AF',
        'RWA' => 'AF', 'STP' => 'AF', 'SEN' => 'AF', 'SEY' => 'AF', 'SLE' => 'AF',
        'SOM' => 'AF', 'RSA' => 'AF', 'SSD' => 'AF', 'SUD' => 'AF', 'TAN' => 'AF',
        'TOG' => 'AF', 'TUN' => 'AF', 'ZAM' => 'AF', 'ZIM' => 'AF',

        'ANT' => 'AM', 'ARG' => 'AM', 'ARU' => 'AM', 'BAH' => 'AM', 'BAR' => 'AM',
        'BIZ' => 'AM', 'BER' => 'AM', 'BOL' => 'AM', 'BRA' => 'AM', 'CAY' => 'AM',
        'CAN' => 'AM', 'CHI' => 'AM', 'COL' => 'AM', 'CRC' => 'AM', 'CUB' => 'AM',
        'DOM' => 'AM', 'DMA' => 'AM', 'ESA' => 'AM', 'ECU' => 'AM', 'GRN' => 'AM',
        'GUA' => 'AM', 'GUY' => 'AM', 'HAI' => 'AM', 'HON' => 'AM', 'JAM' => 'AM',
        'MEX' => 'AM', 'NCA' => 'AM', 'PAN' => 'AM', 'PAR' => 'AM', 'PER' => 'AM',
        'PUR' => 'AM', 'SKN' => 'AM', 'LCA' => 'AM', 'VIN' => 'AM', 'SUR' => 'AM',
        'TTO' => 'AM', 'USA' => 'AM', 'URU' => 'AM', 'VEN' => 'AM', 'IVB' => 'AM',
        'ISV' => 'AM',

        'AFG' => 'AS', 'BRN' => 'AS', 'BAN' => 'AS', 'BHU' => 'AS', 'BRU' => 'AS',
        'CAM' => 'AS', 'CHN' => 'AS', 'KOR' => 'AS', 'HKG' => 'AS', 'IND' => 'AS',
        'INA' => 'AS', 'IRI' => 'AS', 'IRQ' => 'AS', 'JPN' => 'AS', 'JOR' => 'AS',
        'KAZ' => 'AS', 'KGZ' => 'AS', 'KUW' => 'AS', 'LAO' => 'AS', 'LBN' => 'AS',
        'MAS' => 'AS', 'MDV' => 'AS', 'MGL' => 'AS', 'MYA' => 'AS', 'NEP' => 'AS',
        'OMA' => 'AS', 'PAK' => 'AS', 'PLE' => 'AS', 'PHI' => 'AS', 'QAT' => 'AS',
        'PRK' => 'AS', 'KSA' => 'AS', 'SGP' => 'AS', 'SRI' => 'AS', 'SYR' => 'AS',
        'TJK' => 'AS', 'TPE' => 'AS', 'THA' => 'AS', 'TLS' => 'AS', 'TKM' => 'AS',
        'UAE' => 'AS', 'UZB' => 'AS', 'VIE' => 'AS', 'YEM' => 'AS',

        'ALB' => 'EU', 'AND' => 'EU', 'ARM' => 'EU', 'AUT' => 'EU', 'AZE' => 'EU',
        'BEL' => 'EU', 'BIH' => 'EU', 'BUL' => 'EU', 'CYP' => 'EU', 'CRO' => 'EU',
        'CZE' => 'EU', 'DEN' => 'EU', 'ESP' => 'EU', 'EST' => 'EU', 'FIN' => 'EU',
        'FRA' => 'EU', 'GEO' => 'EU', 'GER' => 'EU', 'GBR' => 'EU', 'GRE' => 'EU',
        'HUN' => 'EU', 'IRL' => 'EU', 'ISL' => 'EU', 'ISR' => 'EU', 'ITA' => 'EU',
        'KOS' => 'EU', 'LAT' => 'EU', 'LIE' => 'EU', 'LTU' => 'EU', 'LUX' => 'EU',
        'MKD' => 'EU', 'MLT' => 'EU', 'MDA' => 'EU', 'MON' => 'EU', 'MNE' => 'EU',
        'NED' => 'EU', 'NOR' => 'EU', 'POL' => 'EU', 'POR' => 'EU', 'ROU' => 'EU',
        'SMR' => 'EU', 'SRB' => 'EU', 'SVK' => 'EU', 'SLO' => 'EU', 'SWE' => 'EU',
        'SUI' => 'EU', 'TUR' => 'EU', 'UKR' => 'EU',

        'ASA' => 'OC', 'AUS' => 'OC', 'COK' => 'OC', 'FIJ' => 'OC', 'GUM' => 'OC',
        'KIR' => 'OC', 'MHL' => 'OC', 'FSM' => 'OC', 'NRU' => 'OC', 'NZL' => 'OC',
        'PLW' => 'OC', 'PNG' => 'OC', 'SOL' => 'OC', 'SAM' => 'OC', 'TGA' => 'OC',
        'TUV' => 'OC', 'VAN' => 'OC',
    ];

    public function getContinent(string $countryCode): string
    {
        return self::COUNTRY_CONTINENTS[$countryCode];
    }
}