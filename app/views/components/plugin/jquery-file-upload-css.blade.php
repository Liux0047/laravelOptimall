{{-- Jquery file upload CSS --}}
<!-- blueimp Gallery styles -->
{{ HTML::style('plugins/jQuery-File-Upload-9.8.0/blueimp/blueimp-gallery.min.css') }}
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
{{ HTML::style('plugins/jQuery-File-Upload-9.8.0/css/jquery.fileupload.css') }}
{{ HTML::style('plugins/jQuery-File-Upload-9.8.0/css/jquery.fileupload-ui.css') }}
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>{{ HTML::style('plugins/jQuery-File-Upload-9.8.0/css/jquery.fileupload-noscript.css') }}</noscript>
<noscript>{{ HTML::style('plugins/jQuery-File-Upload-9.8.0/css/jquery.fileupload-ui-noscript.css') }}</noscript>