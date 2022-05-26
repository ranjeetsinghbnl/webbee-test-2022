<?php
// EventsRepository

namespace App\Repositories;
use App\Models\Event;
use App\Http\Resources\EventsWithWorkshopsCollection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/***
 * Note:
 * we can use the following methods for scaling this query more
 * - Pagination
 * - chunk
 * - cursor
 * - use SQL join to get all the records in one sql(I avoid that to use Laravel schematics)
 */
class EventsRepository
{
  
  /**
   * function
   * @name EventsWithWorkshops
   * @description Get all the events and there workshops
   * @return Event Object
   */
  public function EventsWithWorkshops() {
    return new EventsWithWorkshopsCollection(Event::with('workshops')->get());
  }

  /**
   * function
   * @name getFutureEventsWithWorkshops
   * @description Get all the events that have not started yet
   * @return Event Object
   */
  public function getFutureEventsWithWorkshops() {
    // please run the seeder, 
    // because in the code previously older events are inserted with 2021, i have updated them to 2022 for testing
    return new EventsWithWorkshopsCollection(
      Event::with('workshops')->whereHas('workshops',function($query){
        $query->where('end' , '>=' ,  now()->toDateTimeString());
      })->get()
    );
  }
}