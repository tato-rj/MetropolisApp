@extends('admin.layouts.app')

@push('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush

@section('content')
	@include('admin.pages.users.sections.table')
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready( function () {
    $('#users-table').DataTable();
} );
</script>
@endpush