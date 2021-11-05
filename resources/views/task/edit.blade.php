@extends('layouts.app')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-edit icon-gradient bg-warm-tradinos">
                        </i>
                    </div>
                    <div>Edit Task
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="" action="{{route('tasks.update',$data['task']->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative row form-group"><label for="description"
                                                                                 class="col-sm-2 col-form-label">description</label>
                                <div class="col-sm-10"><textarea name="description" id="description"
                                                                 class="form-control">{{$data['task']->description}}</textarea>
                                </div>
                            </div>
                            <div class="position-relative row form-group"><label for="deadline"
                                                                                 class="col-sm-2 col-form-label">Deadline
                                    Date</label>
                                <div class="col-sm-10"><input name="deadline" id="deadline" placeholder="deadline date"
                                                              type="date"
                                                              class="form-control" value="{{$data['task']->deadline}}">
                                </div>
                            </div>

                            <div class="position-relative row form-group"><label for="category"
                                                                                 class="col-sm-2 col-form-label">Categories</label>
                                <div class="col-sm-10">
                                    <div class="position-relative form-group">

                                        <select multiple="multiple" name="category[]" id="category"
                                                class="form-control multiple_select">
                                            @foreach($data['categories'] as $category)
                                                <option value="{{$category->id}}"
                                                        @foreach($data['task']->categories as $task_category)
                                                        @if($category->id == $task_category->id)  selected @endif
                                                    @endforeach

                                                >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group"><label for="assign"
                                                                                 class="col-sm-2 col-form-label">Assign</label>
                                <div class="col-sm-10">
                                    <div class="position-relative form-group">

                                        <select name="assign" id="assign" class="form-control">
                                            <option></option>
                                            @foreach($data['assignees'] as $assignee)
                                                <option value="{{$assignee->id}}"
                                                        @if($data['task']->assignee->id == $assignee->id)  selected @endif>
                                                    {{$assignee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="position-relative row form-group "><label for="sub_task"
                                                                                  class="col-sm-2 col-form-label">Sub
                                    Tasks</label>
                                <div class="col-sm-10">
                                    <input name="sub_task[]"  placeholder="sub task" type="hidden"
                                           class="form-control mb-2" id="cloneable" >
                                    @foreach($data['task']->subTasks as $subTask)
                                        <input name="sub_task[]" placeholder="sub task" type="text"
                                               class="form-control mb-2"  value="{{$subTask->description}}" >
                                    @endforeach

                                    <div class="appendable"></div>
                                    <div class="btn btn-secondary bg-warm-tradinos btn-sm mt-2" id="btn_clone"><i
                                            class="fa fa-plus-circle"></i> Add Sub Task
                                    </div>

                                </div>
                            </div>

                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-secondary bg-warm-tradinos btn-lg ">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@overwrite
@section('script')
    <script>
        $(document).ready(function () {
            let i = 1;
            $("#btn_clone").click(function () {
                $('#cloneable').clone().each(function (j) {
                    this.id = "id" + i; // to keep it unique
                    this.placeholder = "sub task" + i;
                    this.type = 'text';
                    this.value = '';
                }).appendTo(".appendable");
                i++;
            });
        });
    </script>
@endsection
