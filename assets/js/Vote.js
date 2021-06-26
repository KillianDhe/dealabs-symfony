var Vote = {
    init: function() {
        $(".js-voterMoins").click(function() {
            console.log("voterMoins");

            $.post(Routing.generate('app_deal_voterMoins', {id : $this.data("id") }), function( data ) {
            });
        });
    }
};
window.Vote = Vote;

