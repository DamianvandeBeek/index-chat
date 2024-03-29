@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat:</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
            <iframe src="/load-messages/{{$room_info->id}}" frameborder="0" style="height:50vh;width:100%;overflow-y:hidden;" scrolling="no"></iframe>
                   
                    <form method="POST" action="/send-message">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input id="message" type="text" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" placeholder="Type your message here..." required autofocus>

                                @if ($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="text" value="{{$room_info->id}}" style="display:none" name="room_id">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Send or press Enter
                                </button>
                            </div>
                        </div>
                    </form>
                        
                        <hr><br><br>
                   <form method="POST" action="/add-user-to-room">
                        @csrf

                        <div class="form-group row">
                               <label for="user" class="col-md-3 col-form-label text-md-right">
                                Search user:
                            </label>
                            <div class="col-md-5">
                                <input id="added_user" type="text" class="form-control{{ $errors->has('added_user') ? ' is-invalid' : '' }}" name="added_user" required autofocus>

                                @if ($errors->has('added_user'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('added_user') }}</strong>
                                    </span>
                                @endif
                            </div>
                                
                                 <input type="text" value="{{$room_info->id}}" style="display:none" name="room_id">
                                 
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Add User to room
                                </button>
                            </div>
                        </div>

                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
