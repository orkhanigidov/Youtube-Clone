@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ $channel->name }}

                        <a href="{{ route('channel.upload', $channel->id) }}">Upload Videos</a>
                    </div>

                    <div class="card-body">
                        @if($channel->editable())
                            <form id="update-channel-form" action="{{ route('channels.update', $channel->id) }}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                @endif
                                <div class="form-group row justify-content-center">
                                    <div class="channel-avatar">
                                        @if($channel->editable())
                                            <div class="channel-avatar-overlay"
                                                 onclick="document.getElementById('image').click()">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="42px" height="32px" viewBox="0 0 42 32"
                                                     enable-background="new 0 0 42 32" xml:space="preserve">
                                            <g>
                                                <path fill="#828282" d="M39.5,6H32c-1.927,0-1.998-1.797-2-2V3c0-1.258-1.39-3-4-3h-9.969c-2.935,0-4,1.794-4,3v0.994
                                                    C12.03,4.076,11.983,6,10,6H2.5C1.121,6,0,7.122,0,8.5v18C0,27.878,1.121,29,2.5,29h6C8.776,29,9,28.776,9,28.5S8.776,28,8.5,28h-6
                                                    C1.673,28,1,27.327,1,26.5V14h8c-0.644,1.54-1,3.229-1,5c0,7.168,5.832,13,13,13s13-5.832,13-13c0-1.771-0.359-3.46-1.003-5H41
                                                    v12.5c0,0.827-0.673,1.5-1.5,1.5h-7c-0.276,0-0.5,0.224-0.5,0.5s0.224,0.5,0.5,0.5h7c1.379,0,2.5-1.122,2.5-2.5v-18
                                                    C42,7.122,40.879,6,39.5,6z M21,31c-6.617,0-12-5.383-12-12S14.383,7,21,7s12,5.383,12,12S27.617,31,21,31z M32.75,13
                                                    c-0.074,0-0.143,0.018-0.206,0.047C30.38,8.868,26.022,6,21,6s-9.38,2.868-11.544,7.047C9.393,13.018,9.324,13,9.25,13H1V8.5
                                                    C1,7.673,1.673,7,2.5,7H10c2.368,0,3.019-1.958,3.031-3V3c0-0.804,0.799-2,3-2H26c2.094,0,3,1.324,3,2v1c0,1.038,0.627,3,3,3h7.5
                                                    C40.327,7,41,7.673,41,8.5V13H32.75z"/>
                                                <path fill="#828282" d="M9.5,5C9.776,5,10,4.776,10,4.5v-1C10,2.673,9.327,2,8.5,2h-4C3.673,2,3,2.673,3,3.5v1
                                                    C3,4.776,3.224,5,3.5,5S4,4.776,4,4.5v-1C4,3.224,4.225,3,4.5,3h4C8.775,3,9,3.224,9,3.5v1C9,4.776,9.224,5,9.5,5z"/>
                                                <path fill="#828282" d="M21,10c-4.963,0-9,4.038-9,9s4.037,9,9,9s9-4.038,9-9S25.963,10,21,10z M21,27c-4.411,0-8-3.589-8-8
                                                    s3.589-8,8-8s8,3.589,8,8S25.411,27,21,27z"/>
                                            </g>
                                        </svg>
                                            </div>
                                        @endif
                                        <img src="{{ $channel->image() }}" alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="text-center">
                                        {{ $channel->name }}
                                    </h4>
                                    <p class="text-center">
                                        {{ $channel->description }}
                                    </p>
                                    <div class="text-center">
                                        <subscribe-button :channel="{{ $channel }}"
                                                          :initial-subscriptions="{{ $channel->subscriptions }}"></subscribe-button>
                                    </div>
                                </div>
                                @if($channel->editable())
                                    <input id="image" type="file" name="image" hidden
                                           onchange="document.getElementById('update-channel-form').submit()">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">
                                            Name
                                        </label>
                                        <input id="name" name="name" value="{{ $channel->name }}" type="text"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-control-label">
                                            Description
                                        </label>
                                        <textarea id="description" name="description" rows="3"
                                                  class="form-control">{{ $channel->description }}</textarea>
                                    </div>
                                    @if($errors->any())
                                        <ul class="list-group mb-5">
                                            @foreach($errors->all() as $error)
                                                <li class="list-group-item text-danger">
                                                    {{ $error }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <button type="submit" class="btn btn-info">
                                        Update Channel
                                    </button>
                                @endif
                                @if($channel->editable())
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
