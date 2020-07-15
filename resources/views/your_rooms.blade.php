@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                Your rooms:
                <a href="/make-chatroom">
                        <button style="float:right" class="btn btn-primary">Make a new chatroom</button>
                    </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

               
               @foreach($all_rooms as $r) 
               <a href="/enter-room/{{$r}}"><button class="btn btn-primary">
               {{$r}}</button></a><br><br>
               
               @endforeach
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
