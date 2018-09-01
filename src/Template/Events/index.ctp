<div id="events-table-container">

  <div class="row">
    <div class="col-md-6 my-2">
      <label for="search">Search</label>
      <input
        type="search"
        id="search"
        class="form-control"
        v-model="search"
      />
    </div>
  </div>

  <table class="table">
    <tr>
      <th>
        <button
          type="button"
          class="btn btn-light btn-sm"
          v-on:click="sortBy('id')">
          Event Id
        </button>
         {{ sortIndicator('id') }}
      </th>
      <th>
        <button
          type="button"
          class="btn btn-light btn-sm"
          v-on:click="sortBy('description')">
          Description
        </button>
         {{ sortIndicator('description') }}
      </th>
      <th>
        <button
          type="button"
          class="btn btn-light btn-sm"
          v-on:click="sortBy('category')">
          Category
        </button>
         {{ sortIndicator('category') }}
      </th>
      <th>
        <button
          type="button"
          class="btn btn-light btn-sm"
          v-on:click="sortBy('when')">
          Date
        </button>
         {{ sortIndicator('when') }}
      </th>
      <th>Organizers</th>
      <th>Location</th>
      <th>
        <button
          type="button"
          class="btn btn-light btn-sm"
          v-on:click="sortBy('distance')">
          Distance
        </button>
        {{ sortIndicator('distance') }}
      </th>
      <th>Actions</th>
    </tr>
    <tr v-for="event in filteredEvents">
      <td>{{ event.id }}</td>
      <td>{{ event.description }}</td>
      <td>{{ event.category }}</td>
      <td>
        {{ formatEventDate(event) }}<br>
        {{ formatEventTime(event) }}
      </td>
      <td>
        <span v-for="person in event.organizer">
          {{ person.name }} </br>
        </span>
      </td>
      <td>{{ event.location }}</td>
      <td>{{ event.distance }}</td>
      <td>
        <a v-bind:href="editURL(event)">Edit</a></br>
        <a href="#" v-on:click.prevent="deleteEvent(event)">Delete</a>
      </td>
    <tr>
  </table>
</div>

<script src="/js/api.js"></script>
<script src="/js/events/index.js"></script>
