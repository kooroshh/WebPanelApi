@extends('master')

@section('content')
    <div class="ui vertical stripe segment">
        <div class="ui middle aligned stackable grid container">
            <div class="row">
                <div class="ui statistics">
                    <div class="statistic">
                        <div class="label">
                            <a href="{{action('PlatformController@index')}}">Platforms</a>
                        </div>
                        <div class="value">
                            {{\App\Platform::all()->count()}}
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="label">
                            <a href="{{action('ServiceController@index')}}"> Services</a>
                        </div>
                        <div class="value">
                            {{\App\Service::all()->count()}}
                        </div>
                    </div>
                    @foreach(\App\Service::all() as $service)
                    <div class="statistic">
                        <div class="label">
                            <a href="{{action('ServerController@ServiceServers',$service->id)}}">{{$service->name}}</a>
                        </div>
                        <div class="value">
                            {{$service->servers()->get()->count()}}
                        </div>
                    </div>
                    @endforeach
                    <div class="statistic">
                        <div class="label">
                            <a href="{{action('SettingsController@index')}}">Settings</a>
                        </div>
                        <div class="value">
                            {{\App\Setting::all()->count()}}
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="label">
                            Total Servers
                        </div>
                        <div class="value">
                            {{\App\Server::all()->count()}}
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="label">
                            Total Properties
                        </div>
                        <div class="value">
                            {{\App\Property::all()->count()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.menu .item')
                .tab()
            ;

        });
    </script>
@stop