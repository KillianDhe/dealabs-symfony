

function voterMoins(id){
    $.post(Routing.generate('app_deal_voterMoins', {id : id }), function( data ) {

    });
}