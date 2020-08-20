<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSeriesFormRequest;
use App\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SeriesController extends Controller
{
    public function edit(Series $series)
    {
        //authorize
        $series->load('parts');
        return view('series.edit', compact('series'));
    }

    public function update(UpdateSeriesFormRequest $request, Series $series)
    {
        $series->title = $request->title;
        $series->save();

        // dd($request->parts);

        $series->parts->each(function ($parts, $index) use ($request) {
            $parts->timestamps = false;
            $parts->update(Arr::only($request->parts[$index], ['title', 'sort_order']));
            // dd(Arr::only($request->parts[$index], ['title', 'sort_order']));
        });
    }
}
