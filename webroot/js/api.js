const apiRequest = (path, body, options) => {
  const _options = options || {};
  const method = _options.method || 'GET';
  return new Promise((resolve, reject) => {

    const headers = {
      'X-Requested-With': 'XMLHttpRequest',
    };

    if (method === 'POST' && body) {
      headers['Content-Type'] = 'application/json; charset=utf-8';
    }

    const bodyJson = (method === 'POST' && body)
      ? JSON.stringify(body)
      : undefined;

    const options = {
      method: method,
      cache: 'no-cache',
      credentials: 'same-origin',
      headers: headers,
      body: bodyJson,
    };

    fetch(path, options)
      .then(response => response.json())
      .then(resolve)
      .catch(reject);
  });
};

const apiGet = (path) => apiRequest(path, undefined, { method: 'GET' });

const apiPost = (path, body) => apiRequest(path, body, { method: 'POST' });

const fetchEvent = (eventId) =>
  apiGet(`/events/api/?method=getevent&id=${eventId}`);

const fetchAllEvents = () =>
  apiGet(`/events/api/?method=getevents`);

const fetchDistance = (address) =>
  apiGet(`/events/api/?method=calculatedistance&address=${encodeURIComponent(address)}`);

const saveEvent = (event) =>
  apiPost(`/events/api/?method=saveevent`, event);
