var tambahRuteButton = document.querySelector("#tbl-rute");
var modal = document.querySelector("#buat-rute");
var closeModalButton = document.querySelector("#buat-rute .detail-box-tutup");
var redupElement = document.querySelector(".redup");
var formRute = document.getElementById("form-rute");
var bersihkanButton = document.getElementById("dtl-bersih");
var redupHentiElement = document.querySelector(".redup-henti");
var tambahHentiButton = document.querySelector(".tbh-rutedt");
var boxHentiElement = document.querySelector(".box-henti");

function showRedupHenti() {
  redupHentiElement.style.display = "flex";
}

function hideRedupHenti() {
  redupHentiElement.style.display = "none";
}

function showModal() {
  modal.style.display = "flex";
  redupElement.style.display = "block";
}

function hideModal() {
  modal.style.display = "none";
  redupElement.style.display = "none";
}

if (tambahHentiButton) {
  tambahHentiButton.addEventListener("click", function (event) {
    event.preventDefault();
    showRedupHenti();
  });
  redupHentiElement.addEventListener("click", function (event) {
    event.preventDefault();
    hideRedupHenti();
  });
  boxHentiElement.addEventListener("click", function (event) {
    event.stopPropagation();
  });
}

const urlParams = new URLSearchParams(window.location.search);
const successParam = urlParams.get("id");

if (successParam === "sukses") {
  const redupElement = document.querySelector(".redup-rutedt");
  if (redupElement) {
    redupElement.style.display = "flex";
    const newUrl = window.location.href.split("?")[0];
    history.replaceState({}, document.title, newUrl);
  }
}

document.getElementById("tbh-buat").addEventListener("click", function () {
  document.getElementById("redup-rutedt").style.display = "none";
});

if (tambahRuteButton) {
  tambahRuteButton.addEventListener("click", function (event) {
    event.preventDefault();
    showModal();
  });

  closeModalButton.addEventListener("click", function (event) {
    event.preventDefault();
    hideModal();
  });

  window.addEventListener("click", function (event) {
    if (event.target.classList.contains("redup")) {
      hideModal();
    }
  });
}

if (formRute) {
  formRute.addEventListener("submit", function (event) {
    var layanan = document.getElementById("isi-layanan").value;
    var rute = document.getElementById("isi-rute").value;
    var dari = document.getElementById("isi-dari").value;
    var tujuan = document.getElementById("isi-tujuan").value;
    var harga = document.getElementById("isi-harga").value;

    if (
      layanan === "" ||
      rute === "" ||
      dari === "" ||
      tujuan === "" ||
      harga === ""
    ) {
      event.preventDefault();
      alert("Harap isi semua field dengan benar!");
    }
  });
}

if (bersihkanButton) {
  bersihkanButton.addEventListener("click", function (event) {
    event.preventDefault();
    var inputFields = document.querySelectorAll("#buat-rute .detail-box-field");
    inputFields.forEach(function (field) {
      field.value = "";
    });
  });
}

