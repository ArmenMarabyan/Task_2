<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class GraphsController extends Controller
{
    public function index(Request $request) {
		
		if(isset($request->fromDate) && isset($request->toDate)) {
			$fromDate = Carbon::parse($request->fromDate)->format('Y-m-d');
			$toDate = Carbon::parse($request->toDate)->format('Y-m-d');
			$currency = $request->currency;
			$url = 'http://api.cba.am/ExchangeRatesToCSV.ashx?DateFrom=' . $fromDate . '&DateTo=' . $toDate . '&ISOCodes=' . $currency;
			$content = [];
			$file = fopen($url, 'r');

			if($file) {
				while ($row = fgetcsv($file)) {
					$content[] = $row;
				}
			}

			$dates  = [];
			$values = [];

			for ($i = 1; $i < count($content); $i+=(count($content)/10)+1) {
				$dates[] = Carbon::createFromFormat("d/m/Y", $content[$i][0])->toDateString();
				$values[] = $content[$i][1];
			}
			
			$dates = implode('%0D%0A', $dates);
			$values = implode('%0D%0A', $values);

			$imageUrl = 'https://www.chartgo.com/preview.do?charttype=line&width=600&height=300&chrtbkgndcolor=gradientwhite&labelorientation=diagonal&subtitle=&xtitle=&ytitle=Price&source=&fonttypetitle=bold&fonttypelabel=bold&max_yaxis=&min_yaxis=&threshold=&legend=1&gradient=1&border=1&xaxis1=' . $dates . '&yaxis1=' . $values . '&group1=Group+1&groupcolor1=defaultgroupcolours&viewsource=mainView&language=en&sectionSetting=false&sectionSpecific=false&sectionData=false&usePost=';
		}

		
		$currencies = array_keys(Session::get('currencies'));
    	return view('site.graphs.index', [
    		'currencies' => $currencies,
    		'graph' => $imageUrl??''
    	]);
    }
}

