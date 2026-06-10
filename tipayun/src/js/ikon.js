const loadSVG = (name) => {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `assets/svg/${name}.svg`, true);
    xhr.onreadystatechange = () => {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const svgString = xhr.responseText;
        resolve(svgString);
      }
    };
    xhr.onerror = reject;
    xhr.send();
  });
};

const loadAllSVGs = () => {
  const svgElements = document.querySelectorAll("i[tpy]");

  Promise.all(
    Array.from(svgElements).map((element) => {
      const svgName = element.getAttribute("tpy");
      return loadSVG(svgName);
    })
  ).then((svgStrings) => {
    svgElements.forEach((element, index) => {
      element.innerHTML = svgStrings[index];
    });
  });
};
