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
                    <a href="images")">
                        <button>Image hosting</button>
                    </a>
                    

                    
                    </br></br>
                    <button disabled> OwnCloud </button> Unfortunately, ownCloud Server does not support Microsoft Windows anymore.
                    
                    </br></br>
                    <a href="http://daav.blogdns.com:32400">
                    <button>Plex</button>
                    </a>

                    </br></br>
                    <a href="http://daav.blogdns.com:4040/music">
                    <button> Subsonic </button>
                    </a>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
