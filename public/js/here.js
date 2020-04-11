    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition((position => {
            localCoord = position.coords;
            objLocalCoord = {
                lat: localCoord.latitude,
                lang: localCoord.langitude
            }

            // Initialize the platform object:
            let platform = new H.service.Platform({
                'apikey': window.hereApiKey
            });

            // Obtain the default map types from the platform object
            let defaultLayers = platform.createDefaultLayers();

            // Instantiate (and display) a map object:
            let map = new H.Map(
                document.getElementById('mapContainer'),
                defaultLayers.vector.normal.map,
                {
                    zoom: 13,
                    center: objLocalCoord, //center posisi local yang ditunjuk
                    pixelRation:window.devicePixelRatio
                });

                window.addEventListener('resize')

                let ui = H.ui.UI.createDefault(map, defaultLayers);
                let mapEvents = new H.mapevents.MapEvents(map); //menggunakan scroll zoom dll
                let behavior = new H.mapevents.Behavior(mapEvents);

        }))
    }
    else{
        console.error("Geolocation Not Supported by this browser !")
    }