var tambahHalteButton = document.querySelector("#tbl-halte");
var modal = document.querySelector("#buat-halte");
var setBoxModal = document.querySelector(".set-box");
var setBoxCloseButton = document.querySelector(".set-box #set-batal");
var redupElement = document.querySelector(".redup");
var formHalte = document.getElementById("form-halte");
var bersihkanButton = document.getElementById("dtl-bersih");
var setLokasiButton = document.querySelector(".tbl-setlok");
var detailBoxTutupButton = document.querySelector(".detail-box-tutup");
var modalUbahHalte = document.querySelector("#ubah-halte");
var closeModalUbahHalteButton = document.querySelector(
  "#ubah-halte .detail-box-tutup"
);
var formUbahHalte = document.getElementById("form-ubah-halte");
var setLokasiButtonUbah = document.querySelector("#ubah-halte .tbl-setlok");
var setBoxCloseButtonUbah = document.querySelector(
  "#ubah-halte .set-box #set-batal"
);

function showModal() {
  modal.style.display = "flex";
  redupElement.style.display = "block";
}

function hideModal() {
  modal.style.display = "none";
  redupElement.style.display = "none";
}

function showSetBoxModal() {
  setBoxModal.style.display = "block";
  redupElement.style.display = "block";

  if (modalUbahHalte.style.display === "flex") {
    var ubahLatitude = parseFloat(
      document.getElementById("ubah-latitude").value
    );
    var ubahLongitude = parseFloat(
      document.getElementById("ubah-longitude").value
    );
    updateMarkerAndMapCenter(ubahLatitude, ubahLongitude);
  }
}

function hideSetBoxModal() {
  setBoxModal.style.display = "none";
}

if (tambahHalteButton) {
  tambahHalteButton.addEventListener("click", function (event) {
    event.preventDefault();
    showModal();
    var defaultLatitude = parseFloat(initialPosition.lat);
    var defaultLongitude = parseFloat(initialPosition.lng);
    updateMarkerAndMapCenter(defaultLatitude, defaultLongitude);
  });

  detailBoxTutupButton.addEventListener("click", function (event) {
    event.preventDefault();
    hideModal();
  });

  setLokasiButton.addEventListener("click", function (event) {
    event.preventDefault();
    showSetBoxModal();
  });

  setBoxCloseButton.addEventListener("click", function (event) {
    event.preventDefault();
    hideSetBoxModal();
  });

  window.addEventListener("click", function (event) {
    if (
      event.target.classList.contains("redup") &&
      modal.style.display === "flex"
    ) {
      hideModal();
    }
    if (
      event.target.classList.contains("redup") &&
      setBoxModal.style.display === "block"
    ) {
      hideSetBoxModal();
    }
  });
}

if (formHalte) {
  formHalte.addEventListener("submit", function (event) {
    var namaHalte = document.getElementById("isi-nama-halte").value;
    var latitude = document.getElementById("isi-latitude").value;
    var longitude = document.getElementById("isi-longitude").value;
    var jenis = document.getElementById("isi-jenis").value;

    if (
      namaHalte === "" ||
      latitude === "" ||
      longitude === "" ||
      jenis === ""
    ) {
      event.preventDefault();
      alert("Harap isi semua field dengan benar!");
    }
  });
}

if (bersihkanButton) {
  bersihkanButton.addEventListener("click", function (event) {
    event.preventDefault();
    var inputFields = document.querySelectorAll(
      "#buat-halte .detail-box-field"
    );
    inputFields.forEach(function (field) {
      field.value = "";
    });
  });
}

function showUbahHalteModal(event) {
  var idHalte = event.currentTarget.getAttribute("data-id");
  var row = event.currentTarget.closest("tr");
  document.getElementById("edit-id-halte").value = idHalte;
  var namaHalte = row.querySelector("td:nth-child(2)").textContent;
  var latitude = row.querySelector("td:nth-child(3)").textContent;
  var longitude = row.querySelector("td:nth-child(4)").textContent;
  var jenis = row.querySelector("td:nth-child(5)").textContent.trim(); // Menghapus spasi di awal dan akhir

  document.getElementById("ubah-nama-halte").value = namaHalte;
  document.getElementById("ubah-latitude").value = latitude;
  document.getElementById("ubah-longitude").value = longitude;

  var dropdownJenis = document.getElementById("ubah-jenis");
  for (var i = 0; i < dropdownJenis.options.length; i++) {
    if (dropdownJenis.options[i].value.trim() === jenis) {
      dropdownJenis.selectedIndex = i;
      break;
    }
  }

  modalUbahHalte.style.display = "flex";
  redupElement.style.display = "block";
}

