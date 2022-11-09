@if ($message = Session::get('success'))
<div class="alert alert-success alert-block" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"">
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('error'))
<div class=" alert alert-danger alert-block" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('warning'))
<div class=" alert alert-warning alert-block" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('info'))
<div class=" alert alert-info alert-block" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($errors->any())
<div class=" alert alert-danger" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    Check the following errors!
</div>
@endif
@if(session('message'))
<div class=" alert alert-success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <strong>{{ session('message') }}</strong>
</div>
@endif