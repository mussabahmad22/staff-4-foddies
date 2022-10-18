<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
        height: 50%;
        margin-left: 20%;
        margin-right: 20%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .custom-map-control-button {
        background-color: #fff;
        border: 0;
        border-radius: 2px;
        box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
        margin: 10px;
        padding: 0 0.5em;
        font: 400 18px Roboto, Arial, sans-serif;
        overflow: hidden;
        height: 40px;
        cursor: pointer;
    }

    .custom-map-control-button:hover {
        background: #ebebeb;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurants') }}
        </span>
        <button class="btn btn-warning m-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
            style="float: right;">Create New</button>
    </x-slot>
    <br />
    <div class="container mb-3">
        <div class="card p-4 m-3 table-responsive">
            <table id="myTable" class="table table-striped table-bordered table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Address</td>
                        <td>Phone</td>
                        <td>Image</td>
                        <td>Url</td>
                        <td>Cuisines</td>
                        <td>Opening</td>
                        <td>Closing</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($restaurnats as $rest)

                    <tr>
                        <td>{{ $rest->id }}</td>
                        <td>{{ $rest->title }}</td>
                        <td>{{ $rest->address }}</td>
                        <td>{{ $rest->phone }}</td>

                        <td>
                            <a href="{{ $rest->image }}" target="_blank">
                                <img src="{{ $rest->image }}" width="50px" height="50px">
                            </a>
                        </td>
                        <td><a class="btn btn-warning btn-sm" href="{{ $rest->url }}" target="_blank">Visit</a></td>
                        <td>{{ $rest->cuisines }}</td>
                        <td>{{ $rest->from_time }}</td>
                        <td>{{ $rest->to_time }}</td>
                        <td>
                            <center><i onclick="update_itm({{ $rest->id }})" class="fas fa-pen"
                                    style="color: green;"></i>&nbsp;&nbsp;&nbsp;<i onclick="delete_itm({{ $rest->id }})"
                                    class="fas fa-trash" style="color: red;"></i></center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var datatab = ''
        $(document).ready(function () {
            datatab = $('#myTable').DataTable();
        });
        function delete_itm(id) {
            $.ajax({
                method: 'post',
                url: 'delete/restaurant',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    location.reload()
                },
                error: function (error) {

                }
            })
        }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Restaurant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="create-restaurant" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <x-label for="title" :value="__('Name')" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')" required autofocus />
                            </div>
                            <div class="mb-2">
                                <x-label for="address" :value="__('Address')" />
                                <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                                    :value="old('address')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                    :value="old('phone')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="url" :value="__('URL')" />
                                <x-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url')"
                                    required />
                            </div>
                            <div class="mb-2">
                                <x-label for="from_time" :value="__('Opening')" />
                                <x-input id="from_time" class="block mt-1 w-full" type="time" name="from_time"
                                    :value="old('from_time')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="to_time" :value="__('Closing')" />
                                <x-input id="to_time" class="block mt-1 w-full" type="time" name="to_time"
                                    :value="old('to_time')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="lat" :value="__('Lat')" />
                                <x-input id="lat" class="block mt-1 w-full" type="text" name="lat" :value="old('lat')"
                                    required />
                            </div>
                            <div class="mb-2">
                                <x-label for="long" :value="__('Long')" />
                                <x-input id="long" class="block mt-1 w-full" type="text" name="long"
                                    :value="old('long')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="photo" :value="__('Image')" />
                                <x-input id="photo" class="block mt-1 w-full" type="file" name="photo"
                                    :value="old('photo')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="cuisines" :value="__('Cuisines')" />
                                <x-input id="cuisines" class="block mt-1 w-full" type="text" name="cuisines"
                                    :value="old('cuisines')" required />
                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Save</button>
                    </form>
                    <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdroptwo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Restaurant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="restaurant" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input hidden name="id" id="identity">
                            <div class="mb-2">
                                <x-label for="title" :value="__('Name')" />
                                <x-input id="title1" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')" required autofocus />
                            </div>
                            <div class="mb-2">
                                <x-label for="address" :value="__('Address')" />
                                <x-input id="address1" class="block mt-1 w-full" type="text" name="address"
                                    :value="old('address')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone1" class="block mt-1 w-full" type="text" name="phone"
                                    :value="old('phone')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="url" :value="__('URL')" />
                                <x-input id="url1" class="block mt-1 w-full" type="text" name="url" :value="old('url')"
                                    required />
                            </div>
                            <div class="mb-2">
                                <x-label for="from_time" :value="__('Opening')" />
                                <x-input id="from_time1" class="block mt-1 w-full" type="time" name="from_time"
                                    :value="old('from_time')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="to_time" :value="__('Closing')" />
                                <x-input id="to_time1" class="block mt-1 w-full" type="time" name="to_time"
                                    :value="old('to_time')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="lat" :value="__('Lat')" />
                                <x-input id="lat" class="block mt-1 w-full" type="text" name="lat" :value="old('lat')"
                                    required />
                            </div>
                            <div class="mb-2">
                                <x-label for="long" :value="__('Long')" />
                                <x-input id="long" class="block mt-1 w-full" type="text" name="long"
                                    :value="old('long')" required />
                            </div>
                            <div class="mb-2">
                                <x-label for="photo" :value="__('Image')" />
                                <x-input id="photo1" class="block mt-1 w-full" type="file" name="photo"
                                    :value="old('photo')" />
                            </div>
                            <div class="mb-2">
                                <x-label for="cuisines" :value="__('Cuisines')" />
                                <x-input id="cuisines1" class="block mt-1 w-full" type="text" name="cuisines"
                                    :value="old('cuisines')" required />
                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Save</button>
                    </form>
                    <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!------------------- Google Map through google Api Key ---------------------------------->

    <input id="pac-input" class="controls" type="text" placeholder="Search Box" />
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                <td>
                    <label for="latitude">
                        Latitude:
                    </label>
                    <input id="txtLat" type="text" style="color:red" />
                    <label for="longitude">
                        Longitude:
                    </label>
                    <input id="txtLng" type="text" style="color:rgb(230, 23, 23)" />
                    <div id="map_canvas" style="width: auto; height: 10px;">
                    </div>
                </td>
            </div>
        </div>
    </div>
    <!-- ---------------------------------Google Map Div-------------------------------------- -->

    <div id="map"></div>

    <!-- ------------------------Google API key.---------------------------------------------- -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHV-XgmBdUHICr4CzBrgDNNET1-qhjIPQ&callback=initMap&libraries=places">
        </script>

    <!-------------------------- /Google Map through google Api Key ----------------------------->
    <script type="text/javascript">
        var map;
        function initMap() {
            var myLatlng = new google.maps.LatLng(29.498684, 71.730617);
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: myLatlng,
                mapTypeId: map,
            });
            //---------------------------------Marker--------------------------------------------
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                draggable: true,
                title: "Marker"
            });

            //-------------------------------Find Current Location--------------------------------
            let infoWindow;
            infoWindow = new google.maps.InfoWindow();
            const locationButton = document.createElement("button");
            locationButton.textContent = "PAN TO CURRENT LOCATION";
            locationButton.classList.add("custom-map-control-button");
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
            locationButton.addEventListener("click", () => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };
                            infoWindow.open(map);
                            map.setCenter(pos);
                            marker.setPosition(pos);
                            $("#txtLat").val(marker.getPosition().lat().toFixed(6));
                            $("#txtLng").val(marker.getPosition().lng().toFixed(6));
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );

                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            });
            //------------------Get Lat and Long by dragable marker ----------------------------------------
            marker.addListener("dragend", () => {
                map.setZoom(18);
                map.setCenter(marker.getPosition());
                //-----------------------Move Marker And Get Lat Long --------------------------------------
                $("#txtLat").val(marker.getPosition().lat().toFixed(6));
                $("#txtLng").val(marker.getPosition().lng().toFixed(6));
            });
            //----------------------Set user Current Location By Default-------------------------------------
            if (navigator.geolocation) {
                /*
                 * getCurrentPosition() takes a function as a callback argument
                 * The callback takes the position object returned as an argument
                 */
                navigator.geolocation.getCurrentPosition(function (position) {
                    /**
                     * pos will contain the latlng object
                     * This must be passed into the setCenter instead of two float values
                     */
                    var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);  
                    map.setCenter(pos); //center the map based on users location
                    marker.setPosition(pos);
                }, function () {
                    //client supports navigator object, but does not share their geolocation
                });
            } else {
                //client doesn't support the navigator object
            }
            //---------------------------------search Box----------------------------------------------------
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    // Create a marker for each place.
                    marker.setPosition(place.geometry.location);
                    $("#txtLat").val(marker.getPosition().lat().toFixed(6));
                    $("#txtLng").val(marker.getPosition().lng().toFixed(6));
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
    </script>

    <script>

        var input = document.querySelector('input[name="cuisines"]'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                whitelist: ["All", "Asian", "Breakfast", "Chicken", "Chinese", "Curry", "Desserts", "Fast Food", "Fish & Chips", "Grill", "Halal", "Indian", "Mexican", "Noodles", "Oriental", "Peri Peri", "Subways", "Thai", "Vegan", "Waffle", "Burger", "Pizza"],
                maxTags: 10,
                dropdown: {
                    maxItems: 20,           // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            })

        function update_itm(val) {
            $.ajax({
                url: "{{ url('/restaurant/') }}/" + val,
                success: function (data) {
                    debugger;
                    $('#title1').val(data.title)
                    $('#address1').val(data.address)
                    $('#phone1').val(data.phone)
                    $('#url1').val(data.url)
                    $('#from_time1').val(data.from_time)
                    $('#to_time1').val(data.to_time)
                    $('#cuisines1').val(data.cuisines)
                    $('#identity').val(data.id)
                    var myModal = new bootstrap.Modal(document.getElementById('staticBackdroptwo'))
                    myModal.toggle();
                },
                error: function (error) {

                }
            })
        }
    </script>
</x-app-layout>