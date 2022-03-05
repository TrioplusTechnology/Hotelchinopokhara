@extends('layouts.backend.main')
@section('styles')
<style>
    .dropzoneDragArea {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        padding: 60px;
        text-align: start;
        margin-bottom: 15px;
        cursor: pointer;
    }

    .dropzone {
        box-shadow: 0px 2px 20px 0px #f2f2f2;
        border-radius: 10px;
    }
</style>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ $heading }}</h3>
            </div>
            <!-- /.card-header -->

            <form action="{{ $requestUrl }}" name="demoForm" id="demoForm" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($aboutUs))
                <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">{{ __('messages.title') }}</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="{{ __('messages.title') }}" value="{{ old('title', isset($aboutUs) ? $aboutUs->title : '' ) }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug">{{ __('messages.slug') }}</label>
                                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="{{ __('messages.slug') }}" value="{{ old('slug', isset($aboutUs) ? $aboutUs->slug : '') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">{{ __('messages.status') }}</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="module_status">
                                    <option value="1" {{ (old('status', (isset($aboutUs) ? $aboutUs->status : '')) == 1) ? 'selected' : '' }}>True</option>
                                    <option value="0" {{ (old('status', (isset($aboutUs) ? $aboutUs->status : '')) == 0) ? 'selected' : '' }}>False</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="order">{{ __('messages.order') }}</label>
                                <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" id="order" placeholder="{{ __('messages.order') }}" value="{{ old('order', isset($aboutUs) ? $aboutUs->order : '') }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{ __('messages.description') }}</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="summernote" rows="3" placeholder="{{ __('messages.description') }}">{{ old('description', isset($aboutUs) ? $aboutUs->description : '' ) }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{ __('messages.image') }}</label>
                                <input type="hidden" name="id" value="">
                                <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea dropzone">
                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-success btn-flat">{{ $btnName }}</button>
                </div>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')

<script>
    Dropzone.autoDiscover = false;
    Dropzone.options.demoForm = false;
    $(document).ready(function() {
        $("div#dropzoneDragArea").dropzone({
            paramName: "image",
            url: "{{ route('admin.event.create') }}",
            method: "put",
            // previewsContainer: document.getElementById('#template'),
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            clickable: ".dropzoneDragArea",
            params: {
                _token: "{{ csrf_token() }}"
            },
            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;
                //form submission code goes here
                $(document).off("submit", "#demoForm").on("submit", "#demoForm", function(event) {
                    event.preventDefault();

                    let URL = $("#demoForm").attr('action');
                    let formData = $('#demoForm').serialize();
                    $.ajax({
                        type: 'POST',
                        url: URL,
                        data: formData,
                        success: function(result) {
                            if (result.status == "success") {
                                //process the queue
                                myDropzone.processQueue();
                            } else {
                                console.log("error");
                            }
                        },
                        error: function(result) {
                            console.log(result);
                        }
                    });
                });
                //Gets triggered when we submit the image.
                this.on('sending', function(file, xhr, formData) {
                    let id = $("input[name=id]").val();
                    formData.append('id', id);
                });

                this.on("success", function(file, response) {
                    //reset the form
                    $('#demoform')[0].reset();
                    //reset dropzone
                    $('.dropzone-previews').empty();
                });
                this.on("queuecomplete", function() {
                    alert("queueComplete");
                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });

                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });

                this.on("errormultiple", function(files, response) {
                    alert("error");
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            },
            removedfile: function(file) {
                var name = file.name;

                $.ajax({
                    type: 'POST',
                    url: 'upload.php',
                    data: {
                        name: name,
                        request: 2
                    },
                    sucess: function(data) {
                        console.log('success: ' + data);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });
    })
</script>

@endsection