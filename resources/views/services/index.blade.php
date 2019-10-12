@extends('master')

@section('content')
    <div class="ui vertical stripe segment">
        <div class="ui middle aligned stackable grid container">
            <div class="row">
                <div class="sixteen wide column">
                    <h4 class="ui dividing header">Add New Service</h4>
                    {!! Form::open(['action' => 'ServiceController@store']) !!}
                    <div class="form ui">
                        <div class="inline fields">
                            <div class="field">
                                <label>Service Name : </label>
                                <input required type="text" placeholder="Service Name" name="name">
                            </div>
                            <div class="field">
                                <label>Platform : </label>
                                <div class="ui selection dropdown">
                                    <input required type="hidden" name="platform_id">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Platform Name : </div>
                                    <div class="menu">
                                        @foreach(\App\Platform::all() as $platform)
                                            <div class="item" data-value="{{$platform['id']}}">{{$platform['name']}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Order : </label>
                                <input required type="number" placeholder="0" name="index" value="0">
                            </div>
                            <div class="field">
                                <button class="ui primary button">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <table class="ui celled table">
                    <thead>
                    <tr><th>Service ID</th>
                        <th>Service Name</th>
                        <th>Platform Name</th>
                        <th>Servers</th>
                        <th>Order</th>
                        <th>Enabled</th>
                        <th>Action</th>
                    </tr></thead>
                    <tbody>
                    @foreach(\App\Service::all() as $service)
                        <tr>
                            <td data-label="id">{{$service['id']}}</td>
                            <td>{{$service['name']}}</td>
                            <td>{{$service->platform->name}}</td>
                            <td><a href="{{action('ServerController@ServiceServers',$service['id'])}}">{{$service->servers()->get()->count()}}</a></td>
                            <td>{{$service->index}}</td>
                            <td>{{$service->is_enabled ? "true":"false"}}</td>
                            <td><a data-id="{{$service['id']}}" data-name="{{$service['name']}}"  data-index="{{$service->index}}" data-enabled="{{$service->is_enabled}}" class="edit" href="#">Edit</a>&nbsp;|&nbsp;<a data-id="{{$service['id']}}" class="del" href="#">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="DeleteModal" class="ui mini modal">
        <div class="content">
            <p>Are you sure that you want to delete this service?</p>
        </div>
        <div class="actions">
            <div class="ui negative button">
                <i class="remove icon"></i>
                No
            </div>
            <div class="ui positive right labeled icon button">
                <i class="checkmark icon"></i>
                Yes
            </div>
        </div>
    </div>
    <div id="EditModal" class="ui small modal">
        <div class="ui icon header">
            <i class="edit icon"></i>
            Edit Service
        </div>
        <div class="content">
            <div class="form ui">
                <div class="inline field">
                    <label>Service Name : </label>
                    <input type="text" placeholder="Service Name" name="name" id="edit">
                </div>
                <div class="inline field">
                    <label>Order : </label>
                    <input type="number" placeholder="0" name="index" id="index">
                </div>
                <div class="inline field checkbox">
                    <label>Enable </label>
                    <input type="checkbox" placeholder="0" name="enabled" id="enabled">
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui negative button">
                <i class="remove icon"></i>
                Cancel
            </div>
            <div class="ui green ok button">
                <i class="checkmark icon"></i>
                Edit
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(()=>{
            $('.ui.dropdown')
                .dropdown()
            ;
            $(".del").click((e)=>{
                $('#DeleteModal').modal({
                    closable  : false,
                    onDeny    : function(){

                    },
                    onApprove : function() {
                        let id = $(e.target).data('id');
                        deleteRecord(id);
                    }
                }).modal('show');
                e.preventDefault();
            });
            $(".edit").click((e)=>{
                let name = $(e.target).data('name');
                let index = $(e.target).data('index');
                let is_enabled = $(e.target).data('enabled');
                $("#edit").val(name);
                $("#index").val(index);
                if(is_enabled =='1'){
                    $("#enabled").prop('checked','true');
                }else{
                    $("#enabled").removeProp('checked');

                }
                $('#EditModal').modal({
                    closable  : false,
                    onDeny    : function(){

                    },
                    onApprove : function() {
                        let id = $(e.target).data('id');
                        editRecord(id,$("#edit").val(),$("#index").val(), $("#enabled").prop('checked'));
                    }
                }).modal('show');
                e.preventDefault();
            });
        });
        function deleteRecord(id){
            $.ajax({
                url: "{{action("ServiceController@index")}}/" + id,
                type: "DELETE",
                data: {
                    "id":id
                },
                success : function(){
                    location.reload();
                },
                error : function () {
                    alert('Unable to delete record');
                }
            });
        }
        function editRecord(id,name,index , enabled){
            $.ajax({
                url: "{{action("ServiceController@index")}}/" + id,
                type: "PUT",
                data: {
                    "id":id,
                    "name":name,
                    "index":index,
                    "is_enabled":enabled ? 1: 0
                },
                success : function(){
                    location.reload();
                },
                error : function () {
                    alert('Unable to edit record');
                }
            });
        }
    </script>
@stop