<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShapeController extends Controller
{
    public function draw()
    {
        $img = Image::canvas(1080, 786, '#ddd');
        // draw a filled blue circle
        $points = array(
            400,  600,  // Point 1 (x, y)
            600,  600, // Point 2 (x, y)
            500,  450,  // Point 3 (x, y)
        );
        
        // draw a filled blue polygon with red border
        $img->polygon($points, function ($draw) {
            $draw->border(2, '#000');
        });



        $points_1 = array(
            450,  480,  // Point 1 (x, y)
            550,  480, // Point 2 (x, y)
            500,  400,  // Point 3 (x, y)
        );

        $img->polygon($points_1, function ($draw) {
            $draw->background('#fff');
            $draw->border(1, '#000');
        });

        $points_2 = array(
            550,  620,  // Point 1 (x, y)
            650,  620, // Point 2 (x, y)
            600,  540,  // Point 3 (x, y)
        );

        $img->polygon($points_2, function ($draw) {
            $draw->background('#fff');
            $draw->border(1, '#000');
        });

        $points_3 = array(
            350,  620,  // Point 1 (x, y)
            450,  620, // Point 2 (x, y)
            400,  540,  // Point 3 (x, y)
        );

        $img->polygon($points_3, function ($draw) {
            $draw->background('#fff');
            $draw->border(1, '#000');
        });


        return $img->response('png');
    }
}
