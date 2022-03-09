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

            <form action="{{ $requestUrl }}" name="customForm" id="customForm" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($event))
                <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">{{ __('messages.title') }}</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('messages.title') }}" value="{{ old('title', isset($event) ? $event->title : '' ) }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug">{{ __('messages.slug') }}</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('messages.slug') }}" value="{{ old('slug', isset($event) ? $event->slug : '') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">{{ __('messages.status') }}</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1" {{ (old('status', (isset($event) ? $event->status : '')) == 1) ? 'selected' : '' }}>True</option>
                                    <option value="0" {{ (old('status', (isset($event) ? $event->status : '')) == 0) ? 'selected' : '' }}>False</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="order">{{ __('messages.order') }}</label>
                                <input type="number" name="order" class="form-control" id="order" placeholder="{{ __('messages.order') }}" value="{{ old('order', isset($event) ? $event->order : '') }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{ __('messages.description') }}</label>
                                <textarea name="description" class="form-control summernote" id="description" rows="3" placeholder="{{ __('messages.description') }}">{{ old('description', isset($event) ? $event->description : '' ) }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">{{ __('messages.image') }}</label>
                                <input type="hidden" name="id" value="{{ isset($event) ? $event->id : '' }}">
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
            url: "{{ route('admin.event.store_file') }}",
            method: "POST",
            headers: {
                'x-csrf-token': "{{ csrf_token() }}",
            },
            // previewsContainer: document.getElementById('#template'),
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            clickable: ".dropzoneDragArea",
            // The setting up of the dropzone
            init: function() {
                let myDropzone = this;

                <?php if (isset($event)) : ?>
                    let event_id = "{{ $event->id }}";
                    getEventImages(event_id, myDropzone);
                <?php endif; ?>

                //form submission code goes here
                $(document).off("submit", "#customForm").on("submit", "#customForm", function(event) {
                    event.preventDefault();

                    let instance = $(this);
                    let URL = $("#customForm").attr('action');
                    let formData = $('#customForm').serialize();
                    $.ajax({
                        type: "{{ isset($event) ? 'PUT' : 'POST'}}",
                        url: URL,
                        data: formData,
                        beforeSend: function() {
                            removeValidationError();
                        },
                        success: function(result) {
                            if (result.status == "success") {
                                $("input[name=id]").val(result.data.id);
                                //process the queue
                                myDropzone.processQueue();
                            } else {
                                console.log("error");
                            }
                        },
                        // error: function(result) {
                        //     console.log(result);
                        //     showValidationMessage(instance, result.errors)
                        // }
                    });
                });

                //Gets triggered when we submit the image.
                this.on('sending', function(file, xhr, formData) {
                    let id = $("input[name=id]").val();
                    formData.append('id', id);
                    formData.append("_token", "{{ csrf_token() }}");
                });

                this.on("success", function(file, response) {
                    //reset the form
                    $('#customForm')[0].reset();
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
                console.log(file);
                let name = file.name;
                let id = file.id;
                let url = "{{ route('admin.event.destroy_file', ':id') }}";
                url = url.replace(':id', id);

                <?php if (isset($event)) : ?>
                    $.ajax({
                        type: "POST",
                        url,
                        data: {
                            '_method': 'delete',
                            '_token': '{{ csrf_token() }}',
                            id: file.id,
                            file: name
                        },
                        sucess: function(data) {
                            console.log('success: ' + data);
                        }
                    });
                <?php endif; ?>
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });
    })

    getEventImages = (id, myDropzone) => {
        let url = "{{ route('admin.event.image', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: "GET",
            url: url,
            success: function(resp) {
                $.each(resp.data, function(key, value) {
                    var mockFile = {
                        name: value.file_path,
                        size: 1204,
                        id: value.id
                    };

                    myDropzone.options.addedfile.call(myDropzone, mockFile);
                    myDropzone.options.thumbnail.call(myDropzone, mockFile, "{{ asset('storage') }}" + "/" + value.file_path);
                    $(mockFile.previewElement).prop('id', value.id);
                });
            }
        })
    }
</script>

@endsection