<?php

class Whois {

    public function getWhois($domain, $pretty = false) {
        // setup blank return
        $returnData = ['Domain' => $domain, 'TLD' => '', 'Expire' => '', 'Days' => ''];

        // make domain lower case
        $domain = strtolower($domain);

        // strip the stuff we dont want.
        $domain = str_replace('www.','', $domain);
        $domain = str_replace('http://','', $domain);
        $domain = str_replace('https://','', $domain);

        // trim white space from domain.
        $domain = trim($domain);
        
        // try to find tld in list.
        $tld = $this->getTLDData($domain);
        if (!is_array($tld)) {
            // no match, update data and exit function
            if ($pretty) {
                $returnData['TLD'] = '<span class=\'badge bg-danger\'>' . $tld . '</span>';
            } else {
                $returnData['TLD'] = $tld;
            }
            return $returnData;
        }

        // add tld to return data
        $returnData['TLD'] = $tld['TLD'];

        // preform whois
        $raw = '';
        if ($whoisSocket = fsockopen($tld['Host'], 43, $errorCode, $errorMessagge, 15)) {

            // don't block connections
            socket_set_blocking($whoisSocket,false);
            
            // send request
            fputs($whoisSocket, "{$domain}\r\n");
 
            // set timeout
            $start = null;
            $timeout = ini_get('default_socket_timeout');
            if (!stream_set_timeout($whoisSocket, 1)) {
                // connection timedout
                if ($pretty) {
                    $returnData['Expire'] = '<span class=\'badge bg-danger\'>Failed connection timed out</span>';
                } else {
                    $returnData['Expire'] = 'Failed connection timed out';
                }
            } else {
                // read data
                while(!$this->safe_feof($whoisSocket, $start) && (microtime(true) - $start) < $timeout)
                {
                    $raw .= fgets($whoisSocket, 128);
                }
            
                // find expiry
                $mWorked = preg_match_all($tld['Expire'], $raw, $m, PREG_SET_ORDER);
                if (!$mWorked) {
                    // failed
                    if ($pretty) {
                        $returnData['Expire'] = '<span class=\'badge bg-danger\'>Failed to get data</span><br />' . $raw;
                    } else {
                        $returnData['Expire'] = 'Failed to get data';
                    }
                } else {
                    // parse expiry
                    $returnData['Expire'] = $m[0][3];
                    $whoisSocket = null;

                    $date = strtotime($returnData['Expire']);
                    $now = time();
                    $diff = $date - $now;

                    if (round($diff / (60 * 60 * 24)) < 30) {
                        if ($pretty) {
                            $returnData['Expire'] = '<span class=\'badge bg-danger\'>' . date('d/m/Y', $date) . '</span>';
                        } else {
                            $returnData['Expire'] = date('d/m/Y', $date);
                        }
                    } else {
                        if ($pretty) {
                            $returnData['Expire'] = '<span class=\'badge bg-success\'>' . date('d/m/Y', $date) . '</span>';
                        } else {
                            $returnData['Expire'] = date('d/m/Y', $date);
                        }
                    }
                    $returnData['Days'] .= round($diff / (60 * 60 * 24));
                }
            }
        } else {
            $returnData['Expire'] = $errorMessagge;
        }
        @fclose($whoisSocket);

        $whoisSocket = null;

        return $returnData;
    }

    function safe_feof($fp, &$start = NULL) {
        $start = microtime(true);
        return feof($fp);
    }

    function getTLDData($domain) {
        $found = preg_match('/\w*\.(.+\.?)+$/', $domain, $matches);
        if (!$found) {
            return 'Domain Parse Failed';
        }

        $tlddata = trim($matches[1]);

        switch ($tlddata) {
            case 'co.uk':
            case 'org.uk':
            case 'uk':
                return ['TLD' => $tlddata,'Host' => 'whois.nic.uk', 'Expire' => '/(.*?(\bExpiry date: (.*)\b))/', 'Date' => 'd-M-Y'];
            case 'com':
            case 'net':
                return ['TLD' => $tlddata,'Host' => 'whois.verisign-grs.com', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'biz':
                return ['TLD' => $tlddata,'Host' => 'whois.neulevel.biz', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'org':
                return ['TLD' => $tlddata,'Host' => 'whois.pir.org', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'mobi':
                return ['TLD' => $tlddata,'Host' => 'whois.dotmobiregistry.net', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'eu':
                return ['TLD' => $tlddata,'Host' => 'whois.eu', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'co':
                return ['TLD' => $tlddata,'Host' => 'whois.nic.co', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'me':
                return ['TLD' => $tlddata,'Host' => 'whois.nic.me', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'ws':
                return ['TLD' => $tlddata,'Host' => 'whois.website.ws', 'Expire' => '/(.*?(\Registrar Registration Expiration Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            case 'tv':
                return ['TLD' =>  $tlddata,'Host' => 'whois.nic.tv', 'Expire' => '/(.*?(\bRegistry Expiry Date: (.*)\b))/', 'Date' => 'Y-m-d'];
            default:
            Log::createLog("warning", "domainchecker", "Unsupported TLD: " . $tlddata);
                return 'Unknown TLD (' . $tlddata . ')';
        }
    }
}