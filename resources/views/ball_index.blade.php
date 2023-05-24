@extends("master")

@section("title") Balls @endsection
@section("content")

<div class="row mb-4">
    <div class="col-xl-6">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">× </button>
                {{Session::get('success')}}
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">× </button>
                {{Session::get('failed')}}
            </div>
        @endif
    </div>

    <div class="col-xl-6 text-right">
        <a href="{{route('balls.create')}}" class="btn btn-success "> Add New </a>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <th> Id </th>
        <th> Name </th>
        <th> Volume </th>
        <th> Action </th>
    </thead>

    <tbody>

        @if(count($balls) > 0)
            @foreach($balls as $ball)
                <tr>
                    <td> {{$ball->id}} </td>
                    <td> {{$ball->name}} </td>
                    <td> {{$ball->volume}} </td>
                    <td>
                        <form action="{{route('balls.destroy', $ball->id)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <!-- <a href="{{route('balls.show', $ball->id)}}" class="btn btn-sm btn-info"> View </a> -->
                            <!-- <a href="{{route('balls.edit', $ball->id)}}" class="btn btn-sm btn-success"> Edit </a> -->

                            <button type="submit" class="btn btn-sm btn-danger"> Delete </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{!! $balls->links() !!}
@endsection
