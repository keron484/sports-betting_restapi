<?php

namespace App\Http\Controllers;

use App\Models\Matchwinerresult;
use App\Models\Overunder;
use Illuminate\Http\Request;
use App\Models\Homeawaytotal;
class ResultsController extends Controller
{
    //
    //if results < 3 over 3.5 false and above
    //if results > 3 under 3.5 and below burn

    public function createOverUnderResults(Request $request){
        $request->validate([
            'hometeam_score' => 'required|numeric',
             'awayteam_score' => 'required|numeric'
        ]);
        
        //get the score total
        $scoreTotal = $request->hometeam_score + $request->awayteam_score;
        
        $data = [];
        //validating the over 
        $data['over_half'] = $scoreTotal >= 0.5;
        $data['over_one'] = $scoreTotal >= 1.5;
        $data['over_two'] = $scoreTotal >= 2.5;
        $data['over_three'] = $scoreTotal >= 3.5;
        $data['over_four'] = $scoreTotal >= 4.5;
        $data['over_five'] = $scoreTotal >= 5.5;
        $data['over_six'] = $scoreTotal >= 6.5;
        $data['under_half'] = $scoreTotal <= 0.5;
        $data['under_one'] = $scoreTotal <= 1.5;
        $data['under_two'] = $scoreTotal <= 2.5;
        $data['under_three'] = $scoreTotal <= 3.5;
        $data['under_four'] = $scoreTotal <= 4.5;
        $data['under_five'] = $scoreTotal <= 5.5;
        $data['under_six'] = $scoreTotal <= 6.5;
  
        Overunder::create($data);

        return response()->json(['message' => 'over under results created succesfully'], 200);

    }

    //function to update results 

    public function deleteResultoverunder(Request $request, $id){
        $underOverresult = Overunder::find($id);

        if(!$underOverresult){
            return response()->json(['message' => 'un authorised access'], 200);
        }

        $underOverresult->delete();
    
    }

    //function to get all result 
    public function getAllresultsoverunder(Request $request){
        $overunderresult = Overunder::all();
        return response()->json(['over_under_result' => $overunderresult], 200);
    }

    public function getParticularResult(Request $request, $id){
       $resultoverunder = Overunder::find($id);
       if(!$resultoverunder){
          return response()->json(['message' => 'unauthorised access to network problems']);
       }
      
       return response()->json(['over_under_results' => $resultoverunder], 200);
    }

    //match winner results generator

    //generate match winner result
    public function createMatchwinnerresult(Request $request){
        $request->validate([
            'hometeam_score' => 'required|numeric',
            'awayteam_score' => 'required|numeric'
        ]);
        
        $homeTeamscore = $request->hometeam_score;
        $awayTeamscore = $request->awayteam_score;
        
        $difference = $homeTeamscore - $awayTeamscore;

        $data = [];

        $data['hometeam_win'] = $homeTeamscore >  $awayTeamscore;
        $data['awayteam_win'] = $awayTeamscore > $homeTeamscore;
        $data['draw'] = $difference == 0;
        $data['home_doublechance'] = $homeTeamscore >=  $awayTeamscore;
        $data['away_doublechance'] = $awayTeamscore >= $homeTeamscore;
        $data['home_or_away'] = $difference >= 1 || $difference < 0;

        Matchwinerresult::create($data);

        return response()->json(['message' => 'created succesfully'], 200);
    }

    //get match results
    public function getmatchwinnerresult(Request $request){
        $matchwinnerResults = Matchwinerresult::all();
        return response()->json(['match_result_winner' => $matchwinnerResults], 200);
    }

    //function to delete results
    public function deletematchwinnerresult(Request $request, $id){
        $matchwinnerresult = Matchwinerresult::find($id);
        if(!$matchwinnerresult){
            return response()->json(['message' => 'unauthorised access or something went wronf'], 404);
        }

        $matchwinnerresult->delete();
        return response()->json(['message' => 'result deleted succesfully'], 200);
    }


    //results for hometotal and away total

    //function create results for home total and away team total

