if (document.getElementById("tbl-rute")) {
  var script = document.createElement("script");
  script.src = "tablerute.js";
  document.head.appendChild(script);
}

if (document.getElementById("tbl-layanan")) {
  var script = document.createElement("script");
  script.src = "tablelayanan.js";
  document.head.appendChild(script);
}

if (document.getElementById("tbl-halte")) {
  var script = document.createElement("script");
  script.src = "tablehalte.js";
  document.head.appendChild(script);
}

if (document.getElementById("tgl")) {
  const tglSpan = document.getElementById("tgl");
  const date = moment().locale("id").format("dddd, D MMMM YYYY");
  tglSpan.textContent = date;
}

if (document.getElementById("gAuth")) {
  const inputElement = document.getElementById("gAuth");

  inputElement.addEventListener("input", function (event) {
    let sanitizedValue = event.target.value
      .replace(/[^a-zA-Z0-9]/g, "")
      .toUpperCase();
    event.target.value = sanitizedValue.slice(0, 6);
  });

  inputElement.addEventListener("keydown", function (event) {
    if (event.getModifierState("CapsLock")) {
      event.target.value = event.target.value.toUpperCase();
    }
  });
}

if (document.getElementsByClassName("tpy")) {
  loadAllSVGs();
}

if (document.getElementsByClassName("info-map")) {
  loadGoogleMaps().then(() => {
    initMap();
  });
}
