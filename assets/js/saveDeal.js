function clickEventSaveDeal(element) {
  $.post(Routing.generate('app_account_saveDeal', {dealId: element.getAttribute("data-id")})).done(function (data) {
    element.classList.remove('js-saveDeal');
    element.classList.add('js-removeDealSaved');

    element.addEventListener("click", () => clickEventRemoveDealSaved(element), {once: true});
  }).fail(function () {
    element.addEventListener("click", () => clickEventSaveDeal(element), {once: true});
  });
}

function clickEventRemoveDealSaved(element) {
  $.post(Routing.generate('app_account_removeDealSaved', {dealId: element.getAttribute("data-id")})).done(function (data) {
    element.classList.remove('js-removeDealSaved');
    element.classList.add('js-saveDeal');

    element.addEventListener("click", () => clickEventSaveDeal(element), {once: true});
  }).fail(function () {
    element.addEventListener("click", () => clickEventRemoveDealSaved(element), {once: true});
  });
}


let saveDeal = {
  init: function () {
    let elementsSave = document.getElementsByClassName("js-saveDeal");
    elementsSave.forEach(element => {
      element.addEventListener("click", () => clickEventSaveDeal(element), {once: true});
    });

    let elements = document.getElementsByClassName("js-removeDealSaved");
    elements.forEach(element => {
      element.addEventListener("click", () => clickEventRemoveDealSaved(element), {once: true});
    });
  }
};


document.addEventListener('DOMContentLoaded', () => {
  saveDeal.init();
});