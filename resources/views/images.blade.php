@extends('layouts.app')

@section('home')
    <div class="row">
        @foreach ($images as $image)
            <div class="col-md-3">
                <div class="card mb-4 box-shadow">
                    <img src="{{$image['userImageURL']}}" class="img-thumbnail" alt="...">
                    <div class="card-body">
                        <p class="card-text">This is image {{ $image['id'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
