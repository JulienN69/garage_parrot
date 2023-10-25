// ----------------------- METHODE UNE -------------------------
// /**
//  * @property {HTMLElement} pagination
//  * @property {HTMLElement} content
//  * @property {HTMLFormElement} form
//  */
// export default class Filter {
//   /**
//    *
//    * @param {HTMLElement | null} element
//    */
//   constructor(element) {
//     if (element === null) {
//       return;
//     }
//     // this.pagination = element.querySelector(".js-filter-pagination");
//     this.content = element.querySelector(".js-filter-content");
//     this.form = element.querySelector(".js-filter-form");
//     this.bindEvents();
//   }

//   bindEvents() {
//     this.form.querySelectorAll("input").forEach((input) => {
//       input.addEventListener("change", () => {
//         const data = new FormData(this.form);
//         const url = new URL(window.location.href);
//         const params = new URLSearchParams();
//         data.forEach((value, key) => {
//           params.append(key, value);
//         });
//         fetch(url.pathname + "?" + params.toString() + "&ajax=1", {
//           headers: {
//             "X-Requested-With": "XMLHttpRequest",
//           },
//         })
//           .then((response) => {
//             return response.json();
//           })
//           .then((data) => {
//             console.log(data);
//             const content = document.querySelector(".js-filter-content");
//             content.innerHTML = data.content;
//           });
//       });
//     });
//   }
// }

// -------------------- METHODE DEUX -----------------------

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
        console.log(data);
        const content = document.querySelector(".js-filter-content");
        content.innerHTML = data.content;
      });
  });
});
