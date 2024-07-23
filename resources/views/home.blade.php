<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sensor Kelembaban</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="dataset" data-csrf="{{ csrf_token() }}" data-url="{{ route('getDataApi') }}"></div>
    <h1>Kelembaban:</h1>
    <span id="kelembaban">1</span>
    <br>
    <br>
    <h1>Suhu:</h1>
    <span id="suhu">1</span>

    <script>
        $(document).ready(function() {
            let kelembaban = $('#kelembaban');
            let suhu = $('#suhu');
            let csrf = $('#dataset').data('csrf');
            let url = $('#dataset').data('url');

            setInterval(() => {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: csrf
                    },
                    success: function(data) {
                        kelembaban.text(data.kelembaban);
                        suhu.text(data.suhu);
                    }
                })
            }, 1000);
        })
    </script>
</body>

</html>
