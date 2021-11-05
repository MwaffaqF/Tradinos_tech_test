@extends('layouts.app')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-tasks icon-gradient bg-warm-tradinos">
                        </i>
                    </div>
                    <div>Show Task
                    </div>
                </div>
                @if (Route::has('login'))
                    @auth
                        <div class="page-title-actions">
                            <form action="{{ route('tasks.destroy',$data->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <input class="btn btn-danger" type="submit" value="Delete" /><i class="fa fa-close text-white"></i>
                            </form>
                        </div>
                        @method('DELETE')
                        @csrf
                    @endauth
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="main-card mb-3 card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="product-title">Description:</h2>
                                <p>{{$data->description}}</p>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="mb-2 mr-2 btn btn-primary">Assigned To: <span
                                        class="badge badge-pill badge-light">{{$data->assignee->name}}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="main-card mb-3 card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="">Categories:</h6>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($data->categories as $category)
                                <div class="col-md-3">
                                    <span
                                        class="btn  mb-2 bg-task-{{$category->color}} text-white">{{$category->name}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class=" center-elem">
                    <div class="main-card mb-3 card col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="product-details mt-2">Deadline Date: <span
                                            class="btn btn-lg btn-danger">{{$data->deadline}}</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="main-card mb-3 card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="product-details ">Sub Tasks:</h2>
                                <div class="divider"></div>

                                @foreach($data->subTasks as $subTask)

                                    <div class="row">
                                        <div class="col-md-12 btn btn-block btn-primary text-left mb-2">
                                            <span>{{$subTask->description}}</span>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@overwrite
