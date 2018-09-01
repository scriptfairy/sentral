const event = phpGlobal.event;

const newOrganizer = () => ({
  name: '',
  email: '',
});

const renderEvent = (event) => {

  const app = new Vue({

    el: '#event-form-container',

    data: {
      event: event,
      newOrganizer: newOrganizer(),
    },

    computed: {

      eventDate: {
        get: function() {
          const [eventDate, eventTime] = this.event.when.split(' ');
          return eventDate;
        },
        set: function (value) {
          this.event.when = value + ' ' + this.eventTime;
        }
      },

      eventTime: {
        get: function() {
          const [eventDate, eventTime] = this.event.when.split(' ');
          return eventTime;
        },
        set: function (value) {
          this.event.when = this.eventDate + ' ' + value;
        }
      },

      eventDistance: function() {
        const distance = this.event.distance;
        return (typeof distance === 'string') && (distance.length > 0)
          ? this.event.distance
          : 'Not calculated';
      }

    },

    methods: {

      deleteOrganizer: function (organizer) {
        const organizers = this.event.organizer;
        organizers.splice(organizers.indexOf(organizer), 1);
      },

      addOrganizer: function () {
        const organizers = this.event.organizer;
        organizers.push(this.newOrganizer);
        this.newOrganizer = newOrganizer();
      },

      calculateDistance:  function() {
        fetchDistance(this.event.location)
          .then(data => {
            const distance = data.rows[0].elements[0].distance.text;
            this.event.distance = distance;
          })
          .catch(error => {
            console.log('Request failed', error)
          });
      },
      saveEvent: function() {
        saveEvent(event)
          .then(data => {
            window.location = '/';
          })
          .catch(error => {
            console.log('Request failed', error)
          });
      }
    }

  })
};

fetchEvent(phpGlobal.event.id)
  .then((event) => {
    renderEvent(event);
  })
  .catch((error) => {
    console.log(error);
  });
