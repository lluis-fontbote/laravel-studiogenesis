@extends('errors.minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('No estás autorizado a acceder a esta página'))
