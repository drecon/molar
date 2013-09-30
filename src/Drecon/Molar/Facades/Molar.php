<?php namespace Drecon\Molar\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Molar extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'molar'; }
 
}