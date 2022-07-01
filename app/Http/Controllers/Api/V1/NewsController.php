<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return [
            'news' => NewsResource::collection($news)
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $created = News::create($request->all());
        if($created) {
            return [
                'message'   => 'Новость успешно создана!', 
                'news'      => new NewsResource($created)
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return [
            'news' => new NewsResource($news)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $updated = $news->update($request->all());
        if($updated) {
            return [
                'message'   => 'Новость успешно обновлена!', 
                'news'      => new NewsResource($news)
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $deleted = $news->delete();
        if($deleted) {
            return [
                'message'   => 'Новость успешно удалена!',
            ];
        }
    }
}
