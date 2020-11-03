export default () => {
    document.querySelectorAll(".hubs__map").forEach(mapHolder => {
        let {zoom, longitude, latitude} = mapHolder.dataset



        let pos = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude))

        console.log(pos)

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