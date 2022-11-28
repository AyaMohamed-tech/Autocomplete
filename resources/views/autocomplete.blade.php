<!DOCTYPE html>
<html>

<head>
    <title>Laravel</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    
   <p style="padding:20px;">
    <h3 align="center">Laravel 8 Autocomplete Textbox with JQuery Ajax</h3>
    </p>
    <form action="{{ route('country.store') }}" method="POST">
        @csrf
        <div class="container box">
            <div class="form-group">
                <input type="text" name="country_name" id="country_name" class="form-control"
                    placeholder="Enter Country Name" />
                <div id="countryList"></div>
            </div>
            <div class="mt-1">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {

            $('#country_name').keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('autocomplete.fetch') }}",
                        method: "POST",
                        data: {
                            query: query,
                            _token: _token
                        },
                        success: function(data) {
                            $('#countryList').fadeIn();
                            $('#countryList').html(data);
                        }
                    });
                }
            });

            $(document).on('click', 'li', function() {
                $('#country_name').val($(this).text());
                $('#countryList').fadeOut();
            });

        });
    </script>
</body>

</html>
