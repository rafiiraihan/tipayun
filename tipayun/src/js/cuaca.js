const kuncirahasiaku = "aa2046d728ed8a94d0411c73a9a03885";
const updateCuaca = () => {
  fetch(
    `https://api.openweathermap.org/data/2.5/weather?q=Bandung&appid=${kuncirahasiaku}&units=metric&lang=id`
  )
    .then((response) => response.json())
    .then((data) => {
      const suhu = Math.round(data.main.temp);

      const infocuaca = {
        Clear: "Cerah",
        Clouds: "Berawan",
        Drizzle: "Gerimis",
        Rain: "Hujan",
        Thunderstorm: "Badai",
        Snow: "Salju",
        Mist: "Kabut",
        Smoke: "Asap",
        Haze: "Kabut",
        Dust: "Debu",
        Fog: "Kabut",
        Sand: "Pasir",
        Ash: "Abu vulkanik",
        Squall: "Angin kencang",
        Tornado: "Tornado",
      };

      const cuacaKota = data.name;
      const kotaElement = document.querySelector(
        ".extra-info-title-heading span"
      );
      kotaElement.textContent = cuacaKota;

      const deskripsi = data.weather[0].main;
      const cuacaIndo = infocuaca[deskripsi] || deskripsi;

      const objekSuhu = document.querySelector(".extra-info-desc span");
      const objekInfo = document.querySelector(".extra-info-desc p");
      objekSuhu.textContent = `${suhu}°C`;
      objekInfo.textContent = cuacaIndo;

      if (suhu <= 22) {
        objekSuhu.setAttribute("id", "tiris");
      } else if (suhu <= 26) {
        objekSuhu.setAttribute("id", "normal");
      } else if (suhu <= 29) {
        objekSuhu.setAttribute("id", "hareudang");
      } else {
        objekSuhu.setAttribute("id", "panas");
      }

      const extraInfoTitle = document.getElementById("cuaca-x");
      const existingImage = extraInfoTitle.querySelector("img");
      if (existingImage) {
        existingImage.remove();
      }
      const iconSrc = `assets/icon/${cuacaIndo.toLowerCase()}.png`;
      const newImage = document.createElement("img");
      newImage.setAttribute("src", iconSrc);
      extraInfoTitle.appendChild(newImage);
    })
    .catch((error) => {
      console.error("Terjadi kesalahan saat mengambil data cuaca:", error);
    });
};

setInterval(updateCuaca, 5 * 60 * 1000);
updateCuaca();
