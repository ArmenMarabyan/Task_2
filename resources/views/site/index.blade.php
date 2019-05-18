@extends('site.layouts.site')

@section('content')
<div class="col-lg-12 my-3 p-3 bg-white rounded shadow-sm">
	<div class="row">
		<div class="col-lg-4 mx-auto">
			<form class="search_form mb-2 " method="get" action="{{route('home')}}">	
				<div class="input-group d-flex">
					<input type="text" class="form-control datepicker" name="date">
					<button class="btn btn-secondary w-100" type="submit" >
						<i class="fa fa-search"></i>
					</button>
				</div>
			</form>
			<table class="table table-striped table-bordered" id="currencies">
				<thead>
					<tr>
						<th scope="col">Currencies</th>
						<th scope="col">AMD</th>
					</tr>
				</thead>
				<tbody>
					@for($i = 0; $i < count($content[0])-1; $i++)
					<tr>
						<td>{{Session::get('currencies.' . $content[0][$i+1])}} {{$content[0][$i+1]}}</td>
						<td>{{$content[1][$i+1]??'No data available'}}</td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection




@section('scripts')
@endsection
