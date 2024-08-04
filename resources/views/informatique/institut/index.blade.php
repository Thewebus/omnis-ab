@extends('layouts.informatique.master')

@section('title')Instituts
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
		<h3>Instituts</h3>
		@endslot
		{{-- <li class="breadcrumb-item">Accueil</li> --}}
		<li class="breadcrumb-item active">Instituts</li>
	@endcomponent

	<div class="container-fluid">
		<div class="row">
			<!-- Default ordering (sorting) Starts-->
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<h5>Institut</h5>
							<span>
								Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum odio pariatur mollitia sunt temporibus dicta inventore asperiores praesentium quae, autem velit assumenda non exercitationem laborum. Distinctio sed architecto dolorem alias. <br>
							</span>
                            <a href="{{ route('admin.institut.create') }}" class="btn btn-success mt-3"> <i class="fa fa-plus"></i> Ajouter</a>
							{{-- <span>
								The<code class="option" title="DataTables initialisation option">order:Option</code> parameter is an array of arrays where the first value of the inner array is the column to order on, and the second is
								<code class="string" title="String">'asc':String</code> (ascending ordering) or <code class="string" title="String">'desc':String</code> (descending ordering) as required.
								<code class="option" title="DataTables initialisation option">order:String</code> is a 2D array to allow multi-column ordering to be defined.
							</span> --}}
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="display dataTable" id="basic-3">
									<thead>
										<tr>
											<th>N°</th>
											<th>Nom</th>
											<th>Description</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($instituts as $institut)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $institut->nom }}</td>
											<td>{{ $institut->description }}</td>
											<td>
												<a href="{{ route('admin.institut.edit', $institut->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('admin.institut.destroy', $institut->id) }}" style="display: inline-block" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th>N°</th>
											<th>Nom</th>
											<th>Description</th>
											<th>Actions</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- Default ordering (sorting) Ends-->
		</div>
	</div>


	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	@endpush

@endsection