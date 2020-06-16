export const initMaps = () => {
    document.querySelectorAll(".map-holder").forEach(mapHolder => {
        let {zoom, longitude, latitude} = mapHolder.dataset

        let pos = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude))

        let map = new google.maps.Map(mapHolder, {
            center: pos,
            zoom: parseInt(zoom),
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false
        })

        new google.maps.Marker({
            position: pos,
            map: map
        })
    })
}