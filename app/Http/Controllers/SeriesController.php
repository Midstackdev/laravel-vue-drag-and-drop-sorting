<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSeriesFormRequest;
use App\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function edit(Series $series)
    {
        //authorize
        $series->load('parts');
        return view('series.edit', compact('series'));
    }

    public function update(UpdateSeriesFormRequest $request)
    {
        
    }
}
