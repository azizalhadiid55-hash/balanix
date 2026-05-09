@extends('layouts.mainTemplateMember')

@section('title', 'Balabot')
@section('sub-title', 'Balabot AI')

@section('css')
	@livewireStyles
	<link rel="stylesheet" href="{{ asset('assets/css/balabot.css') }}">
@endsection

@section('konten')
	<livewire:chat />
@endsection

@section('js')
	@livewireScripts
@endsection
