@if(Session::has('flash_message') || Session::has('flash_error'))
<script>
    $(document).ready(function() {
        @if(Session::has('flash_message'))
            toastr.success('{{ Session::get('flash_message') }}');
            @else
            toastr.error('{{ Session::get('flash_error') }}');
            @endif
        });
    </script>
@endif

