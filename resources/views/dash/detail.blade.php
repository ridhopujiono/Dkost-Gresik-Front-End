@extends('dash.template.main')
@section('container')

@livewire('resident-room', ['resident_id' => ($resident_id ?? null), 'room_id' => ($room_id ?? null)])

@endsection