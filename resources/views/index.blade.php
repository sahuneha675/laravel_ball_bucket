@extends("master")
@section("content")


<div class="row mb-4">

    <div class="col-xl-6 text-right">
        <a href="{{route('buckets.index')}}" class="btn btn-success "> Go to bucket page </a>
    </div>
</div>
<div>
   <h2>Bucket List</h2> 
</div>
<table class="table table-striped">
    <thead>
        <th> Id </th>
        <th> Name </th>
        <th> Volume </th>
    </thead>

    <tbody>

        @if(count($buckets) > 0)
            @foreach($buckets as $bucket)
                <tr>
                    <td> {{$bucket->id}} </td>
                    <td> {{$bucket->name}} </td>
                    <td> {{$bucket->volume}} </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


<div class="row mb-4">
    

    <div class="col-xl-6 text-right">
        <a href="{{route('balls.index')}}" class="btn btn-success "> Go to ball page </a>
    </div>
</div>
<div>
   <h2>Ball List</h2> 
</div>
<table class="table table-striped">
    <thead>
        <th> Id </th>
        <th> Name </th>
        <th> Volume </th>
    </thead>

    <tbody>

        @if(count($balls) > 0)
            @foreach($balls as $ball)
                <tr>
                    <td> {{$ball->id}} </td>
                    <td> {{$ball->name}} </td>
                    <td> {{$ball->volume}} </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


<hr>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <form action="{{route('game.distribute')}}" method="POST">
            @csrf
            @foreach($balls as $ballscolor)
            <td>
            <input type="hidden" name="records[{{ $ballscolor->id }}][id]" value="{{ $ballscolor->id }}">
            <input type="hidden" name="records[{{ $ballscolor->id }}][volume]" value="{{ $ballscolor->volume }}">
            </td>
            <td>
            <input type="text" name="records[{{ $ballscolor->id }}][name]" value="{{ $ballscolor->name }}">
            </td>
            <td>
                <input type="text" name="records[{{ $ballscolor->id }}][count]" value="{{ $ballscolor->count }}">
            </td>
            @endforeach
            <hr>

            <div class="col-xl-6 text-right">
                <button type="submit" class="btn btn-success">Place balls in bucket </button>
            </div>
            <!-- <div class="card shadow">
                
                <div class="card-header">
                    <h4 class="card-title"> Bucket suggestion </h4>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="title"> Title </label>
                        <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
                        {!!$errors->first("title", "<span class='text-danger'>:message </span>")!!}
                    </div>

                    <div class="form-group">
                        <label for="description"> Description </label>
                        <textarea class="form-control" name="description" id="description">{{old('description')}}</textarea>
                        {!!$errors->first("description", "<span class='text-danger'>:message </span>") !!}
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success"> Save </button>
                </div>
            </div> -->
        </form>
    </div>
</div>

<hr>

@endsection
