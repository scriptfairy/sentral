# Events

## Overview

This is a partial application to demonstrate an event listing page and edit page. The back end is written in CakePHP 3 and the front end is written in Vue.js, used Google API to calculate the distance between locations and Bootstrap for responsive style.

For the back end data storage, I used default PHP session instead of typical database just to simplify the code.

## Getting started

Prerequisites:

* PHP installed
* Composer installed

Running the application:

```
cd sentral
composer install --ignore-platform-reqs
bin/cake server
```

## Limitations

* Only supports listing, editing, updating and deleting events. Add has not been included.

* Does not include participants because I run out of time.

* Only trivial search is done in the event listing page to search by description.

* Sorting of event listing is done on the Event Id, Description, Category, Date and Distance. The sorting is very simple and based on string sorting.

* Sorting by Distance is not accurate because is based on string value not actual number of km.

## Assumptions

* I assumed the description is the title of the event.

* I assumed the category is a fixed list.

* I will add participants functionalities if needed.

## Notes

* The back end was developed with PHP 7.1 on Mac

* Has been designed and tested to run on Chrome, for example the front end uses `fetch()` for async requests, ES6 arrow functions, and HTML5 date and time inputs which are not available natively in all browsers.

* I hard coded most of the data including school address, listing of events.

* The core files for review are:

| File                                         | Purpose
|----------------------------------------------|-------------------------------------
| src/Controller/Component/EventsComponent.php | Data access component for event data.
| src/Controller/EventsController.php          | Handles Event API requests.
| src/Template/Events/event.ctp                | Template to edit an event.
| src/Template/Events/index.ctp                | Template to display event listing.
| src/Template/Layout/default.ctp              | Main layout for the pages.
| webroot/css/events/style.css                 | Events styles.
| webroot/js/events/event.js                   | Edit event front end code.
| webroot/js/events/index.js                   | Event listing front end code.
| webroot/js/api.js                            | Front end api methods.

## TODO

### General

* Improve UX everywhere. This is very primitive prototype code.

* Display spinners or something similar for asynchronous requests.

* Add proper error handling in both front end and back end.

* Add proper data validation.

### Event listing

* Implement adding events.

### Event Edit

* Allow the user to choose organizers from a list of organizers in the database.

* Event category would come from a lookup table.

* Make event location field an autocomplete using an address api and when an address is selected then automatically calculate the distance (rather than pressing a button).

* Add form validation such as email fields, or add blank data.
