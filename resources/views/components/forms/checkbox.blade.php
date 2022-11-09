
@props([
'name' => '',
'label' => '',
'checked' => '0',
'disabled' => 'false',
'type' => 'checkbox',
])
@php $name = preg_replace('/[\s-]/', '_', $name); @endphp

<div class="d-block"> 
    <label> 
        <input type='hidden' name="{{$name}}" value='0'> 
        <input id="{{$name}}" name="{{$name}}" type="{{$type}}" value='1' @if($checked=='1' ) checked="checked" @endif> {!! $label !!}
    </label> 
</div>
