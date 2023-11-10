console.log("filter load");
const filtersForm = document.querySelector(".js-filter-form");

document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("change", () => {
    const Form = new FormData(filtersForm);

    const Params = new URLSearchParams();

    Form.forEach((value, key) => {
      Params.append(key, value);
    });

    const url = new URL(window.location.href);

    fetch(url.pathname + "?" + Params.toString() + "&ajax=1", {
      headers: {
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        const content = document.querySelector(".js-filter-content");
        content.innerHTML = data.content;
      });
  });
});
