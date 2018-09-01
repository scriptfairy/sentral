<?php
namespace App\Controller;

use App\Controller\AppController;
use Exception;

class EventsController extends AppController {
  public function initialize() {
    parent::initialize();
    $this->loadComponent('Events');
  }

  public function index() {
    $this->render();
  }

  public function event($id = null) {
    $event = $this->Events->getEvent($id);
    $this->set('event', $event);
    $this->render();
  }

  public function api() {
    $this->layout = 'ajax';
    $method = $this->request->getQuery('method');
    $encode = true;

    switch($method){
      case 'getevents':
        $data = $this->Events->getEvents();
      break;

      case 'getevent':
        $id = intval($this->request->getQuery('id'));
        $data = $this->Events->getEvent($id);
      break;

      case 'calculatedistance':
        $address = $this->request->getQuery('address');
        $data = $this->Events->calculateDistance($address);
        $encode = false;
      break;

      case 'saveevent':
        $event = $this->request->getData();
        $this->Events->saveEvent($event);
        $data = $event;
      break;
    }

    if($encode){
      $body = json_encode($data);
    } else {
      $body = $data;
    }

    return $this->response
      ->withType('application/json')
      ->withStringBody($body);
  }
}
