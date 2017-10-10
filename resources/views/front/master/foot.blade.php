{{-- {!! HTML::script('resources/assets/vendor/jquery/dist/jquery.min.js') !!} --}}
{{-- {!! HTML::script('resources/assets/vendor/jquery-ui/jquery-ui.min.js') !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
{!! HTML::script('resources/assets/vendor/toastr/toastr.min.js') !!}
{!! HTML::script('resources/assets/vendor/fixto/dist/fixto.min.js') !!}
{!! HTML::script('resources/assets/vendor/lity/dist/lity.min.js') !!}
{!! HTML::script('resources/assets/vendor/jquery-form/jquery.form.js') !!}
{!! HTML::script('resources/assets/vendor/jquery.cookie/jquery.cookie.js') !!}
{!! HTML::script('public/js/affix.js') !!}

{!! HTML::script('public/js/frontend.min.js') !!}
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.0/jquery.scrollTo.min.js') !!} --}}

{{--
<script type="text/javascript">
    var route_contact_states = '{{ route('contact.states') }}';
    var route_contact_cities = '{{ route('contact.cities') }}';
    var route_contact_store = '{{ route('contact.store') }}';
</script> --}}
{{-- {!! HTML::script('//cdn.jsdelivr.net/jquery.dirtyforms/2.0.0/jquery.dirtyforms.min.js') !!} --}}
{{-- {!! HTML::script('public/js/form.js') !!} --}}

@include('front.master.includes')

@yield('extra-js')
