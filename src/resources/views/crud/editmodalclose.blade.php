@extends ('cesi::ajax')

@section('content')
    <p>Cerrar ventana</p>
@endsection

@push('after_scripts')
    <script type="text/javascript">
        window.parent.closeEditModal();

        jQuery(document).ready(function($) {
            console.log("Cerrar ventana modal parent");
            // jQuery('#editmodal-item', window.parent.document);
        });
    </script>
@endpush