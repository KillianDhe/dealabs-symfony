function clickEventVoteMoins(element) {
  $.post(Routing.generate('app_deal_voterMoins', { id : element.getAttribute("data-id") })).done(function( data ) {
    let degreesElem = element.closest(".deals-item__degrees").getElementsByClassName("degrees")[0];
    if (degreesElem && data !== undefined) {
      degreesElem.innerHTML = data;
    }
  }).fail(function () {
  });
}

function clickEventVotePlus(element) {
  $.post(Routing.generate('app_deal_voterPlus', {id: element.getAttribute("data-id")})).done(function (data) {
    let degreesElem = element.closest(".deals-item__degrees").getElementsByClassName("degrees")[0];
    if (degreesElem && data !== undefined) {
      degreesElem.innerHTML = data;
    }
  }).fail(function () {
  });
}
let Vote = {
    init: function() {
      let elementsMoins = document.getElementsByClassName("js-voterMoins");
      elementsMoins.forEach(element => {
        element.addEventListener("click", () => clickEventVoteMoins(element));
      });

      let elementsPlus = document.getElementsByClassName("js-voterPlus");
      elementsPlus.forEach(element => {
        element.addEventListener("click", () => clickEventVotePlus(element));
      });
    }
};

document.addEventListener('DOMContentLoaded', () => {
  Vote.init();
});

