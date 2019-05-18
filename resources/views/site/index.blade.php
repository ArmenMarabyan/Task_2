@extends('site.layouts.site')

@section('content')
<div class="col-lg-12 my-3 p-3 bg-white rounded shadow-sm">
	<div class="row">
		<div class="col-lg-12">
			<form class="search_form mb-2 w-50 m-auto" method="get" action="{{route('home')}}">	
				<div class="form-group d-flex">
					<div class="input-group d-flex">
						<input type="text" class="form-control datepicker" name="date">
					</div>
					<button class="btn btn-secondary" type="submit" name="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>

			</form>
		</div>
		<div class="col-lg-12">
			
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
