<div class="modal inmodal fade" id="delete-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    @isset($restore)
        <input type="hidden" id="restore" value='{{$restore}}'>
    @endisset
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">{{$question}}</h4>
                <h5 id="resultado"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                @isset($restore)
                    <button type="button" class="btn btn-primary btn-info" id="{{$model}}" data-action="delete">reactivar</button>
                @else
                    <button type="button" class="btn btn-primary btn-danger" id="{{$model}}" data-action="delete">Borrar</button>
                @endisset
            </div>
        </div>
    </div>
</div>
@section('custom-scripts')
    <script src="{{asset('js/tables/bulk-delete.js')}}"></script>
@endsection
