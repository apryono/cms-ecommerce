@extends('layout.master')

@section('title') Master Artikel @endsection

@section('page_title')
<h1 class="page-title">
    Edit Artikel
</h1>
@endsection

@section('breadcrumb')
<ul class="page-breadcrumb">
    <li>
        <a href="/">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="/master-article">Artikel</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Edit</span>
    </li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-plus font-green-haze"></i>
                    <span class="caption-subject font-green-haze sbold uppercase">{{ $submenu }}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-danger btn-outline btn-circle btn-sm" href="{{ url($menu) }}">
                        <i class="fa fa-undo"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="portlet-body ">
                <!-- BEGIN FORM-->
                <form method="POST" action="{{ url($menu."/".$submenu."/".$article->id) }}" autocomplete="off" enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    @include('article.form')
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin_styles')
<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-switch/css/bootstrap-switch.min.css">
<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-fileinput/bootstrap-fileinput.css">
<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-select/css/bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" type="text/css" href="/plugins/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="/plugins/select2/css/select2-bootstrap.min.css">
@endpush

@push('plugin_scripts')
<script type="text/javascript" src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/plugins/jquery-repeater/jquery.repeater.min.js"></script>
<script type="text/javascript" src="/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/plugins/number/number.js"></script>
<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
@endpush

@push('custom_scripts')
<script type="text/javascript">
    var _validFileExtensions = [".jpg", ".jpeg", ".png"];    
    CKEDITOR.replace('description_indonesia', {
        removeButtons : 'Underline,Subscript,Superscript,Cut,Undo,Scayt,Link,Image,Maximize,Source,About,Copy,Redo,Paste,PasteText,PasteFromWord,Unlink,Table,Anchor,HorizontalRule,SpecialChar'
    });
    
    function validateImage(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                if (!blnValid) {
                    new Noty({
                        type: 'error',
                        text: 'Format file gambar tidak diizinkan',
                        layout: 'center',
                        timeout: 2000,
                        modal: true
                    }).show();
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }

    function formatRepo(repo) {
        if (repo.loading)
            return repo.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><img src='" + repo.image + "' /></div>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.subject + "</div>";
        if (repo.full_name) {
            markup += "<div class='select2-result-repository__description'>" + repo.full_name + "</div>";
        }

        markup += "<div class='select2-result-repository__statistics' style='margin-top: 5px;'>" +
                "<div class='select2-result-repository__forks'><span class='label label-success label-sm'>" + repo.type_status + "</span></div>" +
                // "<div class='select2-result-repository__stargazers'><span class='label label-warning label-sm'>" + repo.availability_status + "</span></div>" +
                "<div class='select2-result-repository__watchers'><span class='label label-danger label-sm'>" + repo.stock_status + "</span></div>" +
                "</div>" +
                "</div></div>";
        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.full_name || repo.text;
    }

    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    
    $(document).ready(function() {
        $(".make-switch").bootstrapSwitch();
        $(".bs-select").selectpicker();
        $(".select-related").select2({
            placeholder: "-- Pilih Produk Terkait --",
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('/'.$menu.'/search-product')}}",
                dataType: 'json',
                delay: 250,
                type: 'POST',
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data, page) {
                    return {
                        results: data.items
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
    });
</script>
@endpush