<?php

namespace App\Http\Controllers;
use DevDojo\Chatter\Models\Models;
use App\Bill;

use Illuminate\Http\Request;
use Google\Cloud\Core\ServiceBuilder;

class SentimentController extends Controller
{
    //
    public function sentiment()
    {
        // Google cloud instantiations
        $cloud = new ServiceBuilder([
            'keyFilePath' => base_path('isproject.json'),
            'projectId' => 'isproject-252907'
        ]);
        $language = $cloud->language();

        // work on retrieving all bills
        $comments = Models::post()->all();

        $sscores = array();

        $magnitudes = array();

        // analyze each comment
        foreach ($comments as $comment) {
            $annotation = $language->analyzeSentiment(strip_tags($comment->body));
            $sentiment = $annotation->sentiment();

            array_push($sscores,$sentiment['score']);

            array_push($magnitudes, $sentiment['magnitude']);

            // echo $comment->body . '<br>';
            // echo 'Sentiment Score: ' . $sentiment['score'] .' , Magnitude: ' . $sentiment['magnitude'];
        }

        // average score of the sentiments
        $s = array_filter($sscores);
        $avscore = array_sum($s)/count($s);

        // average score of the magnitude

        $m = array_filter($magnitudes);
        $avmagnitudes = array_sum($m)/ count($m);

        // print_r($sscores);

        echo 'average sentiment score is ' . $avscore;

        echo '<br>';

        echo 'average magnitude score is ' . $avmagnitudes;
       
        
      
        

        
        }
}
