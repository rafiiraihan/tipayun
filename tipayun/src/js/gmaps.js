const loadGoogleMaps = () => {
  return new Promise((resolve, reject) => {
    const script = document.createElement("script");
    script.src =
      "https://maps.googleapis.com/maps/api/js?key=AIzaSyAIeNojORa0X1xKq0OArjWKPaeH3VmPGbI";
    script.async = true;
    script.defer = true;
    script.onerror = reject;
    script.onload = resolve;
    document.head.appendChild(script);
  });
};

const initMap = () => {
  const map = new google.maps.Map(document.querySelector(".info-map"), {
    center: { lat: -6.9175, lng: 107.6191 },
    zoom: 11.5,
    disableDefaultUI: true,
  });

  const bandungCoords = [
    { lat: -6.90558, lng: 107.79778 },
    { lat: -6.91561, lng: 107.79409 },
    { lat: -6.92127, lng: 107.79047 },
    { lat: -6.92903, lng: 107.783721 },
    { lat: -6.93243, lng: 107.77323 },
    { lat: -6.9521, lng: 107.7339 },
    { lat: -6.96885, lng: 107.70075 },
    { lat: -6.99979, lng: 107.63197 },
    { lat: -7.00774, lng: 107.62259 },
    { lat: -6.94749, lng: 107.59504 },
    { lat: -6.9368, lng: 107.55729 },
    { lat: -7.03213, lng: 107.5408 },
    { lat: -7.02804, lng: 107.52017 },
    { lat: -6.94096, lng: 107.54813 },
    { lat: -6.86369, lng: 107.50417 },
    { lat: -6.87239, lng: 107.46932 },
    { lat: -6.85018, lng: 107.49536 },
    { lat: -6.89285, lng: 107.61805 },
    { lat: -6.90216, lng: 107.66027 },
    { lat: -6.9051, lng: 107.68063 },
    { lat: -6.9141, lng: 107.70276 },
    { lat: -6.9323, lng: 107.7158 },
    { lat: -6.9388, lng: 107.7482 },
  ];

  const bandungPolygon = new google.maps.Polygon({
    paths: bandungCoords,
    strokeColor: "#00B6F1",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#00B6F1",
    fillOpacity: 0.35,
  });

  bandungPolygon.setMap(map);
};
