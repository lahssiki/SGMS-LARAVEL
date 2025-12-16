@extends('layouts.default')

@section('content')
<div class="container">
    <style>
select option[value="Morning"] { background-color: #d1e7dd; }
select option[value="Night"] { background-color: #cff4fc; }
</style>
    <h4 class="text-center mb-4">Planning Hebdomadaire</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('weekly-plannings.store') }}">
        @csrf

        <!-- Security -->
        <div class="mb-3">
            <label class="form-label">Agent de sécurité</label>
            <select name="security_guard_id" class="form-control" required>
                <option value="">-- Sélectionner --</option>
                @foreach($guards as $guard)
                    <option value="{{ $guard->id }}">{{ $guard->fullname }}</option>
                @endforeach
            </select>
        </div>

        <!-- Week -->
        <div class="mb-3">
            <label class="form-label">Début de la semaine (Lundi)</label>
            <input type="date" name="week_start" class="form-control" required>
        </div>

        <!-- Planning Table -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Jour</th>
                        <th>Shift</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $days = [
                        'monday' => 'Lundi',
                        'tuesday' => 'Mardi',
                        'wednesday' => 'Mercredi',
                        'thursday' => 'Jeudi',
                        'friday' => 'Vendredi',
                        'saturday' => 'Samedi',
                        'sunday' => 'Dimanche',
                    ];
                @endphp

                @foreach($days as $key => $day)
                    <tr>
                        <td>{{ $day }}</td>
                        <td>
                            <select name="{{ $key }}" class="form-control">
                                <option value="">Off</option>
                                <option value="Morning">Morning</option>
                                <option value="Night">Night</option>
                                <option value="FullDay">Full Day</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <button class="btn btn-success px-5">Enregistrer le planning</button>
        </div>
    </form>
</div>
@endsection
