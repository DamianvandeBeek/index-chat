@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">OOWPSIE</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    We awe vewy sowwy tuwu infowm thawt thiws URL awweady exist, pwease twy anothew owne OwO<br>
                    <a href="/make-chatroom">
                        <button class="btn btn-primary">Try another url</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
