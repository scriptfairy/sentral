# Sentral Events

## Overview

This is a partial application based on the provided spec. The back end is written in CakePHP 3 and the front end is written in Vue.js, used Google API to calculate the distance between locations and Bootstrap for responsive style.

For the back end data storage, I used default PHP session instead of typical database just to simplify the code.


## Limitations

* Only supports listing, editing, updating and deleting events. Add has not been included.

* Does not include participants because I run out of time.

* Only trivial search is done in the event listing page to search by description.

* Sorting of event listing is done on the Event Id, Description, Category, Date and Distance. The sorting is very simple and based on string sorting.

* Sorting by Distance is not accurate because is based on string value not actual number of km.

## Assumptions

* I assumed the description is the title of the event.

* I assumed the category is a fixed list.

* It was not clear how participants should work therefore I left it out.

## Notes

* The back end was developed with PHP 7.1 on Mac

* Has been designed and tested to run on Chrome, for example the front end uses `fetch()` for async requests, ES6 arrow functions, and HTML5 date and time inputs which are not available natively in all browsers.

* I hard coded most of the data including school address, listing of events.

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
