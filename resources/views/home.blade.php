@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>

    $data = {data:[{
        "id": "PHXcKMK9u",
        "v": "72JXpzQRF"
    },{
        "id": "wbYPBfZSI",
        "v": "NXWHjWRET"
    },{
        "id": "qAfOJhlK7",
        "v": "tfO69dUtN"
    },{
        "id": "xkpoq9iqq",
        "v": "Tigsw5Mw4"
    }]};
    $.ajax({
        url:'/trivia/stop',
        data: $data,
        dataType: 'json',
        method: 'post',
        success: function (e) {
            console.log(e);
        }
    })

</script>
@endsection
