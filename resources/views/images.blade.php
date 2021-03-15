@extends('layouts.app')

@section('home')
    <div class="row">
        <div class="col-md-12">

            @if (isset($isCache))
                <h3 class="mb-3 mt-5">
                    {{$isCache ? 'This is a cache' : 'New Request'}}
                    <small class="text-muted fs-6">
                        {{ $isCache ? ' - will expire after( ' . $cacheExpiration . ' )' : null }}
                    </small>
                </h3>
            @endif

            <div class="d-flex flex-row flex-wrap justify-content-center bd-highlight mb-5">
                @foreach ($images as $image)
                    <div class="card m-2 mb-4 box-shadow shadow-sm">
                        <a href="{{$image['largeImageURL']}}" target="_blank">
                            <img src="{{$image['webformatURL']}}"class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <p>{{$image['tags']}}</p>
                        </div>
                        <div class="card-footer">
                            <form action="{{url('/save')}}" method="POST" target="_blank">
                                <input type="hidden" name="id'" value="{{$image['id']}}">
                                <input type="hidden" name="webformatURL" value="{{$image['webformatURL']}}">
                                <input type="hidden" name="largeImageURL" value="{{$image['largeImageURL']}}">
                            </form>

                            @if (!$hideSaveButton)
                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-secondary save-button"
                                    data-id="{{$image['id']}}"
                                    data-largeImageURL="<?php echo $image['largeImageURL']; ?>"
                                    data-webformatURL="<?php echo $image['webformatURL']; ?>"
                                    data-tags="{{$image['tags']}}"
                                    data-url="{{url('/save')}}"
                                    data-token="{{ csrf_token() }}"
                                >
                                    Save
                                </button>
                            @endif

                            <small class="card-text mt-auto float-end text-secondary">#{{ $image['id'] }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
