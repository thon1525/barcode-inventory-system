<?php

namespace App\Http\Controllers;
use Goutte\Client;
use App\Http\Controllers\Goutte;
use Illuminate\Http\Request;

class ScrapeproController extends Controller
{
    private $results = array();
    
    public function scrapecommerces(){
        $client = new Client();
        $url = 'https://www.worldometers.info/coronavirus/';
        $page = $client->request('GET', $url);
       
        // echo $page->filter('.percent-off')->text();
    
        $page->filter('#main_table_countries_today')->each(function ($item) {
            $this->results[$item->filter('tbody')->text()] = $item->filter('.total_row_world')->text();
        });
        //  print_r($page);
           return $this->results;
    
       // return view('scrapeecommerce.scrapproduct');
    }
}
