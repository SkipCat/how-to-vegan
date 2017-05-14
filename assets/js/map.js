    
var paris = {lat: 48.866667, lng: 2.333333};

var markers = [
    {
        "title": 'Biocop',
        "lat": '48.8571408',
        "lng": '2.390712399999984',
        "description": '<h1>Biocop - Philippe Auguste</h1><br>' +
        'Un choix incroyable de fruits et légumes, pains, fromages à la coupe, miels, vins, jus de fruits et légumes, produits frais et surgelés, le plus grand « bar à vrac » de Paris avec plus de 150 produits, des cosmétiques, compléments alimentaires, textiles ... ' +
        '<a href="http://www.biocoop.fr/magasins-bio/Trouver-mon-magasin-Biocoop/Ile-de-France/Paris/BIOCOOP-LE-RETOUR-A-LA-TERRE-RIV"> voir la suite</a>'
    },
    {
        "title": "Bio c'Bon",
        "lat": '48.8754788',
        "lng": '2.3507657999999765',
        "description": "<h1>Bio c'Bon - Hauteville</h1><br>" +
        " Magasin Bio c\'bon Paris Hauteville, " +
        '<a href="http://www.bio-c-bon.eu/fr/nos_magasins/bio-c-bon-paris-hauteville"> voir la suite</a>'
    },
    {
        "title": 'Lov Organic',
        "lat": '48.86377640000001',
        "lng": '2.346167199999968',
        "description": "<h1>Lov Organic - Châtelet</h1><br>" +
        " Vente en ligne de thé et infusions bio qui embelissent votre quotidien" +
        '<a href="http://www.lov-organic.com/"> voir la suite</a>'
    },
    {
        "title": 'Touch of Bio',
        "lat": '48.8497694',
        "lng": '2.352292700000021',
        "description": "<h1>Touch of Bio - Paris 5ème</h1><br>" +
        "Nous vous proposons tous les jours un large choix de FRUITS & LEGUMES, tous sont choisis avec soin et attention à déguster sans modération. Tous les vendredis les LEGUMES sont cueillis chez Eddie ..." +
        '<a href="http://www.touchofbioparis.com/"> voir la suite</a>'
    },
    {
        "title": 'Altervojo',
        "lat": '48.86918259999999',
        "lng": '2.371327699999938',
        "description": "<h1>Alterjovo - Parmentier</h1><br>" +
        "Le Comptoir bio Altervojo, magasin bio à Paris 11ème, indépendant, familial et végétarien, vous propose au 127, avenue Parmentier une sélection de produits bio qui respecte la charte de qualité que nous nous sommes fixée : ..." +
        '<a href="http://www.altervojo.fr/"> voir la suite</a>'
    },
    {
        "title": 'Biocop',
        "lat": '48.8467982',
        "lng": '2.3419678000000204',
        "description": "<h1>Biocop - Paris 5ème</h1><br>" +
        "Le projet  le Retour à la Terre  est avant tout une démarche. Son aspect le plus visible ce sont ses magasins de la Rive Droite ouvert en 2008 et celui de la Rive Gauche ouvert en 2011 ;  mais il ne doit pas faire oublier les vergers ..." +
        '<a href="https://leretouralaterre.fr/"> voir la suite</a>'
    },
    {
        "title": 'Nature à Paris',
        "lat": '48.84978479999999',
        "lng": '2.348481099999958',
        "description": "<h1>Nature à Paris - Paris 5ème</h1><br>" +
        " Grande boutique Bio ..." +
        'Pas de site internet disponible'
    },
    {
        "title": 'Carrefour Bio',
        "lat": '48.846323',
        "lng": '2.375847199999953',
        "description": "<h1>Carrefour Bio - Paris 12ème</h1><br>" +
        "Magasin carrefour spécialisé dans les produits Bio ..." +
        '<a href="http://www.carrefour.fr/magasin/bio-paris-diderot"> voir la suite</a>'
    },
    {
        "title": "Bio c'Bon",
        "lat": '48.8773303',
        "lng": '2.293007799999941',
        "description": "<h1>Bio c'Bon - Champs Elysées</h1><br>" +
        " Magasin Bio c\'bon Champs Elysées, " +
        '<a href="http://bio-c-bon.eu/fr/nos_magasins/bio-c-bon-paris-acacias"> voir la suite</a>'
    },
    {
        "title": 'Biocop Grenelle',
        "lat": '48.85152060000001',
        "lng": '2.2912565000000313',
        "description": "<h1>Biocop Grenelle</h1><br>" +
        " En face de la station de métro aérien Dupleix, le magasin Biocoop Toutelabio est un incontournable lieu de RV des amateurs de produits bio de qualité depuis 2001 ..." +
        '<a href="http://www.biocoop.fr/magasins-bio/Trouver-mon-magasin-Biocoop/Ile-de-France/Paris/BIOCOOP-TOUTELABIO-GRENELLE"> voir la suite</a>'
    }
];


window.initMap = function() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: paris
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('submit-localization').addEventListener('click', function () {
        geocodeAddress(geocoder, map);
    });
    var map = new google.maps.Map(document.getElementById("map"), map);

    var infoWindow = new google.maps.InfoWindow();

    for (var i = 0; i < markers.length; i++) {
        var data = markers[i];
        var myLatlng = new google.maps.LatLng(data.lat, data.lng);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: data.title
        });

        (function (marker, data) {
            google.maps.event.addListener(marker, "click", function (e) {
                infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                infoWindow.open(map, marker);
            });
        })(marker, data);
    }
}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('form-localization').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location,
                title: 'Votre adresse'
            });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}