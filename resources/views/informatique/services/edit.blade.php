@extends('layouts.informatique.master')

@section('title')Modifiaction Service
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Modifiaction Service</h3>
    @endslot
    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
    <li class="breadcrumb-item active">Modifiaction Service</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Modification Service</h5>
                </div>
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="form theme-form">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') ?? $service->nom }}" type="text" placeholder="Nom service" />
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" cols="5" placeholder="Description Service">{{ old('description') ?? $service->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection