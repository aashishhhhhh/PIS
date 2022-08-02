@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_task', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_task', 'block')
@section('task_list', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3>
                @hasanyrole('admin|user')
                    {{$task->staffs->nep_name}}
                    @endrole
                    
                @hasrole('cao')
                {{$taskAssign->staffs->nep_name}}
                @endrole
            </h3>
        </div>
        <div class="card-body overflow-auto">
            <div class="task_comment">

                @foreach ($messages as $item)
                @if ($item->staff_id==auth()->user()->id)
                <div class="task_comment_user2">
                    <h4 class="user_name"> {{$item->staffs->nep_name}} ( {{$item->created_at}}) </h4>
                    <div class="tast_comment_user1_message">
                        {!!$item->comment!!}
                    </div>
                </div>
                @else
                <div class="task_comment_user1">
                    <h4 class="user_name"> {{$item->staffs->nep_name}} ({{$item->created_at}})</h4>
                    <div class="tast_comment_user1_message">
                        {!!$item->comment!!}
                    </div>
                </div>
                @endif

                @endforeach

            </div>
      
        </div>

        <div class="card-footer">
            <div>
                <form action="{{route('assigned-task-comment')}}" method="POST">
                    @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea id="ckeditor" name="comment" class="ckeditor" cols="150" rows="10"></textarea>
                            <input type="hidden" name="task_assign_id" value="{{$id}}">
                            @hasanyrole('admin|user')
                            <input type="hidden" name="receiver_id" value="{{$task->giver_id}}">
                            @endrole
                            
                            @hasrole('cao')
                            <input type="hidden" name="receiver_id" value="{{$taskAssign->staffs->user_id}}">
                            @endrole
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"> Send </button>
                        </div>

                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
