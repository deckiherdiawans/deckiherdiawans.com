@extends('/instadeck/app')

@section('title', 'InstaDeck || Explore')

@section('content')
    <div class="container">
        <div class="input-group" id="dhs_search-bar-responsive">
            <input type="text" class="form-control rounded-left">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-fw fa-search"></i></span>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-12 pb-4">
                <a href="{{ $unsplash[$a]['urls']['regular'] }}">
                    <img src="{{ $unsplash[0]['urls']['regular'] }}" class="w-100 h-100">
                </a>
            </div>
        </div>
    </div>
@endsection