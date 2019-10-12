@extends('master')

@section('content')
    <div class="ui vertical stripe segment">
        <div class="ui middle aligned stackable grid container">
            <div class="row">
                <div class="sixteen wide column">
                    <h4 class="ui dividing header">Edit Server</h4>
                    {!! Form::open(['action' => ['ServerController@update',$record->id] , 'method' => 'PUT']) !!}
                    <div class="form ui">
                        <input type="hidden" name="server_id" value="{{$record->id}}" />
                        <div class="fields">
                            @foreach($record->properties as $value)
                                <div class="field">
                                    <label>{{$value->property->name}}</label>
                                    <input type="hidden" required name="property_id[]" value="{{$value->id}}" />
                                    <input type="text" required name="property_value[]" value="{{$value->value}}" placeholder="{{$value->property->name}}">
                                </div>
                            @endforeach
                                <div class="field">
                                    <label>Tags</label>

                                    <select name="tags[]" multiple="" class="ui dropdown">
                                        @foreach(\App\Tag::all() as $tag)
                                            @php($found = false)
                                            @foreach($record->tags as $t)
                                                @if($t->tag_id == $tag->id)
                                                    @php($found = true)
                                                @endif
                                            @endforeach

                                            <option @if ($found) selected @endif value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Order : </label>
                                    <input required type="number" placeholder="0" name="index" value="{{$record->index}}">
                                </div>
                        </div>

                    </div>
                    <input class="ui submit button primary" type="submit" value="Save" />
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section ('scripts')
    <script type="text/javascript">
        $(document).ready(()=>{
            $('.dropdown').dropdown();
        });
    </script>
@stop
