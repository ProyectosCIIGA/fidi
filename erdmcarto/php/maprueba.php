<!DOCTYPE html>
<html>
  <head>
    <title>Inset Overview Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="./index.js"></script>
<style>
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#container,
#map {
  height: 100%;
  width: 100%;
}

#map {
  position: relative;
}

#overview {
  position: absolute;
  left: 40px;
  height: 175px;
  width: 175px;
  bottom: 50px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}
      
      </style>      
  </head>
  <body>
    <div id="container">
      <div id="map"></div>
      <div id="overview"></div>
    </div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcF4oi3SweowzVYo29ifjqXJsl1eE7C8M&callback=initMap&libraries=&v=weekly"
      async
    ></script>
      
<script>
const OVERVIEW_DIFFERENCE = 5;
const OVERVIEW_MIN_ZOOM = 3;
const OVERVIEW_MAX_ZOOM = 10;

function initMap(): void {
  const mapOptions = {
    center: { lat: 50, lng: 8 },
    zoom: 7,
  };

  // instantiate the primary map
  map = new google.maps.Map(document.getElementById("map") as HTMLElement, {
    ...mapOptions,
  });

  // instantiate the overview map without controls
  overview = new google.maps.Map(
    document.getElementById("overview") as HTMLElement,
    {
      ...mapOptions,
      disableDefaultUI: true,
      gestureHandling: "none",
      zoomControl: false,
    }
  );

  function clamp(num, min, max) {
    return Math.min(Math.max(num, min), max);
  }

  map.addListener("bounds_changed", () => {
    overview.setCenter(map.getCenter()!);
    overview.setZoom(
      clamp(
        map.getZoom()! - OVERVIEW_DIFFERENCE,
        OVERVIEW_MIN_ZOOM,
        OVERVIEW_MAX_ZOOM
      )
    );
  });
}
      </script>

      
      
    <script>
let map, overview;
const OVERVIEW_DIFFERENCE = 5;
const OVERVIEW_MIN_ZOOM = 3;
const OVERVIEW_MAX_ZOOM = 10;

function initMap() {
  const mapOptions = {
    center: { lat: 50, lng: 8 },
    zoom: 7,
  };
  // instantiate the primary map
  map = new google.maps.Map(document.getElementById("map"), {
    ...mapOptions,
  });
  // instantiate the overview map without controls
  overview = new google.maps.Map(document.getElementById("overview"), {
    ...mapOptions,
    disableDefaultUI: true,
    gestureHandling: "none",
    zoomControl: false,
  });

  function clamp(num, min, max) {
    return Math.min(Math.max(num, min), max);
  }
  map.addListener("bounds_changed", () => {
    overview.setCenter(map.getCenter());
    overview.setZoom(
      clamp(
        map.getZoom() - OVERVIEW_DIFFERENCE,
        OVERVIEW_MIN_ZOOM,
        OVERVIEW_MAX_ZOOM
      )
    );
  });
}
      </script>  
  </body>
</html>