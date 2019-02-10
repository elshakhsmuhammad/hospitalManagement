
<span class="label
{{ $job == 'nursing'?'label-info':'' }}
{{ $job == 'management'?'label-primary':'' }}
{{ $job == 'worker'?'label-success':'' }}

">

{{ trans('admin.'.$job) }}
</span>