@extends('layouts.default')
@section('content')

<div>
    <h6 class="text-center">Security Guard Management</h6>
    <table  class="table table-hover" >
        <tr>
            <th>ID</th>
            <th>fullname</th>
            <th>cin</th>
            <th>adresse</th>
            <th>categorie</th>
            <th>created_at</th>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>

            @foreach ($securityGuards as $item )
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->fullname}}</td>
                    <td>{{$item->cin}}</td>
                    <td>{{$item->adresse}}</td>
                    <td>{{$item->categorie}}</td>
                    <td>{{$item->created_at->format('Y-m-d') }}</td>
                    <td><a href="{{ route('security-guards.show', $item->id) }}" class="btn btn-primary">Détails</a></td>
                    <td><a href="{{ route('security-guards.edit', $item->id) }}" class="btn btn-warning">Edit</a></td>
                    <td><form action="{{ route('security-guards.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form></td>
                </tr>
            @endforeach
        </tr>
    </table>
</div>
<div class="text-center">Adresse IP de l'utilisateur : {{ $ipAddress }}</div>

@endsection
