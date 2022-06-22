@if( session()->has('info') )
<div class="blue-box container p-3 mb-3">
    <div class="text-center">
        <p class="m-0">{{ session()->get('info') }}</p>
    </div>
</div>
@endif
