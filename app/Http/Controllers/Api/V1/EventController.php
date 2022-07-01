<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return [
            'events' => EventResource::collection($events)
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $created = Event::create($request->all());
        if($created) {
            return [
                'message'   => 'Мероприятие успешно создано!', 
                'event'     => new EventResource($created)
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {  
        return [
            'event' => new EventResource($event)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $updated = $event->update($request->all());
        if($updated) {
            return [
                'message'   => 'Мероприятие успешно обновлено!', 
                'event'     => new EventResource($event)
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $deleted = $event->delete();
        if($deleted) {
            return [
                'message' => 'Мероприятие успешно удалено!',
            ];
        }
    }
}