if (document.getElementById("searchInput")) {
  const searchInput = document.getElementById("searchInput");
  searchInput.addEventListener("input", function () {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll(".tbody-rute tr");

    tableRows.forEach(function (row) {
      const rowData = row.textContent.toLowerCase();

      if (rowData.includes(searchValue)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
}

var editButtonsRute = document.querySelectorAll(".tbl-edit");
var modalEditRute = document.querySelector("#ubah-rute");
var closeModalEditRuteButton = document.querySelector(
  "#ubah-rute .detail-box-tutup"
);
var formEditRute = document.getElementById("form-ubah-rute");

function showEditRuteModal(event) {
  var idRute = event.currentTarget.getAttribute("data-id");
  var row = event.currentTarget.closest("tr");
  var namaRute = row.querySelector("td:nth-child(2)").textContent;
  var dariRute = row.querySelector("td:nth-child(3)").textContent;
  var tujuanRute = row.querySelector("td:nth-child(4)").textContent;
  var hargaRute = row
    .querySelector("td:nth-child(5)")
    .textContent.replace("Rp ", "");
  var layananRute = row.querySelector("td:nth-child(7)").textContent.trim();

  document.getElementById("ubah-id-rute").value = idRute;

  var layananDropdown = document.getElementById("ubah-layanan");
  var layananId = null;

  for (var i = 0; i < layananDropdown.options.length; i++) {
    if (layananDropdown.options[i].text === layananRute) {
      layananId = layananDropdown.options[i].value;
      break;
    }
  }

  if (layananId !== null) {
    layananDropdown.value = layananId;
  }

  document.getElementById("ubah-nama").value = namaRute;
  document.getElementById("ubah-dari").value = dariRute;
  document.getElementById("ubah-tujuan").value = tujuanRute;
  document.getElementById("ubah-harga").value = hargaRute;

  modalEditRute.style.display = "flex";
  redupElement.style.display = "block";
}

function hideEditRuteModal() {
  modalEditRute.style.display = "none";
  redupElement.style.display = "none";
}

editButtonsRute.forEach(function (button) {
  button.addEventListener("click", showEditRuteModal);
});

if (closeModalEditRuteButton) {
  closeModalEditRuteButton.addEventListener("click", function (event) {
    event.preventDefault();
    hideEditRuteModal();
  });
}

window.addEventListener("click", function (event) {
  if (event.target.classList.contains("redup")) {
    hideEditRuteModal();
  }
});

if (formEditRute) {
  formEditRute.addEventListener("submit", function (event) {
    var layananRute = document.getElementById("ubah-layanan").value;
    var namaRute = document.getElementById("ubah-nama").value;
    var dariRute = document.getElementById("ubah-dari").value;
    var tujuanRute = document.getElementById("ubah-tujuan").value;
    var hargaRute = document.getElementById("ubah-harga").value;

    if (
      layananRute === "" ||
      namaRute === "" ||
      dariRute === "" ||
      tujuanRute === "" ||
      hargaRute === ""
    ) {
      event.preventDefault();
      alert("Harap isi semua field dengan benar!");
    }
  });
}

if (document.getElementById("cariHenti")) {
  const searchInput = document.getElementById("cariHenti");
  searchInput.addEventListener("input", function () {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll(".tbody-henti tr");

    tableRows.forEach(function (row) {
      const rowData = row.innerText.toLowerCase();

      if (rowData.includes(searchValue)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
}

function submitForm(td) {
  var form = td.querySelector("form");
  form.submit();
}

function initMap() {
  var end = { lat: -6.892758, lng: 107.618033 };
  var start = { lat: -6.932413, lng: 107.773228 };
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 13,
    center: start,
    styles: [
      {
        featureType: "poi",
        elementType: "labels",
        stylers: [{ visibility: "off" }],
      },
    ],
  });

  var directionsService = new google.maps.DirectionsService();
  var directionsDisplay = new google.maps.DirectionsRenderer();

  var startMarker = new google.maps.Marker({
    position: start,
    map: map,
    icon: "assets/icon/halte.png",
  });
  var endMarker = new google.maps.Marker({
    position: end,
    map: map,
    icon: "assets/icon/halte.png",
  });

  var stops = [
    { location: { lat: -6.900333, lng: 107.612927 }, stopover: true },
    { location: { lat: -6.901185, lng: 107.624678 }, stopover: true },
    { location: { lat: -6.904006, lng: 107.62811 }, stopover: true },
    { location: { lat: -6.919006, lng: 107.631205 }, stopover: true },
    { location: { lat: -6.93747, lng: 107.606764 }, stopover: true },
    { location: { lat: -6.9347501, lng: 107.7692325 }, stopover: true },
  ];

  var request = {
    origin: start,
    destination: end,
    waypoints: stops,
    optimizeWaypoints: true,
    travelMode: "DRIVING",
  };

  var orang = new google.maps.Marker({
    position: { lat: -6.8959359, lng: 107.616574 },
    map: map,
    icon: "assets/icon/orang.png",
  });

  var jalankaki = {
    origin: orang.getPosition(),
    destination: end,
    travelMode: google.maps.TravelMode.WALKING,
  };

  directionsService.route(jalankaki, function (result, status) {
    if (status == "OK") {
      var path = result.routes[0].overview_path;
      var legs = result.routes[0].legs;
      for (i = 0; i < legs.length; i++) {
        var steps = legs[i].steps;
        for (j = 0; j < steps.length; j++) {
          var nextSegment = steps[j].path;
          for (k = 0; k < nextSegment.length; k++) {
            var stepLocation = nextSegment[k];
            var circle = new google.maps.Circle({
              strokeColor: "#F64097",
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: "#FFBFDE",
              fillOpacity: 1,
              map: map,
              center: stepLocation,
              radius: 3,
            });
          }
        }
      }
    }
  });

  directionsService.route(request, function (result, status) {
    if (status == "OK") {
      var route = result.routes[0].overview_path;
      var polyline = new google.maps.Polyline({
        path: route,
        geodesic: true,
        strokeColor: "#35B6FF",
        strokeOpacity: 1.0,
        strokeWeight: 3,
      });
      polyline.setMap(map);

      // Menambahkan marker untuk setiap titik pemberhentian
      for (var i = 0; i < stops.length; i++) {
        var stop = stops[i];
        var stopMarker = new google.maps.Marker({
          position: stop.location,
          map: map,
          icon: "assets/icon/rute.png",
        });
      }
    }
  });
}

var script = document.createElement("script");
script.src =
  "linkapimaps";
script.defer = true;
script.async = true;
document.head.appendChild(script);
