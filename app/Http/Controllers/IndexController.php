<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class IndexController extends Controller
{
	public function index(Request $request) {
		if(!$request->session()->exists('currencies')) {
			$html = 'https://www.cba.am/AM/SitePages/ExchangeArchive.aspx';
			$scc = stream_context_create(array("ssl" => array("verify_peer" => false,
														      "verify_peer_name" => false)));
			$content = file_get_contents($html, false, $scc);
			$doc = new \DOMDocument();
			libxml_use_internal_errors(true);
			$doc->loadHTML($content);
			libxml_clear_errors();
			foreach($doc->getElementsByTagName('div') as $div) {
				foreach ($div->attributes as $attr) {
					if ($attr->nodeName == 'class' and $attr->nodeValue == 'three_tables') {
						foreach($div->getElementsByTagName('span') as $currency) {
							if ($currency->childNodes->length) {
								Session::put('currencies.' . $currency->firstChild->data, $currency->nextSibling->firstChild->data);
							}
						}
					}
				}
			}
		}

		$date = Carbon::parse($request->date)->format('Y-m-d');

		$currencies = join(",", array_keys(Session::get('currencies')));
		$url = 'http://api.cba.am/ExchangeRatesToCSV.ashx?DateFrom=' . $date . '&DateTo=' . $date . '&ISOCodes=' . $currencies;

		$content = [];
		$file = fopen($url, 'r');

		if($file) {
			while ($row = fgetcsv($file)) {
				$content[] = $row;
			}
		}
		
		return view('site.index', [
			'content' => $content
		]);
	}
}