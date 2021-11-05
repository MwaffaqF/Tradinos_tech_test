<table class="mb-0 table table-striped  dataTable dtr-inline">
    <thead>
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Deadline</th>
        <th>Created at</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>

    @php $i = 1 @endphp
    @foreach($data as $row)
        <tr>
            <td>{{$i}}</td>
            <td>{{$row->id}}</td>
            <td>{{$row->deadline}}</td>
            <td>{{$row->created_at}}</td>
            <td>
                <a class="mr-2" href="{{route('tasks.show',$row->id)}}"><i class="fa fa-eye"></i></a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{route('tasks.edit',$row->id)}}"><i class="fa fa-edit"></i></a>

                    @endauth
                @endif
            </td>
        </tr>

        @php $i++ @endphp
    @endforeach
    </tbody>


</table>
@if(empty($data))
    <div class="row text-center">
        <div class="col-md-12 alert-danger p-2 font-weight-bold">
            <span class=" ">There are no products yet!</span>
        </div>
    </div>
@endif
<div class="divider"></div>

<div class="pagination justify-content-center" style="margin-right: 10px;">
    @if($data->total() > 2)

        <div class=" pd-flex ">
            {{$data->appends(request()->input())->links()}}
        </div>

    @endif
</div>

