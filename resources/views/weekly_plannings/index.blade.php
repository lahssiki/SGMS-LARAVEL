@extends('layouts.default')

@section('content')
<div class="container">
    <h4 class="text-center mb-4">Liste des plannings hebdomadaires</h4>

    <table class="table table-striped table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Agent</th>
                <th>Semaine</th>
                <th>Lun</th><th>Mar</th><th>Mer</th>
                <th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th><th>Edit</th>
            </tr>
        </thead>
        <tbody>
        @foreach($weeklyPlannings as $w)
            <tr>
                <td>{{ $w->securityGuard->fullname }}</td>
                <td>{{ $w->week_start }}</td>
                <td>{{ $w->monday ?? 'Off' }}</td>
                <td>{{ $w->tuesday ?? 'Off' }}</td>
                <td>{{ $w->wednesday ?? 'Off' }}</td>
                <td>{{ $w->thursday ?? 'Off' }}</td>
                <td>{{ $w->friday ?? 'Off' }}</td>
                <td>{{ $w->saturday ?? 'Off' }}</td>
                <td>{{ $w->sunday ?? 'Off' }}</td>
                <td>
                <a href="{{ route('weekly-plannings.edit', $w->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
                                        
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
