@props([
'label' => '',
'checked' => '0',
'disabled' => 'false',
])
    <label class="imgaligncenter gap-2">
        @if($checked=='1' )
        <i data-feather="check-square" class="icon-xs align-middle"></i> {!! $label !!}
        @else
        <i data-feather="square" class=" icon-xs align-middle"></i> {!! $label !!}
        @endif
    </label>