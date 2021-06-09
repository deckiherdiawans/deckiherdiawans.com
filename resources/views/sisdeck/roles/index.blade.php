@extends('/sisdeck/layouts/app')

@section('title', 'SisDeck | Roles')

@section('content')
    <div class="row align-items-center px-3 pt-3">
        <div class="col-sm-6 dhs_col-header"><h3>Roles</h3></div>
        <div class="col-sm-6 dhs_col-button">
            <a href="#" data-toggle="modal" data-target="#add-role_modal" class="btn btn-primary dhs_button">Add New Role</a>
        </div>
    </div>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('/sisdeck/roles/table')
                {!! Form::open(['route' => 'sisdeck.roles.store']) !!}
                    @include('/sisdeck/roles/fields')
                {!! Form::close() !!}
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

