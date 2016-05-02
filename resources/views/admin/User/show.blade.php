@extends('admin.show.container')
@section('detail')
    <div class="col-md-8">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <ul class="list-group user list-group-unbordered">
                    <li class="list-group-item">
                        <b>Role: </b> {{ $object->role_id == 1 ? 'Admin' : 'User' }}
                    </li>
                    <li class="list-group-item">
                        <b>Name: </b> {{ $object->name }}
                    </li>
                    <li class="list-group-item">
                        <b>Email: </b> {{ $object->email }}
                    </li>
                    <li class="list-group-item">
                        <b>Joined At:</b> {{ $object->created_at->diffForHumans() }}
                    </li>
                    
                </ul>
            </div>

        </div>
        <!-- /.box -->
    </div>
    <!-- /.col-md-8 -->
@stop