<div class="form-body">
    @if(Session::has('alert-error'))
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        {{ Session::get('alert-error') }}
    </div>
    @endif
    <span class="text-danger bold">(*) Wajib Diisi</span>
    <div class="form-group form-md-line-input {{ ($errors->has('title')) ? "has-error" : "" }}">
        <label class="col-md-3 control-label">Judul
            <span class="required">*</span>
        </label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="title" id="title" value="{{ (!empty($banner)) ? $banner->title : old('title') }}">
            @if ($errors->has('title'))
            <span class="text-danger">{{ $errors->first('title') }}</span>
            @else
            <div class="form-control-focus"> </div>
            @endif
        </div>
    </div>
    <div class="form-group form-md-line-input {{ ($errors->has('subtitle')) ? "has-error" : "" }}">
        <label class="col-md-3 control-label">Sub Judul
            <span class="required">*</span>
        </label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ (!empty($banner)) ? $banner->subtitle : old('subtitle') }}">
            @if ($errors->has('subtitle'))
            <span class="text-danger">{{ $errors->first('subtitle') }}</span>
            @else
            <div class="form-control-focus"> </div>
            @endif
        </div>
    </div>
    <div class="form-group form-md-line-input {{ ($errors->has('url')) ? "has-error" : "" }}">
        <label class="col-md-3 control-label">Url
            <span class="required">*</span>
        </label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="url" id="url" value="{{ (!empty($banner)) ? $banner->url : old('url') }}">
            @if ($errors->has('url'))
            <span class="text-danger">{{ $errors->first('url') }}</span>
            @else
            <div class="form-control-focus"> </div>
            @endif
        </div>
    </div>
    <div class="form-group" style="height: 30px;">
        <label class="control-label col-md-3">Publish</label>
        <div class="col-md-9">
            <input type="checkbox" name="publish" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>" {{ (!empty($banner) && $banner->publish == "T") ? "checked" : "" }}>
        </div>
    </div>
    <div class="form-group {{ ($errors->has('date_start') or $errors->has('date_end')) ? 'has-error' : '' }}">
        <label class="control-label col-md-3">Periode
            <span class="required">*</span>
        </label>
        <div class="col-md-3">
            <div class="input-group right-addon date-start">
                @php $date_start = (!empty($banner)) ? date('d M Y', strtotime($banner->date_start)) : old('date_start'); @endphp
                <input type="text" name="date_start" class="form-control" value="{{ $date_start }}" readonly="">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
            @if ($errors->has('date_start'))
            <span class="text-danger">{{ $errors->first('date_start') }}</span>
            @endif
        </div>
        <div class="col-md-3">
            <div class="input-group right-addon date-end">
                @php $date_end = (!empty($banner)) ? date('d M Y', strtotime($banner->date_end)) : old('date_end'); @endphp
                <input type="text" name="date_end" class="form-control" value="{{ $date_end }}" readonly="">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
            @if ($errors->has('date_end'))
            <span class="text-danger">{{ $errors->first('date_end') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group last">
        @php $banner_image_src = !empty($banner->image) ? AppConfiguration::assetPortalDomain()->value.  "/" . AppConfiguration::bannerPath()->value . "/" . $banner->image : "http://www.placehold.it/450x200/EFEFEF/AAAAAA&amp;text=no+image"; @endphp
        <label class="control-label col-md-3">Gambar Banner <span class="required">*</span></label>
        <div class="col-md-5">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 450px; height: 200px;">
                    <img src="{{ $banner_image_src }}" alt="" /> 
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 450px; max-height: 200px;"> </div>
                <div>
                    <span class="btn default btn-file">
                        @if (!empty($banner->image))
                        <span class="fileinput-new"> Ubah Gambar </span>                            
                        @else
                        <span class="fileinput-new"> Pilih Gambar </span>                            
                        @endif
                        <span class="fileinput-exists"> Ubah Gambar</span>
                        <input type="file" name="banner_image" onchange="validateImage(this);">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Batalkan</a>
                </div>
            </div>
            <div class="clearfix margin-top-10">
                <span class="label label-danger">NOTE!</span> Format gambar harus JPG atau PNG.
            </div>
            @if ($errors->has('banner_image'))
            <div class="clearfix margin-top-10">
                <span class="text-danger">
                    {{ $errors->first('banner_image') }}
                </span>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">Simpan</button>
            <a href="{{ url($menu) }}" class="btn btn-danger"><i class="fa fa-undo"></i> Kembali</a>
        </div>
    </div>
</div>