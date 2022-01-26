@extends('layouts.opdlayout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/MarkerCluster.Default.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<style>
    #mymap {
        height: 500px;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <h5 class="mb-0 text-uppercase">Maps Kaduan </h5>


            <div class="ps-3">
                <nav aria-label="breadcrumb">

                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        @if(session()->has('message'))
        <div class="alert border-0 border-start border-2 border-success alert-dismissible fade show py-1">
            <div class="d-flex align-items-center">
                <div class="font-20 text-success"><i class='bx bxs-check-circle'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-success">Hore !! </h6>
                    <div> {{ session()->get('message') }}</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <hr />
        <div class="card">

            <div class="card-body">

                <div id="mymap"></div>
            </div>
        </div>
    </div>
</div>



<script>
    var infras = <?= json_encode($belum); ?>;
    var sed = <?= json_encode($sedang); ?>;
    var sel = <?= json_encode($selesai); ?>;

    var lbelum = L.layerGroup();
    var lsedang = L.layerGroup();
    var lsudah = L.layerGroup();


    // var mymap = L.map('mymap').setView([0.533505, 101.447403], 12);



    var merahIcon = L.icon({
        iconUrl: '../maps/mer.png',
        iconSize: [28, 35], // size of the icon
        shadowSize: [40, 60], // size of the shadow
        popupAnchor: [-3, -23] // point from which the popup should open relative to the iconAnchor
    });



    for (var i = 0; i < infras.length; i++) {


        var marker = L.marker([infras[i][1], infras[i][2]], {
            icon: merahIcon
        }).addTo(lbelum).bindPopup(infras[i][0]);
    }

    var kunIcon = L.icon({
        iconUrl: '../maps/kun.png',
        iconSize: [28, 35], // size of the icon
        shadowSize: [40, 60], // size of the shadow
        popupAnchor: [-3, -23] // point from which the popup should open relative to the iconAnchor
    });

    for (var i = 0; i < sed.length; i++) {
        var marker = L.marker([sed[i][1], sed[i][2]], {
            icon: kunIcon
        }).addTo(lsedang).bindPopup(sed[i][0]);
    }

    var HijIcon = L.icon({
        iconUrl: '../maps/hij.png',
        iconSize: [28, 35], // size of the icon
        shadowSize: [40, 60], // size of the shadow
        popupAnchor: [-3, -23] // point from which the popup should open relative to the iconAnchor
    });



    for (var i = 0; i < sel.length; i++) {
        var marker = L.marker([sel[i][1], sel[i][2]], {
            icon: HijIcon
        }).addTo(lsudah).bindPopup(sel[i][0]);
    }



    // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    //     maxZoom: 20,
    //     id: 'mapbox/streets-v11',
    //     tileSize: 512,
    //     zoomOffset: -1,
    //     accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    // }).addTo(mymap);



    var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

    var grayscale = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        }),
        streets = L.tileLayer(mbUrl, {
            id: 'mapbox/light-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });

    var mymap = L.map('mymap', {
        center: [0.510440, 101.438309],
        zoom: 12,
        iconAnchor: [19, 42],
        layers: [grayscale, lbelum, lsedang, lsudah]
    });

    var baseLayers = {
        "Default Basemap": grayscale,
        "Grey Basemap": streets,

    };

    var overlays = {
        "Belum proses": lbelum,
        "Sedang diproses": lsedang,
        "Sudah selesai": lsudah,
    };


    L.control.layers(baseLayers, overlays).addTo(mymap);
</script>


@endsection