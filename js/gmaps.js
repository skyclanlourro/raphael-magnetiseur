require.config({
    paths: {
      "googlemapsapi": "googlemapsapi",
    },
    shim: {
      gmaps: {
        deps: ["googlemapsapi"],
        exports: "GMaps"
      }
    }
  });