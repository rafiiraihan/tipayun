var tambahLayananButton = document.querySelector("#tbl-layanan");
var modalBuatLayanan = document.querySelector("#buat-layanan");
var closeModalBuatLayananButton = document.querySelector(
  "#buat-layanan .detail-box-tutup"
);
var redupElement = document.querySelector(".redup");
var formLayanan = document.getElementById("form-layanan");
var bersihkanButton = document.getElementById("dtl-bersih");
var modalEditLayanan = document.querySelector("#edit-layanan");
var closeModalEditLayananButton = document.querySelector(
  "#edit-layanan .detail-box-tutup"
);
var formEditLayanan = document.getElementById("form-edit-layanan");

function showBuatLayananModal() {
  modalBuatLayanan.style.display = "flex";
  redupElement.style.display = "block";
}

function hideBuatLayananModal() {
  modalBuatLayanan.style.display = "none";
  redupElement.style.display = "none";
}

function showEditLayananModal(event) {
  var idLayanan = event.currentTarget.getAttribute("data-id");

  var row = event.currentTarget.closest("tr");
  var namaLayanan = row.querySelector("td:nth-child(2)").textContent;
  var informasiLayanan = row.querySelector("td:nth-child(3)").textContent;
  var singkatanLayanan = row.querySelector(
    "td:nth-child(4) .tbl-trayek"
  ).textContent;
  var webLayanan = row.querySelector("td:nth-child(5)").textContent;

  document.getElementById("edit-id-layanan").value = idLayanan;
  document.getElementById("edit-isi-layanan").value = namaLayanan;
  document.getElementById("edit-isi-informasi").value = informasiLayanan;
  document.getElementById("edit-isi-singkatan").value = singkatanLayanan;
  document.getElementById("edit-isi-website").value = webLayanan;

  modalEditLayanan.style.display = "flex";
  redupElement.style.display = "block";
}

function hideEditLayananModal() {
  modalEditLayanan.style.display = "none";
  redupElement.style.display = "none";
}

if (tambahLayananButton) {
  tambahLayananButton.addEventListener("click", function (event) {
    event.preventDefault();
    showBuatLayananModal();
  });

  closeModalBuatLayananButton.addEventListener("click", function (event) {
    event.preventDefault();
    hideBuatLayananModal();
  });

  window.addEventListener("click", function (event) {
    if (event.target.classList.contains("redup")) {
      hideBuatLayananModal();
    }
  });
}

if (formLayanan) {
  formLayanan.addEventListener("submit", function (event) {
    var namaLayanan = document.getElementById("isi-layanan").value;
    var informasiLayanan = document.getElementById("isi-informasi").value;
    var singkatanLayanan = document.getElementById("isi-singkatan").value;
    var webLayanan = document.getElementById("isi-website").value;

    if (
      namaLayanan === "" ||
      informasiLayanan === "" ||
      singkatanLayanan === "" ||
      webLayanan === ""
    ) {
      event.preventDefault();
      alert("Harap isi semua field dengan benar!");
    }
  });
}

if (bersihkanButton) {
  bersihkanButton.addEventListener("click", function (event) {
    event.preventDefault();
    var inputField = document.getElementById("isi-layanan");
    inputField.value = "";
  });
}

if (formEditLayanan) {
  formEditLayanan.addEventListener("submit", function (event) {
    var namaLayanan = document.getElementById("edit-isi-layanan").value;
    var informasiLayanan = document.getElementById("edit-isi-informasi").value;
    var singkatanLayanan = document.getElementById("edit-isi-singkatan").value;
    var webLayanan = document.getElementById("edit-isi-website").value;

    if (
      namaLayanan === "" ||
      informasiLayanan === "" ||
      singkatanLayanan === "" ||
      webLayanan === ""
    ) {
      event.preventDefault();
      alert("Harap isi semua field dengan benar!");
    }
  });
}

var editButtons = document.querySelectorAll(".tbl-edit");
editButtons.forEach(function (button) {
  button.addEventListener("click", showEditLayananModal);
});

if (closeModalEditLayananButton) {
  closeModalEditLayananButton.addEventListener("click", function (event) {
    event.preventDefault();
    hideEditLayananModal();
  });
}

window.addEventListener("click", function (event) {
  if (event.target.classList.contains("redup")) {
    hideEditLayananModal();
  }
});

if (document.getElementById("searchInput")) {
  const searchInput = document.getElementById("searchInput");
  searchInput.addEventListener("input", function () {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll(".tbody-layanan tr");

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
