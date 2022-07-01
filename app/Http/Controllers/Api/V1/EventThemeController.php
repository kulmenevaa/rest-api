<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\EventTheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventThemeRequest;
use App\Http\Resources\EventThemeResource;

class EventThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = EventTheme::orderBy('created_at', 'desc')->get();
        return [
            'themes' => EventThemeResource::collection($themes)
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventThemeRequest $request)
    {
        $created = EventTheme::create($request->all());
        if($created) {
            return [
                'message'   => 'Тема мероприятия успешно создана!', 
                'theme'     => new EventThemeResource($created)
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EventTheme $theme)
    {
        return [
            'theme' => new EventThemeResource($theme)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventThemeRequest $request, EventTheme $theme)
    {
        $updated = $theme->update($request->all());
        if($updated) {
            return [
                'message'   => 'Тема мероприятия успешно обновлена!', 
                'theme'     => new EventThemeResource($theme)
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventTheme $theme)
    {
        $deleted = $theme->delete();
        if($deleted) {
            return [
                'message' => 'Тема мероприятия успешно удалена!',
            ];
        }
    }
}
