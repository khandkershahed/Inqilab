@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn btn-sm btn-active-success" data-dismiss="alert">×</button>
    </div>
@endif



@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn btn-sm btn-active-danger" data-dismiss="alert">×</button>
    </div>
@endif



@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="btn btn-sm btn-active-warning" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif



@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="btn btn-sm btn-active-info" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif



@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="btn btn-sm btn-active-danger" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif

{{-- @if (session('error'))
    @foreach ($messages as $item)
        <div class="alert alert-danger">
            {{ $item }}
        </div>
    @endforeach
@endif --}}
