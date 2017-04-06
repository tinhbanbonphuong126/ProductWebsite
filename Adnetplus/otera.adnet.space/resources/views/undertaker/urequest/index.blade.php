@extends('layouts.app-one')

@section('content')
<div class="container">

    <h1>Urequest <a href="{{ url('/urequest/create') }}" class="btn btn-primary btn-xs" title="Add New urequest"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Funeral Id </th><th> Funeral Name </th><th> Start Time </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($urequest as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->funeral_id }}</td><td>{{ $item->funeral_name }}</td><td>{{ $item->start_time }}</td>
                    <td>
                        <a href="{{ url('/urequest/' . $item->id) }}" class="btn btn-success btn-xs" title="View urequest"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/urequest/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit urequest"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/urequest', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete urequest" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete urequest',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $urequest->render() !!} </div>
    </div>

</div>
@endsection