function hideUbahHalteModal() {
  modalUbahHalte.style.display = "none";
  redupElement.style.display = "none";
}

if (formUbahHalte) {
  formUbahHalte.addEventListener("submit", function (event) {
    var namaHalte = document.getElementById("ubah-nama-halte").value;
    var latitude = document.getElementById("ubah-latitude").value;
    var longitude = document.getElementById("ubah-longitude").value;
    var jenis = document.getElementById("ubah-jenis").value;

    if (
      namaHalte === "" ||
      latitude === "" ||
      longitude === "" ||
      jenis === ""
    ) {
      event.preventDefault();
      alert("Harap isi semua field dengan benar!");
    }
  });
}

var ubahButtons = document.querySelectorAll(".tbl-edit");
ubahButtons.forEach(function (button) {
  button.addEventListener("click", showUbahHalteModal);
});

if (closeModalUbahHalteButton) {
  closeModalUbahHalteButton.addEventListener("click", function (event) {
    event.preventDefault();
    hideUbahHalteModal();
  });
}

window.addEventListener("click", function (event) {
  if (event.target.classList.contains("redup")) {
    hideUbahHalteModal();
  }
});

if (setLokasiButtonUbah) {
  setLokasiButtonUbah.addEventListener("click", function (event) {
    event.preventDefault();
    showSetBoxModal();
  });
}

if (setBoxCloseButtonUbah) {
  setBoxCloseButtonUbah.addEventListener("click", function (event) {
    event.preventDefault();
    hideSetBoxModal();
  });
}

function updateMarkerAndMapCenter(latitude, longitude) {
  var newCenter = { lat: latitude, lng: longitude };
  map.setCenter(newCenter);
  marker.setPosition(newCenter);
}

var konversiForm = document.getElementById("konversi");
var setMentahInput = document.getElementById("set-mentah");
var latitudeInput = document.getElementById("isi-latitude");
var longitudeInput = document.getElementById("isi-longitude");

konversiForm.addEventListener("submit", function (event) {
  event.preventDefault();
  var inputKoordinat = setMentahInput.value.trim();
  var regex = /(-?\d+\.\d+),\s*(-?\d+\.\d+)/;
  var match = regex.exec(inputKoordinat);

  if (match && match.length === 3) {
    var lat = parseFloat(match[1].replace(",", ".")).toFixed(5);
    var lng = parseFloat(match[2].replace(",", ".")).toFixed(5);
    if (modal.style.display === "flex") {
      latitudeInput.value = lat;
      longitudeInput.value = lng;
    } else if (modalUbahHalte.style.display === "flex") {
      document.getElementById("ubah-latitude").value = lat;
      document.getElementById("ubah-longitude").value = lng;
    }

    hideSetBoxModal();
    konversiForm.reset();
  } else {
    alert("Koordinat tidak dikenali. Harap periksa format input.");
  }
});

var map;
var marker;
var lastMarkerPosition;

function initMap() {
  var mapOptions = {
    center: { lat: -6.93993, lng: 107.72528 },
    zoom: 15,
  };

  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  initialPosition = mapOptions.center;

  marker = new google.maps.Marker({
    position: mapOptions.center,
    map: map,
    draggable: true,
  });

  var ubahLatitude = document.getElementById("ubah-latitude");
  var ubahLongitude = document.getElementById("ubah-longitude");

  if (modalUbahHalte.style.display === "flex") {
    var ubahCenter = { lat: ubahLatitude, lng: ubahLongitude };
    map.setCenter(ubahCenter);
    marker.setPosition(ubahCenter);
    lastMarkerPosition = ubahCenter;
  }

  map.addListener("click", function (event) {
    var latitude = event.latLng.lat().toFixed(5);
    var longitude = event.latLng.lng().toFixed(5);
    if (modal.style.display === "flex") {
      document.getElementById("isi-latitude").value = latitude;
      document.getElementById("isi-longitude").value = longitude;
    } else if (modalUbahHalte.style.display === "flex") {
      document.getElementById("ubah-latitude").value = latitude;
      document.getElementById("ubah-longitude").value = longitude;
    }

    marker.setPosition(event.latLng);
    lastMarkerPosition = event.latLng;
  });
}

var setLokasiButton = document.getElementById("set-lokasi");

setLokasiButton.addEventListener("click", function (event) {
  event.preventDefault();
  hideSetBoxModal();
  map.setCenter(lastMarkerPosition);
  marker.setPosition(lastMarkerPosition);
});

var script = document.createElement("script");
script.src =
  "https://maps.googleapis.com/maps/api/js?key=AIzaSyAIeNojORa0X1xKq0OArjWKPaeH3VmPGbI&callback=initMap";
script.defer = true;
script.async = true;
document.head.appendChild(script);
