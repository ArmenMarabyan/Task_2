@extends('site.layouts.site')

@section('content')
	<div class="col-lg-12 my-3 p-3 bg-white rounded shadow-sm">
		<div class="row">
			<div class="col-lg-8 mx-auto align-items-center">
				<form class="search_form mb-2 " method="get" action="{{route('graphs')}}">	
					<div class="row">
						<div class="input-group col-lg-3 d-flex">
							<input type="text" class="form-control datepicker" name="fromDate">
						</div>
						
						<div class="input-group col-lg-3 d-flex">
							<input type="text" class="form-control datepicker2" name="toDate">
						</div>
						<div class="input-group col-lg-3 d-flex">
							<select class="form-control" name="currency" id="">
								@foreach($currencies as $currency)
									<option>{{$currency}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-3">
							<button class="btn btn-secondary w-100" type="submit">
								Create
							</button>
						</div>
						
					</div>
					
				</form>
				
			</div>

			<div class="col-lg-8 mx-auto mt-5">
				<div class="graph">
					<img src="{{$graph != '' ? $graph : asset('images/data_nf.png')}}" alt="" class="" style="max-width: 600px; display: block; margin: 0 auto;">
				</div>
			</div>
		</div>
	</div>

	<style>
		/*.graph {
			margin: 0 auto;
			width: 600px;
		}*/
	</style>
	
@endsection

@section('scripts')
@endsection

