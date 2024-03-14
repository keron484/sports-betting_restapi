<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;
class webscrapperController extends Controller
{
   public function srapeData(){
    PantherTestCase::startWebServer();
    $chromeDriverPath = 'C:\Windows\chromedriver\chromedriver.exe'; // Set the path to the ChromeDriver executable here
    putenv("PANTHER_CHROME_DRIVER_BINARY=$chromeDriverPath");
    
    $client = Client::createChromeClient();
    $crawler = $client->request('GET', 'http://localhost:3000/');

    // Wait for the page content to load
    $client->waitFor('.App');

    // Extract data and store it in an array
    $data = [];

     $crawler->filter('.App')->each(function ($node) use (&$data) {
        $eventSelection = $node->filter('.event-selection')->text();
        $eventOdds = $node->filter('.event-odds')->text();
        $date = $node->filter('.date')->text();
        $subTitle = $node->filter('.sub-title')->text();
        $title = $node->filter('.title')->text();
        $times = $node->filter('.times')->text();
        $team = $node->filter('.team')->text();
        
        // Store the extracted data in an array
        $data[] = [
            'event_selection' => $eventSelection,
            'event_odds' => $eventOdds,
            'date' => $date,
            'sub_title' => $subTitle,
            'title' => $title,
            'times' => $times,
            'team' => $team
        ];
    });

    return response()->json(['data' => $data]);
   }
}
