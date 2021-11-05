@extends('layouts.app')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-table icon-gradient bg-warm-tradinos">
                        </i>
                    </div>
                    <div>Tasks Table
                    </div>
                </div>
                @if (Route::has('login'))
                    @auth
                        <div class="page-title-actions">
                            <a href="{{route('tasks.create')}}" data-toggle="tooltip" title="create a new Task"
                               data-placement="bottom"
                               class="btn-shadow mr-3 btn bg-warm-tradinos text-white btn-lg font-weight-bold">Add Task
                                <i class="fa fa-plus-square text-white"></i>
                            </a>
                        </div>
                    @endauth
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input name="search" placeholder="Search...." type="text" class="form-control search_input">
                    <div class="input-group-append">
                        <button class="btn bg-warm-tradinos text-white search_btn">Search <i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <label for="id">ID:</label>
                <div class="input-group">
                    <input name="id" placeholder="ID" type="text" class="form-control id_input">
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <label for="deadline">Deadline:</label>
                <div class="input-group">
                    <input name="deadline" placeholder="Deadline Date" type="date" class="form-control deadline_input">
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <label for="created_at_from">Created At From:</label>
                <div class="input-group">
                    <input name="created_at_from" placeholder="Created At From" type="date" class="form-control created_at_from_input">
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <label for="created_at_to">Created At To:</label>
                <div class="input-group">
                    <input name="created_at_to" placeholder="Created At To" type="date" class="form-control created_at_to_input">
                </div>
            </div>


        </div>

        <div class="divider"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body" id="table_data">
                        @include('tasks_rows')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });
            $(document).on('change', ['.search_input','.id_input','.deadline_input','.created_at_from_input','.created_at_to_input'], function (event) {
                event.preventDefault();
                var search = $('.search_input').val();
                var ID = $('.id_input').val();
                var deadline = $('.deadline_input').val();
                var created_from = $('.created_at_from_input').val();
                var created_to = $('.created_at_to_input').val();
                fetch_filter_data(search,ID,deadline,created_from,created_to);

            });

            function fetch_filter_data(search,ID,deadline,created_from,created_to) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('tasks.get') }}",
                    method: "GET",
                    data: {
                        search: search,
                        id: ID,
                        deadline: deadline,
                        created_from: created_from,
                        created_to: created_to,
                    },
                    success: function (data) {
                        $('#table_data').html(data);
                    }
                });
            }

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('tasks.get') }}",
                    method: "GET",
                    data: {
                        _token: "{{ csrf_token() }}",
                        page: page
                    },
                    success: function (data) {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endsection
