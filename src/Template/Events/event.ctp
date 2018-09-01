<div id="event-form-container">
  <form>

    <div class="form-group row">
      <div class="col-md-12">
        <label for="description">Description</label>
        <input
          type="text"
          id="description"
          class="form-control"
          placeholder="Description"
          v-model="event.description"
        >
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="category">Category</label>
        <select class="form-control" v-model="event.category" id="category">
          <option>Choose</option>
          <option value="Camp">Camp</option>
          <option value="Excursion">Excursion</option>
          <option value="Co-Curricular">Co-Curricular</option>
          <option value="Others">Others</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="eventDate">Date</label>
        <input
          v-model="eventDate"
          class="form-control"
          id="eventDate"
          type="date"
        />
      </div>

      <div class="col-md-4">
        <label for="eventTime">Time</label>
        <input
          v-model="eventTime"
          class="form-control"
          id="eventTime"
          type="time"
        />
      </div>

    </div>

    <h4>Organizers</h4>

    <div
      v-for="organizer in event.organizer"
      v-bind:organizer="organizer"
      v-bind:key="organizer.id"
      class="form-group row"
    >
      <div class="col-md-4">
        <label for="name">Name</label>
        <input
          v-model="organizer.name"
          class="form-control"
          type="text"
        />
      </div>
      <div class="col-md-5">
        <label for="email">Email</label>
        <input
          v-model="organizer.email"
          class="form-control"
          type="email"
        />
      </div>
      <div class="col-md-3">
        <label>&nbsp;</label><br>
        <button
          type="button"
          class="btn btn-danger"
          v-on:click="deleteOrganizer(organizer)">
          Delete
        </button>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="name">Name</label>
        <input
          v-model="newOrganizer.name"
          class="form-control"
          type="text"
        />
      </div>
      <div class="col-md-5">
        <label for="email">Email</label>
        <input
          v-model="newOrganizer.email"
          class="form-control"
          type="email"
        />
      </div>
      <div class="col-md-3">
        <label>&nbsp;</label><br>
        <button
          type="button"
          class="btn btn-primary"
          v-on:click="addOrganizer(newOrganizer)">
          Add organizer
        </button>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-7">
        <label for="location">Location</label>
        <input v-model="event.location" class="form-control" type="text" />
      </div>
      <div class="col-md-2">
        <label for="distance">Distance</label><br>
        <div class="py-2">{{ eventDistance }}</div>
      </div>
      <div class="col-md-3">
        <label>&nbsp;</label><br>
        <button
          type="button"
          class="btn btn-primary"
          v-on:click="calculateDistance()">
          Calculate Distance
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <button
          type="button"
          class="btn btn-primary"
          v-on:click="saveEvent()">
          Save Event
        </button>
      </div>
    </div>

  </form>

</div>

<script>
  const phpGlobal = {};
  phpGlobal["event"] = <?php echo json_encode($event, true); ?>;
</script>

<script src="/js/api.js"></script>
<script src="/js/events/event.js"></script>
