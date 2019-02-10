
<span class="label
{{ $level == 'nursing'?'label-info':'' }}
{{ $level == 'management'?'label-primary':'' }}
{{ $level == 'worker'?'label-success':'' }}
{{ $level == 'patient'?'label-danger':'' }}
">

{{ trans('admin.'.$level) }}
</span>