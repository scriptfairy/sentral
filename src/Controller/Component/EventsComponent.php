<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

// TODO: Replace most of the functioanlities in this component to a database.
// This class used to mock data for the purpose of the demo.
// Session is used to store data just for the purpose of simplifing the running of the application.
// In real world application a database will be used.
class EventsComponent extends Component {

  public $initialEvents = array(
    array(
      "id" => 1,
      "description" => "Luna Park Trip",
      "category" => "Excursion",
      "when" => "2018-09-10 17:30",
      "organizer" => array(
        array("id" => "100", "name" => "Brock Lee", "email" => "leeb@cheltenhamgirls.edu.au"),
        array("id" => "200", "name" => "Walter Melon", "email" => "melonw@cheltenhamgirls.edu.au")
      ),
      "location" => "1 Olympic Dr, Milsons Point NSW 2061",
      "distance" => "19.9 km"
      ),
    array(
      "id" => 2,
      "description" => "Bush Camp",
      "category" => "Camp",
      "when" => "2018-10-01 08:30",
      "organizer" => array(
        array("id" => "300", "name" => "Sue Vaneer", "email" => "vaneers@cheltenhamgirls.edu.au"),
        array("id" => "200", "name" => "Walter Melon", "email" => "melonw@cheltenhamgirls.edu.au")
      ),
      "location" => "614 Gooreengi Rd, North Arm Cove NSW 2324",
      "distance" => "191 km"
    ),
    array("id" => 3,
      "description" => "Museum night",
      "category" => "Co-Curricular",
      "when" => "2018-09-17 15:00",
      "organizer" => array(
        array("id" => "400", "name" => "Cliff Hange", "email" => "hangec@cheltenhamgirls.edu.au"),
        array("id" => "500", "name" => "Terry Aki", "email" => "akit@cheltenhamgirls.edu.au")
      ),
      "location" => "148 Darlinghurst Road, Darlinghurst",
      "distance" => "23.6 km"
    )
  );

  public function initialize(array $config) {
    // Uncomment this for fresh data.
    //$this->destroySession();
    $events = $this->getEvents();
    if (!$events) {
      $session = $this->request->session();
      $session->write('events', $this->initialEvents);
      $session->write('eventsNextId', 4);
    }
  }

  private function nextId() {
    $session = $this->request->session();
    $nextId = $session->read('eventsNextId');
    $session->write('eventsNextId', $nextId + 1);
    return $nextId;
  }

  public function addEvent($event) {
    $session = $this->request->session();
    $events = $session->read('events');
    $event["id"] = $this->nextId();
    array_push($events, $event);
    $events = $session->write('events', $events);
  }

  public function getEvents() {
    $session = $this->request->session();
    $events = $session->read('events');
    return $events;
  }

  public function getEvent($id) {
    $session = $this->request->session();
    $events = $session->read('events');
    $event = array_filter($events, function($event) use($id){
      return $event["id"] == $id;
    });
    return array_values($event)[0];
  }

  public function saveEvent($updatedEvent) {
    $events = $this->getEvents();
    $newEvents = [];
    foreach ($events as $event) {
      if($event["id"] == $updatedEvent["id"]){
        $newEvents[] = $updatedEvent;
      } else {
        $newEvents[] = $event;
      }
    }
    $session = $this->request->session();
    $events = $session->write('events', $newEvents);
  }

  public function clearEvents() {
    $session = $this->request->session();
    $events = $session->write('events', []);
  }

  // This is just for debugging
  public function destroySession() {
    $session = $this->request->session();
    $session->destroy();
  }

  // TODO: Move this to a seperate Google api component.
  public function calculateDistance($destinationAddress) {
    //TODO: Move to private environment config
    $apiKey = 'AIzaSyBIRx_ImloWH09IkqwqeVeN9r_L5-R54dE';

    // This should come database
    $originAddress = '175 Beecroft Rd, Cheltenham NSW 2119, Australia';

    $baseUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json';
    $requestUrlArr = array(
      $baseUrl,
      '?',
      'origins=',
      urlencode($originAddress),
      '&',
      'destinations=',
      urlencode($destinationAddress),
      '&',
      'key=',
      $apiKey
    );
    $requestUrl = implode("",$requestUrlArr);
    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $requestUrl,
      CURLOPT_USERAGENT => 'Christine Sample cURL Request'
    ));
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);
    return $resp;
  }

}
