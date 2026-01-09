@extends('layouts.informatique.master')

@section('title')Matières - Fiche Note
    {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.informatique.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Liste des matières - Fiche Note</h3>
		@endslot
		<li class="breadcrumb-item">Liste</li>
		<li class="breadcrumb-item active">Liste des matières</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<span style="font-size: 1rem">Liste des matières, classe <b>{{ $classe->nom }}</b></span>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="display" id="basic-2">
								<thead>
									<tr>
										<th>N°</th>
										<th>Nom matière</th>
										<th>N° Ordre</th>
										<th>Coef.</th>
										<th>cred.</th>
										<th>N° Sem.</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($matieres as $matiere)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $matiere->nom }}</td>
										<td>{{ $matiere->numero_ordre }}</td>
										<td>{{ $matiere->coefficient }}</td>
										<td>{{ $matiere->credit }}</td>
										<td>{{ $matiere->semestre }}</td>
										<td>
											<a href="{{ route('admin.fiche-note-classe-pdf', $matiere) }}" class="btn btn-success mt-3"><i class="fa fa-print"></i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	@endpush

@endsection