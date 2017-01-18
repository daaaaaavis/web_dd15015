@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Logged in.
                    </br></br>
                    <button> Ask for additional permission</button>

                    </br></br>
                    <button type="button" onclick="window.location='{{ route("index_page") }}'"> Image hosting </button>

                    </br></br>
                    <button disabled> OwnCloud </button> Unfortunately, ownCloud Server does not support Microsoft Windows anymore.

                    </br></br>
                    <button> Plex </button>

                    </br></br>
                    <button> Subsonic </button>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
