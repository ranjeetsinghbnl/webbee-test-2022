<?php
// EventsRepository
namespace App\Repositories;
use App\Models\Event;
use App\Http\Resources\EventsWithWorkshopsCollection;

class EventsRepository
{
  
  /**
   * function
   * @name EventsWithWorkshops
   * @description Get all the events and there workshops
   * @return Event Object
   */
  public function EventsWithWorkshops() {
    // we can use the following methods for scaling this query more ..
    // - Pagination
    // - chunk
    // - cursor
    // use SQL join here to get all the records in one sql(I avoid that to use Laravel schematics)
    return new EventsWithWorkshopsCollection(Event::with('workshops')->get());
  }
}