$(function() {
    $("#map").googleMap();

    // Marker 1
    $("#map").addMarker({
        coords: [48.895651, 2.290569],
        title: 'Biocop',
        text: 'Magasin bio de ouuuuuuuuuuuuuuuf',
        url: 'www.biocop.fr'
    });

    // Marker 2
    $("#map").addMarker({
        coords: [48.869439, 2.308664]
    });

    // Marker 3
    $("#map").addMarker({
        coords: [48.888846, 2.198674]
    });

    $("#form-localization").on('submit', function() {
        console.log('lkfjkfljgkl');
        $("#map").googleMap({
            zoom: 15, 
            type: "SATELLITE"
        });
        $("map").addMarker({
            address: $("#input-adress").val(), 
            
        });
    });
});