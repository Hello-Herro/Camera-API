<!DOCTYPE html>
<html>

<head>
    <title>Camera List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h1>Daftar Kamera</h1>

        <input type="text" id="search" class="form-control mb-3" placeholder="Cari Kamera">
        <div id="camera-list"></div>

    </div>

    <script>
        fetch('/api/cameras')
            .then(response => response.json())
            .then(result => {

                let html = '';

                result.data.forEach(camera => {

                    html += `
            <div class="card mb-3">
                <div class="card-body">

                    <h5>${camera.name}</h5>

                    <p>Brand: ${camera.brand}</p>

                    <p>Sensor: ${camera.sensor_type}</p>

                    <p>Resolusi: ${camera.resolution}</p>

                    <p>Harga: ${camera.price}</p>

                </div>
            </div>
        `;
                });

                document.getElementById('camera-list').innerHTML = html;

            });
    </script>

    <script>
        const search = document.getElementById('search');

        search.addEventListener('keyup', function() {

            fetch(`/api/cameras?search=${this.value}`)

                .then(response => response.json())

                .then(result => {

                    let html = '';

                    result.data.forEach(camera => {

                        html += `
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>${camera.name}</h5>
                        <p>${camera.brand}</p>
                    </div>
                </div>
            `;
                    });

                    document.getElementById('camera-list').innerHTML = html;
                });
        });
    </script>

</body>

</html>
