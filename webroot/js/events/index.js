const renderEvents = (events) => {

  const app = new Vue({

    el: '#events-table-container',

    data: {
      events: events,
      currentSortBy: 'id',
      search: '',
    },

    computed: {
      filteredEvents: function() {
        if (this.search.length === 0) {
          return this.events;
        }
        return this.events.filter(
          (event) => event.description.toLowerCase().indexOf(this.search.toLowerCase()) >= 0
        );
      }
    },

    methods: {
      formatEventDate: function(event) {
        return moment(event.when).format('YYYY MMM DD');
      },
      formatEventTime: function(event) {
        return moment(event.when).format('h:mm A');
      },
      sortBy: function(field) {
        this.currentSortBy = field;
        this.events = this.events.sort((eventA, eventB) => {
          const valueA = String(eventA[field]);
          const valueB = String(eventB[field]);
          return valueA.localeCompare(valueB);
        });
      },
      sortIndicator: function(field) {
        return this.currentSortBy === field ? '^' : '';
      },
      editURL: function(event) {
        return `/events/event/${event.id}`;
      },
      deleteEvent: function(event) {
        const idx = this.events.indexOf(event);
        this.events.splice(idx,1);
      }
    }
  })
};

fetchAllEvents()
  .then((events) => {
    renderEvents(events);
  })
  .catch((error) => {
    console.log(error);
  });