    public function createtotalhomeawayresult(Request $request){
        $request->validate([
            'hometeam_score' => 'required|numeric',
            'awayteam_score' => 'required|numeric'
        ]);

        $homeScore = $request->hometeam_score;
        $awayScore = $request->awayteam_score;

        $data = [];
        $data['hometotal_overhalf'] = $homeScore >= 1;
        $data['hometotal_overone'] = $homeScore >= 2;
        $data['hometotal_overtwo'] = $homeScore >= 3;
        $data['hometotal_overthree'] = $homeScore >= 4;
        $data['hometotal_overfour'] = $homeScore >= 5;
        $data['hometotal_overfive'] = $homeScore >= 6;
        $data['hometotal_underhalf'] = $homeScore < 1;
        $data['hometotal_underone'] = $homeScore < 2;
        $data['hometotal_undertwo'] = $homeScore < 3;
        $data['hometotal_underthree'] = $homeScore < 4;
        $data['hometotal_underfour'] = $homeScore < 5;
        $data['hometotal_underfive'] = $homeScore < 6;
        $data['hometotal_undersix'] = $homeScore < 7;
        $data['awaytotal_overhalf'] = $awayScore >= 1;
        $data['awaytotal_overone'] = $awayScore >= 2;
        $data['awaytotal_overtwo'] = $awayScore >= 3;
        $data['awaytotal_overthree'] = $awayScore >= 4;
        $data['awaytotal_overfour'] = $awayScore >= 5;
        $data['awaytotal_overfive'] = $awayScore >= 6;
        $data['awaytotal_underhalf'] = $awayScore < 1;
        $data['awaytotal_underone'] = $awayScore < 2;
        $data['awaytotal_undertwo'] = $awayScore < 3;
        $data['awaytotal_underthree'] = $awayScore < 4;
        $data['awaytotal_underfour'] = $awayScore < 5;
        $data['awaytotal_underfive'] = $awayScore < 6;
        $data['awaytotal_undersix'] = $awayScore < 7;

        Homeawaytotal::create($data);

        return response()->json(['message' => 'result created succesfully'], 200);
    }

    //function to getHome or awaytotal result
    public function getHomeAwayTotalResult(Request $request){
        $homeTotal_awayTotal_results = Homeawaytotal::all();
        return response()->json(['HomeAwayTotalResult' => $homeTotal_awayTotal_results], 200);
    }

    //function to delete results
    public function deleteHomeAwayResult(Request $request, $id){
        $homeawaytotalResults = Homeawaytotal::find($id);
        if(!$homeawaytotalResults){
            return response()->json(['message' => 'Unauthourised Access or Network error'], 404);
        }
        $homeawaytotalResults->delete();
        return response()->json(['message' => 'Result succesfully deleted'], 200);
    }


    //first half result settlements
    //creating results first half over under results
    public function createOverunderresultFirshalf(Request $request){
        $request->validate([
          'hometeamscore_1half' => 'required|numeric',
          'awayteamscore_2half' => 'required|numeric'
        ]);

        $scoreTotal = $request->hometeamscore_1half + $request->awayteamscore_2half;

        $data= [];

        $data['over_half'] = $scoreTotal >= 0.5;
        $data['over_one'] = $scoreTotal >= 1.5;
        $data['over_two'] = $scoreTotal >= 2.5;
        $data['over_three'] = $scoreTotal >= 3.5;
        $data['over_four'] = $scoreTotal >= 4.5;
        $data['over_five'] = $scoreTotal >= 5.5;
        $data['over_six'] = $scoreTotal >= 6.5;
        $data['under_half'] = $scoreTotal <= 0.5;
        $data['under_one'] = $scoreTotal <= 1.5;
        $data['under_two'] = $scoreTotal <= 2.5;
        $data['under_three'] = $scoreTotal <= 3.5;
        $data['under_four'] = $scoreTotal <= 4.5;
        $data['under_five'] = $scoreTotal <= 5.5;
        $data['under_six'] = $scoreTotal <= 6.5;
  
        
    }
}
